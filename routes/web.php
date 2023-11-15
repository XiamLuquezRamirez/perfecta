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
Route::get('/Administracion/Servicios', [AdminitraccionController::class,'Servicios']);
Route::post('/Administracion/CargarProfesionales', [AdminitraccionController::class,'CargarProfesionales']);
Route::post('/Administracion/CargarServicios', [AdminitraccionController::class,'CargarServicios']);
Route::post('/Administracion/GuardarProfesional', [AdminitraccionController::class,'GuardarProfesional']);
Route::post('/Administracion/GuardarServicio', [AdminitraccionController::class,'GuardarServicio']);
Route::post('/Administracion/ValidarProfesional', [AdminitraccionController::class,'ValidarProfesional']);
Route::post('/Administracion/BuscarProfesional', [AdminitraccionController::class,'BuscarProfesional']);
Route::post('/Administracion/BuscarServicio', [AdminitraccionController::class,'BuscarServicio']);
Route::post('/Administracion/BuscarUsuario', [AdminitraccionController::class,'BuscarUsuario']);
Route::post('/Administracion/EliminarProfesional', [AdminitraccionController::class,'EliminarProfesional']);
Route::post('/Administracion/EliminarServicio', [AdminitraccionController::class,'EliminarServicio']);


//GESTIONAR CITAS

Route::post('/AdminCitas/CargarDisponibilidad', [CitasController::class,'CargarDisponibilidad']);
Route::post('/AdminCitas/GuardarCita', [CitasController::class,'GuardarCita']);
Route::post('/AdminCitas/CargarPacientesCita', [PacientesController::class,'CargarPacientesCita']);
Route::post('/AdminCitas/CargarAllCitas', [CitasController::class,'CargarAllCitas']);
Route::post('/AdminCitas/VerDetallesCita', [CitasController::class,'VerDetallesCita']);
Route::post('/AdminCitas/VerCitasPac', [CitasController::class,'VerCitasPac']);



// GESTIONAR TRATAMIENTOS
Route::get('/AdminPacientes/Tratamientos', [PacientesController::class,'Tratamientos']);
Route::post('/AdminPacientes/GuardarTratamiento', [PacientesController::class,'GuardarTratamiento']);
Route::post('/AdminPacientes/GuardarSeccion', [AdminPacientes::class,'GuardarSeccion']);
