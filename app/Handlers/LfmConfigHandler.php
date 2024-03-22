<?php

namespace App\Handler;

use Illuminate\Support\Facades\Auth;

class ConfigHandler
{
    public function userField()
    {
        $user = Auth::user();

        // Comprueba si el usuario es administrador
        if ($user->role = 1) {
            // Retorna un valor nulo o una cadena vacía para dar al administrador acceso al directorio raíz
            return '';
        } else {
            // Retorna una carpeta específica para el usuario basada en su ID o nombre de usuario
            return 'user_' . $user->id . ' ' . str_replace(' ', '_', $user->name) . str_replace(' ', '_', $user->surname);
        }
    }
}