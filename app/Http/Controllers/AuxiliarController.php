<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class AuxiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        // Obtener el conteo de tickets asignados
        $ticketsAsignados = DB::table('vistatickets')
                             ->where('estatus', 'Asignado')
                              ->where('ID_Auxiliar', Auth::id())
                              ->count();

        // Obtener el conteo de tickets finalizadoos
        $ticketsFinalizados = DB::table('vistatickets')
                              ->where('estatus','Completado')
                              ->where('ID_Auxiliar', Auth::id())
                              ->count();

        // Obtener el conteo de tickets no solucionado
        $ticketsNS = DB::table('vistatickets')
                              ->where('estatus','No Solucionado')
                              ->where('ID_Auxiliar', Auth::id())
                              ->count();

        // Pasar todos los conteos a la vista
        return view('auxiliar.index', compact('ticketsAsignados', 'ticketsFinalizados', 'ticketsNS'));
    }
    public function imprimirTicketsAuxiliar()
    {
        $idAuxiliar = Auth::id();

        $tickets = DB::table('tickets')
            ->join('usuarios', 'tickets.ID_Usuario', '=', 'usuarios.ID_Usuario')
            ->join('departamentos', 'usuarios.departamento', '=', 'departamentos.iddepartamentos')
            ->leftJoin('usuarios as auxiliar', 'tickets.auxiliar_Soporte', '=', 'auxiliar.ID_Usuario')
            ->select(
                'tickets.*',
                'usuarios.nombre as nombre_usuario',
                'usuarios.departamento as departamento_usuario',
                'auxiliar.nombre as nombre_auxiliar'
            )
            ->orderBy('usuarios.nombre')
            ->whereNotNull('tickets.auxiliar_Soporte') // Solo tickets que tengan asignado un auxiliar
            ->where('tickets.auxiliar_Soporte', $idAuxiliar) // Solo tickets asignados al auxiliar autenticado
            ->get();
        // Renderizar la vista del ticket en HTML
        $html = view('PDF.reporteTicketsAuxiliar', compact('tickets','idAuxiliar'))->render();
    
        // Generar el PDF con Dompdf
        $pdf = PDF::loadHTML($html);
        
        // Configurar el tamaño del papel y la orientación
        $pdf->setPaper('A4', 'landscape');  // Ajusta a formato A4 en orientación horizontal
    
        // Opción para descargar el PDF
        return $pdf->download('ticket.pdf');
    
        // Opción para mostrar el PDF en el navegador
        return $pdf->stream('ticket.pdf');
    }
    public function imprimirTicketsFecha(Request $request)
    {
        $idAuxiliar = Auth::id();

        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');

        if($fechaInicio == $fechaFin ){
            $tickets = DB::table('tickets')
            ->whereDate('fecha','=', $fechaInicio)
            ->where('tickets.auxiliar_Soporte', $idAuxiliar) // Solo tickets asignados al auxiliar autenticado
            ->orderby('fecha')
            ->get();

        }else{
            $tickets = DB::table('tickets')
            ->where('fecha', '>=', $fechaInicio)
            ->where('fecha', '<=', $fechaFin)
            ->where('tickets.auxiliar_Soporte', $idAuxiliar) // Solo tickets asignados al auxiliar autenticado
            ->orderby('fecha')
            ->get();
            
        }

        foreach ($tickets as $ticket){
            $ticket->usuario = DB::table('usuarios')->where('ID_Usuario', $ticket->ID_Usuario)->first();
        }
        
        // Renderizar la vista del ticket en HTML
        $html = view('PDF.reporteTickets', compact('tickets'))->render();

        // Generar el PDF con Dompdf
        $pdf = PDF::loadHTML($html);

        // Opción para descargar el PDF
        return $pdf->download('ticket.pdf');

        // Opción para mostrar el PDF en el navegador
        return $pdf->stream('ticket.pdf');
    }
    public function imprimirTicketsEstatus()
    {
        $idAuxiliar = Auth::id();

        $tickets = DB::table('tickets')
            ->join('usuarios', 'tickets.ID_Usuario', '=', 'usuarios.ID_Usuario')
            ->join('departamentos', 'usuarios.departamento', '=', 'departamentos.iddepartamentos')
            ->leftJoin('usuarios as auxiliar', 'tickets.auxiliar_Soporte', '=', 'auxiliar.ID_Usuario')
            ->select(
                'tickets.*',
                'usuarios.nombre as nombre_usuario',
                'usuarios.departamento as departamento_usuario',
                'auxiliar.nombre as nombre_auxiliar'
            )
            ->orderBy('tickets.estatus')
            ->whereNotNull('tickets.auxiliar_Soporte') // Solo tickets que tengan asignado un auxiliar
            ->where('tickets.auxiliar_Soporte', $idAuxiliar) // Solo tickets asignados al auxiliar autenticado
            ->get();
        // Renderizar la vista del ticket en HTML
        $html = view('PDF.imprimirTicketEstatus', compact('tickets','idAuxiliar'))->render();
    
        // Generar el PDF con Dompdf
        $pdf = PDF::loadHTML($html);
        
        // Configurar el tamaño del papel y la orientación
        $pdf->setPaper('A4', 'landscape');  // Ajusta a formato A4 en orientación horizontal
    
        // Opción para descargar el PDF
        return $pdf->download('ticket.pdf');
    
        // Opción para mostrar el PDF en el navegador
        return $pdf->stream('ticket.pdf');
    }
}