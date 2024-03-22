<?php

namespace App\Handler;

use Illuminate\Support\Facades\Auth;

class ConfigHandler
{
    public function userField()
    {
        $user = Auth::user();

        // Comprueba si el usuario es administrador
        if (!$user->role == 1) {
            return $user->id . ' ' . str_replace(' ', '_', $user->name) . str_replace(' ', '_', $user->surname);
        }else{
            return '';
        }

    }
}
