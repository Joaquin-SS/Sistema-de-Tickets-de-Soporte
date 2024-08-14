<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        // Obtener el conteo de tickets no asignados
        $ticketsNoAsignados = DB::table('vistatickets')
                                 ->whereNull('auxiliarSoporte')
                                 ->where ('estatus', 'En Proceso')
                                 ->where('ID_Usuario', Auth::id())
                                 ->count();
        
        // Obtener el conteo de tickets asignados
        $ticketsAsignados = DB::table('vistatickets')
                              ->whereNotNull('auxiliarSoporte')
                              ->where('ID_Usuario', Auth::id())
                              ->count();

        // Obtener el conteo de tickets finalizadoos
        $ticketsFinalizados = DB::table('vistatickets')
                              ->where('estatus','Completado')
                              ->where('ID_Usuario', Auth::id())
                              ->count();
        // Pasar todos los conteos a la vista
        return view('cliente.index', compact('ticketsNoAsignados', 'ticketsAsignados', 'ticketsFinalizados'));
    }
}
