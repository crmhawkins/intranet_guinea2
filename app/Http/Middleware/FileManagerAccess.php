<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FileManagerAccess
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->isAdmin) {
            // Asignar la ruta del directorio del usuario actual a la sesión
            session(['lfm.user_field' => 'user_' . $user->id]);
        }

        return $next($request);
    }
}
