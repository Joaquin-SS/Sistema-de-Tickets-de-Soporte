<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (auth()->user()->Rol === 'Jefe') {
            return '/jefe'; // Ruta destinada para los usuarios con rol de Jefe
        } elseif (auth()->user()->Rol === 'Auxiliar') {
            return '/auxiliar'; // Ruta destinada para los usuarios con rol de Auxiliar
        } elseif (auth()->user()->Rol === 'Cliente') {
            return '/cliente'; // Ruta destinada para los usuarios con rol de Cliente
        }
        return redirect()->route('home');
    }
}