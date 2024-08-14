<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CambiarContrasenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->Rol === 'Jefe') {
            return view('Auth.cambiarpassJefe');
        } elseif (auth()->user()->Rol === 'Auxiliar') {
            return view('Auth.cambiarpassAux');
        } elseif (auth()->user()->Rol === 'Cliente') {
            return view('Auth.cambiarpass');
        }
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contraActual' => 'required',
            'nuevaContra' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if(!Hash::check($request->contraActual, $user->contrasena)) {
            return back()->withErrors(['contraActual' => 'La contraseña actual es incorrecta']);
        }

        $user->contrasena = Hash::make($request->nuevaContra);
        $user->save();

        if (auth()->user()->Rol === 'Jefe') {
            return redirect('/jefe')->with('success', 'Ha cambiado su contraseña correctamente');
        }elseif (auth()->user()->Rol === 'Auxiliar') {
            return redirect('/auxiliar')->with('success', 'Ha cambiado su contraseña correctamente');
        }elseif (auth()->user()->Rol === 'Cliente') {
            return redirect('/cliente')->with('success', 'Ha cambiado su contraseña correctamente');
        }
    }
    
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profilePhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = time().'.'.$request->profilePhoto->extension();  
        $request->profilePhoto->move(public_path('images'), $fileName);

        // Actualizar la ruta en la base de datos
        $user = Auth::user();
        $user->fotoPerfil = '/images/' . $fileName;
        $user->save();

        return back()->with('success','Has actualizado tu foto de perfil.');
    }
}
