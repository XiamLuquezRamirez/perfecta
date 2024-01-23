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
Route::get('/Administracion/perfil', [UsuariosController::class,'perfil']);
Route::post('/Administracion/VerificarUsuario', [UsuariosController::class,'VerificarUsuario']);
Route::post('/Administracion/UpdatePerfil', [UsuariosController::class,'UpdatePerfil']);


///GESTION PACIENTES
Route::get('/AdminPacientes/Pacientes', [PacientesController::class,'Pacientes']);
Route::post('/AdminPacientes/CargarPacientes', [PacientesController::class,'CargarPacientes']);
Route::post('/AdminPacientes/GuardarPaciente', [PacientesController::class,'GuardarPaciente']);
Route::get('/AdminPacientes/municipios', [PacientesController::class,'CargarMunicipios']);
Route::post('/AdminPacientes/ValidarPacientes', [PacientesController::class,'ValidarPacientes']);
Route::post('/AdminPacientes/BuscarPacientes', [PacientesController::class,'BuscarPacientes']);
Route::post('/AdminPacientes/AllProfesionales', [PacientesController::class,'AllProfesionales']);
Route::post('/AdminPacientes/AllEspecialidades', [PacientesController::class,'AllEspecialidades']);


//GESTIOAR ADMINISTRACCION
Route::get('/Administracion/Profesionales', [AdminitraccionController::class,'Profesionales']);
Route::get('/Administracion/Servicios', [AdminitraccionController::class,'Servicios']);
Route::post('/Administracion/CargarProfesionales', [AdminitraccionController::class,'CargarProfesionales']);
Route::post('/Administracion/CargarGastos', [AdminitraccionController::class,'CargarGastos']);
Route::post('/Administracion/CargarConsignaciones', [AdminitraccionController::class,'CargarConsignaciones']);
Route::post('/Administracion/CargarServicios', [AdminitraccionController::class,'CargarServicios']);
Route::post('/Administracion/GuardarProfesional', [AdminitraccionController::class,'GuardarProfesional']);
Route::post('/Administracion/GuardarServicio', [AdminitraccionController::class,'GuardarServicio']);
Route::post('/Administracion/ValidarProfesional', [AdminitraccionController::class,'ValidarProfesional']);
Route::post('/Administracion/BuscarProfesional', [AdminitraccionController::class,'BuscarProfesional']);
Route::post('/Administracion/BuscarGastos', [AdminitraccionController::class,'BuscarGastos']);
Route::post('/Administracion/Buscarconsignacion', [AdminitraccionController::class,'Buscarconsignacion']);
Route::post('/Administracion/BuscarServicio', [AdminitraccionController::class,'BuscarServicio']);
Route::post('/Administracion/BuscarUsuario', [AdminitraccionController::class,'BuscarUsuario']);
Route::post('/Administracion/EliminarProfesional', [AdminitraccionController::class,'EliminarProfesional']);
Route::post('/Administracion/EliminarServicio', [AdminitraccionController::class,'EliminarServicio']);
Route::post('/Administracion/EliminarCategoria', [AdminitraccionController::class,'EliminarCategoria']);
Route::post('/Administracion/EliminarGastos', [AdminitraccionController::class,'EliminarGastos']);
Route::post('/Administracion/EliminarConsignacion', [AdminitraccionController::class,'EliminarConsignacion']);
Route::get('/Administracion/Gastos', [AdminitraccionController::class,'Gastos']);
Route::get('/Administracion/Consignaciones', [AdminitraccionController::class,'Consignaciones']);
Route::get('/Administracion/Cajas', [AdminitraccionController::class,'Cajas']);
Route::post('/Administracion/cargarCategorias', [AdminitraccionController::class,'cargarCategorias']);
Route::post('/Administracion/GuardarCategoria', [AdminitraccionController::class,'GuardarCategoria']);
Route::post('/Administracion/GuardarGasto', [AdminitraccionController::class,'GuardarGasto']);
Route::post('/Administracion/GuardarConsignacion', [AdminitraccionController::class,'GuardarConsignacion']);
Route::post('/Administracion/GuardarCaja', [AdminitraccionController::class,'GuardarCaja']);
Route::post('/Administracion/CargarDatos', [AdminitraccionController::class,'CargarDatos']);
Route::post('/Administracion/CargarCajas', [AdminitraccionController::class,'CargarCajas']);
Route::post('/Administracion/ConsultarCaja', [AdminitraccionController::class,'ConsultarCaja']);
Route::post('/Administracion/CierreCaja', [AdminitraccionController::class,'CierreCaja']);


//GESTIONAR CITAS

Route::post('/AdminCitas/CargarDisponibilidad', [CitasController::class,'CargarDisponibilidad']);
Route::post('/AdminCitas/GuardarCita', [CitasController::class,'GuardarCita']);
Route::post('/AdminCitas/CargarPacientesCita', [PacientesController::class,'CargarPacientesCita']);
Route::post('/AdminCitas/CargarAllCitas', [CitasController::class,'CargarAllCitas']);
Route::post('/AdminCitas/VerDetallesCita', [CitasController::class,'VerDetallesCita']);
Route::post('/AdminCitas/VerCitasPac', [CitasController::class,'VerCitasPac']);
Route::post('/AdminCitas/CambioEstadocita', [CitasController::class,'CambioEstadocita']);
Route::post('/AdminCitas/InformacionCita', [CitasController::class,'InformacionCita']);
Route::post('/AdminCitas/GuardarComentario', [CitasController::class,'GuardarComentario']);
Route::post('/AdminCitas/cargarComentario', [CitasController::class,'cargarComentario']);
Route::post('/AdminCitas/notificaccionCita', [CitasController::class,'notificaccionCita']);



// GESTIONAR TRATAMIENTOS
Route::get('/AdminPacientes/Tratamientos', [PacientesController::class,'Tratamientos']);
Route::post('/AdminPacientes/GuardarTratamiento', [PacientesController::class,'GuardarTratamiento']);
Route::post('/AdminPacientes/GuardarSeccion', [PacientesController::class,'GuardarSeccion']);
Route::post('/AdminPacientes/GuardarServicio', [PacientesController::class,'GuardarServicio']);
Route::post('/AdminPacientes/GuardarEvolucion', [PacientesController::class,'GuardarEvolucion']);
Route::get('/AdminPacientes/PacientesTratamientos', [PacientesController::class,'PacientesTratamientos']);
Route::post('/AdminPacientes/CargarDatosPacTrat', [PacientesController::class,'CargarDatosPacTrat']);
Route::post('/AdminPacientes/SeccionesTratamientos', [PacientesController::class,'SeccionesTratamientos']);
Route::post('/AdminPacientes/AllServicios', [PacientesController::class,'AllServicios']);
Route::post('/AdminPacientes/busEditServ', [PacientesController::class,'busEditServ']);
Route::post('/AdminPacientes/busEditSecc', [PacientesController::class,'busEditSecc']);
Route::post('/AdminPacientes/busEditTrata', [PacientesController::class,'busEditTrata']);
Route::post('/AdminPacientes/EliminarServicio', [PacientesController::class,'EliminarServicio']);
Route::post('/AdminPacientes/EliminarSeccion', [PacientesController::class,'EliminarSeccion']);
Route::post('/AdminPacientes/EliminarTratamiento', [PacientesController::class,'EliminarTratamiento']);
Route::post('/AdminPacientes/ConsultarEvoluciones', [PacientesController::class,'ConsultarEvoluciones']);
Route::post('/AdminPacientes/ConsultarEvolucionesGen', [PacientesController::class,'ConsultarEvolucionesGen']);
Route::post('/AdminPacientes/ConsultarEvolucionEdit', [PacientesController::class,'ConsultarEvolucionEdit']);
Route::post('/AdminPacientes/CargarHistoricoTransacciones', [PacientesController::class,'CargarHistoricoTransacciones']);
Route::post('/AdminPacientes/DeleteTransaccion', [PacientesController::class,'DeleteTransaccion']);
Route::post('/AdminPacientes/updateServiciosTerminados', [PacientesController::class,'updateServiciosTerminados']);
Route::post('/AdminPacientes/DeleteArchivoEvolucion', [PacientesController::class,'DeleteArchivoEvolucion']);
Route::post('/AdminPacientes/DeleteEvolucion', [PacientesController::class,'DeleteEvolucion']);


// GESTIONAR RECAUDOS
Route::get('/AdminPacientes/Recaudos', [PacientesController::class,'Recaudos']);
Route::post('/AdminPacientes/TratamientosRecaudo', [PacientesController::class,'TratamientosRecaudo']);
Route::post('/AdminPacientes/TratamientosRecaudoDetalles', [PacientesController::class,'TratamientosRecaudoDetalles']);
Route::post('/AdminPacientes/GuardarPagoTratamiento', [PacientesController::class,'GuardarPagoTratamiento']);
Route::post('/AdminPacientes/envioComprobante', [PacientesController::class,'envioComprobante']);


// NOTIFICAR PACIENTES
Route::get('/Administracion/Promociones', [AdminitraccionController::class,'Promociones']);
Route::post('/Administracion/CargarPromociones', [AdminitraccionController::class,'CargarPromociones']);
Route::post('/Administracion/CargarPacientes', [AdminitraccionController::class,'CargarPacientes']);
