<?php

use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

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

Route::get('/', function () {
    return view('Login');
});

///INICIO DE SESIÓN
Route::post('/Login', [UsuariosController::class,'Login']);
Route::get('/Logout', [UsuariosController::class,'Logout']);
Route::get('/Administracion', [UsuariosController::class,'Administracion']);

///GESTION PACIENTES
Route::get('/AdminPacientes/Pacientes', [PacientesController::class,'Pacientes']);
