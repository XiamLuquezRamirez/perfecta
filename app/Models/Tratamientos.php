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
            'estado_reg' => 'ACTIVO',

        ]);

        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->where('id', $respuesta)
            ->first();

        return $respuestaTra;
    }

    public static function eliminarTrata($trat)
    {

        $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $trat)->update([
            'estado_reg' => 'ELIMINADO',
        ]);
        return "ok";

    }

    public static function editar($request)
    {
        $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $request['idTratamiento'])->update([
            'nombre' => $request['nombre_tratamiento'],
            'profesional' => $request['profesional'],
            'especialidad' => $request['especialidad'],
        ]);
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->where('id', $request['idTratamiento'])
            ->first();

        return $respuestaTra;
    }

    public static function busTatamiento($idTrat)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->where('id', $idTrat)
            ->first();
        return $respuestaTra;
    }

    public static function consulAllServ($idTrat)
    {
        $respuestaTra = DB::connection('mysql')->table('servicios_tratamiento')
            ->leftJoin("servicios", "servicios.id", "servicios_tratamiento.servicio")
            ->where('tratamiento', $idTrat)
            ->where("servicios_tratamiento.estado", "ACTIVO")
            ->select("servicios_tratamiento.*", "servicios.nombre")
            ->get();
        return $respuestaTra;
    }

    public static function AllActivos()
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe")
            ->get();
        return $respuestaTra;
    }
    public static function TratamientosPacientesAct($idPac)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe")
            ->where("paciente", $idPac)
            ->where('tratamientos.estado', '<>', 'Terminados')
            ->where('tratamientos.estado_reg', 'ACTIVO')
            ->get();
        return $respuestaTra;
    }
    public static function TratamientosPacientesOtr($idPac)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe")
            ->where("paciente", $idPac)
            ->where('tratamientos.estado', 'Terminados')
            ->where('tratamientos.estado_reg', 'ACTIVO')
            ->get();
        return $respuestaTra;
    }
}
