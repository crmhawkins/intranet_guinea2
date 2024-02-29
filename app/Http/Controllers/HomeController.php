<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Caja;
use App\Models\TipoEvento;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Gastos;
use App\Models\Presupuesto;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
    //     $user = $request->user();

    //     if($user->role === 1){
    //         return view('notas.users');
    //     }
    //    return view('notas.index', compact('user'));

   


    return view('home');
    }
}
