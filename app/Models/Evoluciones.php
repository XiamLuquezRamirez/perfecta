<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Evoluciones extends Model
{
    public static function guardar($data,$idSecc,$idTrata,$idPac,$idSer)
    {

        $respuesta = DB::connection('mysql')->table('evoluciones')->insertGetId([
            'tratamiento' => $idTrata,
            'seccion' => $idSecc,
            'servicio' => $idSer,
            'paciente' => $idPac,
            'profesional' => $data['profesionalEvolucion'],
            'pavance' => $data['pavance'],
            'evolucion' => $data['evolucion_escrita'],
            'estado' => 'ACTIVO'
        ]);

        $respuestaSecc = DB::connection('mysql')->table('evoluciones')
        ->where('id', $respuesta)
        ->first();

        return $respuestaSecc;
    }

    public static function ConsultarEvolucionesServ($serv){

        $respuesta = DB::connection('mysql')->table('evoluciones')
        ->leftJoin("profesionales", "profesionales.id", "evoluciones.profesional")
        ->leftJoin("servicios_tratamiento", "servicios_tratamiento.id", "evoluciones.servicio")
        ->leftJoin("servicios", "servicios.id", "servicios_tratamiento.servicio") 
        ->where('evoluciones.servicio', $serv)
        ->where('evoluciones.estado', 'ACTIVO')
        ->select("evoluciones.*", "profesionales.nombre AS nprofe", "servicios.nombre AS nservicio")
        ->get();

        return $respuesta;

    }

    public static function guardarArcEvol($data,$evo)
    {

        foreach ($data["archivo"] as $key => $val) {
            $respuesta = DB::connection('mysql')->table('archivos_evolucion')->insert([
                'evolucion' => $evo,
                'archivo' => $data["archivo"][$key]
            ]);
        }

        return $respuesta;
    }

    public static function consulArcEvol($evo){
        $respuesta = DB::connection('mysql')->table('archivos_evolucion')
        ->where('evolucion', $evo)
        ->get();
        return $respuesta;

    }


}
