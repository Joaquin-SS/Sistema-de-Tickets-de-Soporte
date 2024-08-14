<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        // Recuperar solo los datos del usuario autenticado
        $usuario = auth()->user();

        if (auth()->user()->Rol === 'Jefe') {
            return view('jefe.editProfile', compact('usuario'));
        } elseif (auth()->user()->Rol === 'Auxiliar') {
            return view('auxiliar.editProfile', compact('usuario'));
        } elseif (auth()->user()->Rol === 'Cliente') {
            return view('cliente.editProfile', compact('usuario'));
        }
        
        
    }
    
    public function update(Request $request, $ID_Usuario)
    {
        $usuario = User::find($ID_Usuario);
        
        // Verifica que la contraseña es correcta
        if (!Hash::check($request->current_password, $usuario->contrasena)) {
            // Redirige de vuelta con un mensaje de error
            return back()->with('error', 'La contraseña ingresada es incorrecta.');
        }
        
        // Si la contraseña es correcta, procede con la actualización del usuario...
        $usuario->update([
            'departamento' => $request->Departamento,
            'email' => $request->email,
        ]);
        
        return back()->with('success', 'Información actualizada correctamente.');
    }
}