<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Citas extends Model
{
    public static function CitasProfesional($idProf)
    {
        return DB::connection('mysql')->table('citas')
            ->join('pacientes', 'citas.paciente', '=', 'pacientes.id')
            ->select('citas.*', 'pacientes.nombre', 'pacientes.apellido')
            ->where('profesional', $idProf)
            ->where('citas.estado', 'Activa')
            ->get();
    }

    public static function AllCitas()
    {
        return DB::connection('mysql')->table('citas')
            ->join('pacientes', 'citas.paciente', '=', 'pacientes.id')
            ->join('profesionales', 'citas.profesional', 'profesionales.id')
            ->select('citas.*', 'pacientes.nombre', 'pacientes.apellido', 'profesionales.nombre AS nomprof')
            ->where('citas.estado', 'Activa')
            ->get();
    }

    public static function GuardarCitas($request)
    {
       
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
