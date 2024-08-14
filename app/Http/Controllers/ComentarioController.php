<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\vistaComentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
{
    public function obtenerComentariosPorTicket($idTicket)
    {
        if (auth()->user()->Rol === 'Jefe') {
            $comentarios = vistaComentarios::where('ID_tickets', $idTicket)
                     ->where('destinatario', 'jefe-aux')
                     ->orderBy('fecha_hora', 'asc')
                     ->get();

            $usuarioAutenticado = auth()->id();

            return response()->json([
                'comentarios' => $comentarios,
                'usuarioAutenticado' => $usuarioAutenticado
            ]);
        }elseif (auth()->user()->Rol === 'Auxiliar') {
            $comentariosJefe = vistaComentarios::where('ID_tickets', $idTicket)
                     ->where('destinatario', 'jefe-aux')
                     ->orderBy('fecha_hora', 'asc')
                     ->get();

            $comentariosCliente = vistaComentarios::where('ID_tickets', $idTicket)
                     ->where('destinatario', 'aux-cliente')
                     ->orderBy('fecha_hora', 'asc')
                     ->get();

            $usuarioAutenticado = auth()->id();
            return response()->json([
                'comentariosJefe' => $comentariosJefe,
                'comentariosCliente' => $comentariosCliente,
                'usuarioAutenticado' => $usuarioAutenticado
            ]);
        } elseif (auth()->user()->Rol === 'Cliente') {
            $comentarios = vistaComentarios::where('ID_tickets', $idTicket)
                     ->where('destinatario', 'aux-cliente')
                     ->orderBy('fecha_hora', 'asc')
                     ->get();

            $usuarioAutenticado = auth()->id();

            return response()->json([
                'comentarios' => $comentarios,
                'usuarioAutenticado' => $usuarioAutenticado
            ]);
        }
    }

    public function crearComentario(Request $request)
    {   
        if (auth()->user()->Rol === 'Jefe') {
            $comentario = new Comentario();
            $comentario->ID_Usuario = auth()->id();
            $comentario->ID_tickets = $request->ID_tickets;
            $comentario->comentario = $request->comentario;
            $comentario->fecha_hora = now();
            $comentario->destinatario = 'jefe-aux';
        }elseif (auth()->user()->Rol === 'Cliente') {
            $comentario = new Comentario();
            $comentario->ID_Usuario = auth()->id();
            $comentario->ID_tickets = $request->ID_tickets;
            $comentario->comentario = $request->comentario;
            $comentario->fecha_hora = now();
            $comentario->destinatario = 'aux-cliente';
        }elseif (auth()->user()->Rol === 'Auxiliar') {
            $comentario = new Comentario();
            $comentario->ID_Usuario = auth()->id();
            $comentario->ID_tickets = $request->ID_tickets;
            $comentario->comentario = $request->comentario;
            $comentario->fecha_hora = now();
            $comentario->destinatario = $request->destinatario;
        }
        
        $comentario->save();

        return response()->json(['success' => 'Comentario guardado con éxito']);
    }
}
