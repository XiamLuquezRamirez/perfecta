<?php

use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AdminitraccionController;
use App\Http\Controllers\CitasController;

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
Route::post('/AdminPacientes/CargarPacientes', [PacientesController::class,'CargarPacientes']);
Route::post('/AdminPacientes/GuardarPaciente', [PacientesController::class,'GuardarPaciente']);
Route::get('/AdminPacientes/municipios', [PacientesController::class,'CargarMunicipios']);
Route::post('/AdminPacientes/ValidarPacientes', [PacientesController::class,'ValidarPacientes']);
Route::post('/AdminPacientes/BuscarPacientes', [PacientesController::class,'BuscarPacientes']);
Route::post('/AdminPacientes/AllProfesionales', [PacientesController::class,'AllProfesionales']);


//GESTIOAR ADMINISTRACCION
Route::get('/Administracion/Profesionales', [AdminitraccionController::class,'Profesionales']);
Route::post('/Administracion/CargarProfesionales', [AdminitraccionController::class,'CargarProfesionales']);
Route::post('/Administracion/GuardarProfesional', [AdminitraccionController::class,'GuardarProfesional']);
Route::post('/Administracion/ValidarProfesional', [AdminitraccionController::class,'ValidarProfesional']);
Route::post('/Administracion/BuscarProfesional', [AdminitraccionController::class,'BuscarProfesional']);
Route::post('/Administracion/BuscarUsuario', [AdminitraccionController::class,'BuscarUsuario']);
Route::post('/Administracion/EliminarProfesional', [AdminitraccionController::class,'EliminarProfesional']);


//GESTIONAR CITAS

Route::post('/AdminCitas/CargarDisponibilidad', [CitasController::class,'CargarDisponibilidad']);