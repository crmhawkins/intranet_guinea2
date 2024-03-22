<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FileManagerAccess
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role == 1) {
            // Opción 1: Dar acceso al directorio raíz a los administradores
            session(['lfm.user_field' => null]);
        } else {
            // Asignar la ruta del directorio del usuario actual a la sesión
            session(['lfm.user_field' => $user->id . ' ' . str_replace(' ', '_', $user->name) . str_replace(' ', '_', $user->surname)]);
        }

        return $next($request);
    }
}
