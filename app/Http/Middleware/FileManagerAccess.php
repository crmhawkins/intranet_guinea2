<?php

namespace App\Http\Middleware;

use Closure;


class FileManagerAccess
{
    public function handle($request, Closure $next)
    {

        if (auth()->user()->role == 1) {
            // Opción 1: Dar acceso al directorio raíz a los administradores
            session(['lfm.user_field' => 'carpeta']);
        } else {
            // Asignar la ruta del directorio del usuario actual a la sesión
            session(['lfm.user_field' => 'carpeta/'. auth()->id() . ' ' . str_replace(' ', '_', auth()->user()->name) .'_'. str_replace(' ', '_', auth()->user()->surname)]);
        }

        return $next($request);
    }
}
