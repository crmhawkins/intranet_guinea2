<?php

namespace App\Handlers;

class ConfigHandler
{
    public function userField()
    {
        // Comprueba si el usuario es administrador
        if (auth()->user()->role == 1) {
            // Retorna un valor nulo o una cadena vacía para dar al administrador acceso al directorio raíz
            return 'carpeta';
        } else {
            // Retorna una carpeta específica para el usuario basada en su ID o nombre de usuario
            return 'carpeta/'. auth()->id() . '_' . str_replace(' ', '_', auth()->user()->name) .'_'. str_replace(' ', '_', auth()->user()->surname);
        }
    }
}
