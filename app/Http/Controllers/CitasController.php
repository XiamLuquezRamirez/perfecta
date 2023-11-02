<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
