<?php

namespace App\Providers;

use App\Models\Alertas;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $empresa = Settings::whereNull('deleted_at')->first();
        // View::share('empresa', $empresa);
        Schema::defaultStringLength(191);
        setlocale(LC_TIME, 'es_ES');
        Carbon::setlocale('es');
        Carbon::setUTF8(true);

        View::composer('layouts.header', function ($view) {
            if (Auth::check()) { // Asegúrate de que el usuario está autenticado
                $notificaciones = Alertas::where('user_id', Auth::id())->where('tipo', 3)->where('url', null)->get();
                $view->with('notificaciones', $notificaciones);
            }
        });
    }
}
