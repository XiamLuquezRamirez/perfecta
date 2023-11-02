<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Citas;



class CitasController extends Controller
{
    public function CargarDisponibilidad() {
        $idProf =  request()->get('idProf');
        $disponibilidad = Citas::CitasProfesional($idProf);

        if (request()->ajax()) {
            return response()->json([
                'disponibilidad' => $disponibilidad,
            ]);
        }
    }

    public function GuardarCita()
    {
        if (Auth::check()) {
            $data = request()->all();
            $cita = Citas::GuardarCitas($data);

            if($data['notCliente'] == "si"){

            }


        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
}
