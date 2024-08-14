<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CheckRole
{
    use AuthenticatesUsers;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!in_array($request->user()->Rol, $roles)) {
            // Redirigir si el usuario no tiene el rol adecuado
            if (auth()->user()->Rol === 'Jefe') {
                return redirect('/jefe'); // Ruta destinada para los usuarios con rol de Jefe
            } elseif (auth()->user()->Rol === 'Auxiliar') {
                return redirect('/auxiliar'); // Ruta destinada para los usuarios con rol de Auxiliar
            } elseif (auth()->user()->Rol === 'Cliente') {
                return redirect('/cliente'); // Ruta destinada para los usuarios con rol de Cliente
            }
            return redirect('/home');
        }
    
        return $next($request);
    }
}
