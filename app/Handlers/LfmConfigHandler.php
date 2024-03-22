<?php

namespace App\Handler;

class ConfigHandler
{
    public function userField()
    {
        return auth()->id();
    }
}
