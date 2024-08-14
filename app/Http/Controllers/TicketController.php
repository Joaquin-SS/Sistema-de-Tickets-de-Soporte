<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\vistaTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {     
        // Pasar los tickets a la vista correspondiente
        if (auth()->user()->Rol === 'Jefe') {
            $ticketsEP = DB::table('vistatickets')
                     ->where ('estatus', 'En Proceso')
                     ->get();
            
            $ticketsA = DB::table('vistatickets')
                     ->where ('estatus', 'Asignado')
                     ->get();

            $ticketsC = DB::table('vistatickets')
                     ->where ('estatus', 'Completado')
                     ->get();

            $ticketsNS = DB::table('vistatickets')
                     ->where ('estatus', 'No Solucionado')
                     ->get();
            
            $ticketsCC = DB::table('vistatickets')
                     ->where ('estatus', 'Cancelado')
                     ->get();

            $auxiliar = DB::table('vistausuarios')
                     ->where ('departamento', 'Soporte')
                     ->where ('Rol', 'Auxiliar')
                     ->get();

            return view('jefe.showTickets', compact('ticketsEP', 'ticketsA', 'ticketsC', 'ticketsNS', 'ticketsCC', 'auxiliar'));
        } elseif (auth()->user()->Rol === 'Auxiliar'){
            // Recuperar solo los tickets del usuario autenticado
            $query = DB::table('vistatickets');

            if ($request->has('estatus') && $request->estatus !=''){
                $query->whereIn('estatus', $request->estatus);
            }
            if ($request->has('departamento') && $request->departamento != '') {
                $query->whereIn('departamento', $request->departamento);
            }
            if ($request->has('fecha_inicio') && $request->fecha_inicio != '') {
                $query->where('fecha', '>=', $request->fecha_inicio);
            }
            if ($request->has('fecha_fin') && $request->fecha_fin != '') {
                $fechaFinAjustada = new Carbon($request->fecha_fin);
                $fechaFinAjustada->setTime(23, 59, 59);
                $query->where('fecha', '<=', $fechaFinAjustada);
            } // ESTABLECER QUE LA FECHA FINAL SE VA A TOMAR  EN CUENTA HASTA LAS 23:59:59

            $userId = Auth::id();

            $query->where(function($query) use ($userId) {
                $query->where(function($query) use ($userId) {
                    $query->whereIn('estatus', ['Asignado', 'No Solucionado', 'Completado'])
                        ->where('ID_Auxiliar', $userId);
                });
            });

            $query->orderByRaw("FIELD(estatus, 'Asignado', 'Completado', 'No Solucionado', 'En Proceso', 'Cancelado')");

            $tickets=$query->paginate(5);

            return view('auxiliar.showTickets', compact('tickets'));
            
        } elseif (auth()->user()->Rol === 'Cliente') {
            // Recuperar solo los tickets del usuario autenticado
            $tickets = vistaTickets::where('ID_Usuario', Auth::id())
            ->get(['ID_tickets','Autor', 'Detalles','Clasificacion', 'auxiliarSoporte', 'departamento','fecha', 'estatus']);
            return view('cliente.showTicket' , compact('tickets'));
        }            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (auth()->user()->Rol === 'Jefe') {
            return view('jefe.createTicket');
        } elseif (auth()->user()->Rol === 'Auxiliar'){
            return view('auxiliar.createTicket');
        } elseif (auth()->user()->Rol === 'Cliente') {
            return view('cliente.createTicket');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Incluir todo excepto el token
        $datos=$request->except('_token');
        

        $datosTicket = array_merge($datos, [
            'ID_Usuario' => auth()->id(), // ID del usuario autenticado
            'auxiliar_Soporte' => null, // Valor de null hasta que el jefe lo asigne
            'fecha' => now(), // Fecha actual
            'estatus' => 'En Proceso', // Establecer estatus inicial para el ticket
        ]);

        $insertado = Ticket::insert($datosTicket);

        if ($insertado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Ticket creado correctamente.'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al crear el ticket. Por favor, intenta de nuevo.'];
        }

        if (auth()->user()->Rol === 'Jefe') {
            return redirect('/jefe')->with('mensaje', $mensaje);
        } elseif (auth()->user()->Rol === 'Auxiliar'){
            return redirect('/auxiliar')->with('mensaje', $mensaje);
        } elseif (auth()->user()->Rol === 'Cliente') {
            return redirect('/cliente')->with('mensaje', $mensaje);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ID_Tickets)
    {
        $ticket = Ticket::findOrFail($ID_Tickets);

        
        if (auth()->user()->Rol === 'Jefe') {
            if ($ticket->auxiliar_Soporte !== null) {
                $mensaje = ['tipo' => 'error', 'texto' => 'Este ticket ya está siendo atendido y no se puede editar.'];
                return redirect('/ticketJefe')->with('mensaje', $mensaje);
                }
                return view('jefe.index', compact('ticket'));
            } elseif (auth()->user()->Rol === 'Cliente') {
            if ($ticket->auxiliar_Soporte !== null) {
                $mensaje = ['tipo' => 'error', 'texto' => 'Este ticket ya está siendo atendido y no se puede editar.'];
                return redirect('/ticketCliente')->with('mensaje', $mensaje);
                }
            if ($ticket->estatus == 'Cancelado') {
                $mensaje = ['tipo' => 'error', 'texto' => 'Este ticket está CANCELADO y no se puede editar'];
                return redirect('/ticketCliente')->with('mensaje', $mensaje);
            }
            return view('cliente.editTicket', compact('ticket'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ID_tickets)
    {
        $ticket = Ticket::findOrFail($ID_tickets);

        if ($ticket->auxiliar_Soporte !== null) {
            $mensaje = ['tipo' => 'error', 'texto' => 'Ya se ha asignado un auxiliar, por lo que no se puede editar este Ticket.'];
            return redirect('/ticketCliente')->with('mensaje', $mensaje);
        }

        if ($ticket->estatus == 'Cancelado') {
            $mensaje = ['tipo' => 'error', 'texto' => 'Este ticket está CANCELADO y no se puede editar'];
            return redirect('/ticketCliente')->with('mensaje', $mensaje);
        }

        // Actualizar los campos permitidos
        $actualizado = $ticket->update([
            'Clasificacion' => $request->Clasificacion,
            'Detalles' => $request->Detalles,
            'fecha' => now(),
        ]);

        if ($actualizado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Ticket actualizado correctamente'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al editar el Ticket. Por favor, intenta de nuevo'];
        }

        return redirect('/ticketCliente')->with('mensaje', $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ID_tickets)
    {
        $ticket = Ticket::findOrFail($ID_tickets);

        // Verificar si el usuario autenticado puede eliminar este ticket
        if ($ticket->ID_Usuario != auth()->id()) {
            $mensaje = ['tipo' => 'error', 'texto' => 'No tienes permiso para eliminar este ticket']; 
            return redirect('/ticketCliente')->with('mensaje', $mensaje);
        }
        if ($ticket->auxiliar_Soporte !== null) {
            $mensaje = ['tipo' => 'error', 'texto' => 'No se puede eliminar este ticket'];
            return redirect('/ticketCliente')->with('mensaje', $mensaje);
        }
        
        $ticket->estatus = 'Cancelado';
        $cancelado=$ticket->save();

        if ($cancelado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Se ha cancelado el Ticket correctamente.'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al cancelar el ticket. Por favor, intenta de nuevo.'];
        }

        return redirect()->back()->with('mensaje', $mensaje);
    }

    public function asignarAuxiliar(Request $request, $ID_tickets)
    {
        $ticket = Ticket::findOrFail($ID_tickets);
        $ticket->auxiliar_Soporte = $request->auxiliar_id;
        $ticket->estatus = 'Asignado';
        $asignado= $ticket->save();

        if ($asignado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Auxiliar asignado correctamente.'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al asignar un Auxiliar. Por favor, intenta de nuevo.'];
        }
        return back()->with('mensaje', $mensaje);
    }

    public function actualizarEstatus(Request $request, $ID_tickets)
    {
        $request->validate([
            'nuevoEstatus' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($ID_tickets);
        $ticket->estatus = $request->nuevoEstatus;
        $actualizado = $ticket->save();

        if ($actualizado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Estatus actualizado correctamente.'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al actualizar el estatus. Por favor, intenta de nuevo.'];
        }
        return back()->with('mensaje', $mensaje);
    }
}
