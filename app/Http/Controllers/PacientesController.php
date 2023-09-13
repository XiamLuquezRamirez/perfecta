<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function Pacientes(){
        if (Auth::check()) {
            $bandera = "";
                return view('Pacientes.GestionPacientes', compact('bandera'));
            
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

}
