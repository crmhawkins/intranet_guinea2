<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FileManagerAccess
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->role = 1) {
            // Asignar la ruta del directorio del usuario actual a la sesión
            session(['lfm.user_field' => 'user_' . $user->id]);
        }

        return $next($request);
    }
}
