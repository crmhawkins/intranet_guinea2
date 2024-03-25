<?php

namespace App\Handler;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class LfmConfigHandler
{
    public function userField()
    {
        Log::info("LfmConfigHandler: Determinando el campo de usuario");
        $user = Auth::user();

        // Comprueba si el usuario es administrador
        if ($user->role == 1) {
            Log::info("LfmConfigHandler: Usuario es administrador");
            // Retorna un valor nulo o una cadena vacía para dar al administrador acceso al directorio raíz
            return null;
        } else {
            // Retorna una carpeta específica para el usuario basada en su ID o nombre de usuario
            log::info("LfmConfigHandler: Usuario NO es administrador, ID: " . $user->id);
            return $user->id . ' ' . str_replace(' ', '_', $user->name) . str_replace(' ', '_', $user->surname);
        }
    }
}
