<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Citas extends Model
{
    public static function CitasProfesional($idProf)
    {
        return DB::connection('mysql')->table('citas')
        ->where('profesional', $idProf)
            ->where('estado', 'Activa')
            ->get();
    }

    public static function GuardarCitas($request){
        $respuesta = DB::connection('mysql')->table('citas')->insertGetId([
            'paciente' => $request['idpac'],
            'profesional' => $request['profesional'],
            'motivo' => $request['motivo'],
            'inicio' => $request['fechaHoraInicio'],
            'final' => $request['fechaHoraFinal'],
            'estado' => "Activa",
        ]);

        return $respuesta;
    }
}
