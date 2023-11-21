<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tratamientos extends Model
{
    public static function guardar($request)
    {

        $respuesta = DB::connection('mysql')->table('tratamientos')->insertGetId([
            'nombre' => $request['nombre_tratamiento'],
            'paciente' => $request['idPaciente'],
            'profesional' => $request['profesional'],
            'especialidad' => $request['especialidad'],
            'estado' => 'pendiente',
            'estado_reg' => 'ACTIVO'
           
        ]);

        $respuestaTra = DB::connection('mysql')->table('tratamientos')
        ->where('id', $respuesta)
        ->first();

        return $respuestaTra;
    }

    public static function busTatamiento($idTrat){
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
        ->where('id', $idTrat)
        ->first();
        return $respuestaTra;
    }

    public static function AllActivos(){
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
        ->leftJoin("profesionales","profesionales.id","tratamientos.profesional")
        ->select("tratamientos.*", "profesionales.nombre AS nprofe")
        ->get();
        return $respuestaTra;
    }
    public static function TratamientosPacientesAct($idPac){
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
        ->leftJoin("profesionales","profesionales.id","tratamientos.profesional")
        ->select("tratamientos.*", "profesionales.nombre AS nprofe")
       ->where("paciente", $idPac)
       ->where('estado_reg', '<>','Terminados')
        ->get();
        return $respuestaTra;
    }
    public static function TratamientosPacientesOtr($idPac){
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
        ->leftJoin("profesionales","profesionales.id","tratamientos.profesional")
        ->select("tratamientos.*", "profesionales.nombre AS nprofe")
       ->where("paciente", $idPac)
       ->where('estado_reg', 'Terminados')
        ->get();
        return $respuestaTra;
    }
}
