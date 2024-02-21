<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Comunidad;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $alertas;
    protected $user;
    protected $comunidad;
    protected $comunidades;

    public function __construct()
    {
        $this->user = Auth::user();
        // Fetch the Site Settings object
        $this->alertas = Alertas::all();
        $this->comunidades = Comunidad::all();
        View::share('alertas', $this->alertas);
        View::share('comunidades', $this->comunidades);
        View::share('user', $this->user);
    }
}
