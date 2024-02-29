<?php

use App\Http\Controllers\AvisosController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SocioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NotaController;

use App\Http\Middleware\IsAdmin;
use FontLib\Table\Type\name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::name('inicio')->get('/', function () {
    return view('auth.login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is.admin');
//Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::group(['middleware' => 'is.admin', 'prefix' => 'admin'], function () {
    /* --------------------------------------- */

    // Registrar usuarios
    Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios-create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::get('usuarios-edit/{id}', [UsuarioController::class, 'edit'])->name('usuarios.edit');

    // Notas por usuario
    Route::get('notas-users', [NotaController::class, 'notesUsers'])->name('notes.users');
    Route::get('notas/{id}', [NotaController::class, 'notesFrom'])->name('notes.from');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('comunidad', [ComunidadController::class, 'index'])->name('comunidad.index');
});
