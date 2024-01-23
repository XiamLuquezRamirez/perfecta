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

    public static function editar($data)
    {
        $respuesta = DB::connection('mysql')->table('evoluciones')->where('id', $data['idEvo'])->update([
            'pavance' => $data['pavance'],
            'evolucion' => $data['evolucion_escrita'],
        ]);
        return $data['idEvo'];
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
    public static function ConsultarEvolucionEdit($evo){

        $respuesta = DB::connection('mysql')->table('evoluciones')
        ->where('id', $evo)
        ->first();

        return $respuesta;

    }

    public static function delArchivo($idArchivo){
        $delArchivo = DB::connection('mysql')->table('archivos_evolucion')
        ->where('id', $idArchivo)
        ->delete();

        return "ok";
    }

    public static function ConsultarEvoluciones($trata){

        $respuesta = DB::connection('mysql')->table('evoluciones')
        ->leftJoin("profesionales", "profesionales.id", "evoluciones.profesional")
        ->leftJoin("servicios_tratamiento", "servicios_tratamiento.id", "evoluciones.servicio")
        ->leftJoin("servicios", "servicios.id", "servicios_tratamiento.servicio")
        ->leftJoin("tratamientos","tratamientos.id","evoluciones.tratamiento")
        ->leftJoin("secciones","secciones.id","evoluciones.seccion")
        ->where('evoluciones.tratamiento', $trata)
        ->where('evoluciones.estado', 'ACTIVO')
        ->select("evoluciones.*", "profesionales.nombre AS nprofe", "servicios.nombre AS nservicio","tratamientos.nombre AS ntratamiento","secciones.nombre AS nseccion")
        ->get();

        return $respuesta;

    }

    public static function guardarArcEvol($data,$evo)
    {

        foreach ($data["archivo"] as $key => $val) {
            $respuesta = DB::connection('mysql')->table('archivos_evolucion')->insert([
                'evolucion' => $evo,
                'archivo' => $data["archivo"][$key],
                'tipo' => $data["tipoArc"][$key],
                'nombre' => $data["nombre"][$key]
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

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('evoluciones')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }
    public static function updatePorcAvance($serv, $pavance)
    {
        return DB::connection('mysql')->table('servicios_tratamiento')->where('id', $serv)->update([
            'avance' => $pavance,
        ]);
    }


}
