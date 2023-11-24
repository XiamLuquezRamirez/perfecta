<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Secciones extends Model
{
    public static function guardar($request, $trata)
    {

        $respuesta = DB::connection('mysql')->table('secciones')->insertGetId([
            'nombre' => $request['nombreSeccion'],
            'descripcion' => $request['descripcionSeccion'],
            'tratamiento' => $trata,
            'estado' => 'ACTIVO'
        ]);

        $respuestaSecc = DB::connection('mysql')->table('secciones')
        ->where('id', $respuesta)
        ->first();

        return $respuestaSecc;
    }

    public static function guardarServ($request,$idSecc,$idTrata,$idPac)
    {
        if($request["origServicio"]=="secc"){
            $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->insertGetId([
                'servicio' => $request['servicioTrat'],
                'seccion' => $idSecc,
                'tratamiento' => $idTrata,
                'paciente' => $idPac,
                'valor' => $request['valor'],
                'avance' => '0',
                'estado' => 'ACTIVO'
            ]);
        }else{
            $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->insertGetId([
                'servicio' => $request['servicioTrat'],
                'seccion' => "0",
                'tratamiento' => $idTrata,
                'paciente' => $idPac,
                'valor' => $request['valor'],
                'avance' => '0',
                'estado' => 'ACTIVO'
            ]);
            
        }
     
        return $respuesta;
    }


    public static function editarServ($data){

        $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->where('id', $data['idServicio'])->update([
            'servicio' => $data['servicioTrat'],
            'valor' => $data['valor']
        ]);
        return "ok";

    }
    public static function editarSeccion($data){

        $respuesta = DB::connection('mysql')->table('secciones')->where('id', $data['idSeccion'])->update([
            'nombre' => $data['nombreSeccion'],
            'descripcion' => $data['descripcionSeccion']
        ]);
        $respuestaSecc = DB::connection('mysql')->table('secciones')
        ->where('id', $data['idSeccion'])
        ->first();

        return $respuestaSecc;

    }
    public static function eliminarServ($serv){

        $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->where('id', $serv)->update([
            'estado' => 'ELIMINADO'
        ]);
        return "ok";

    }

    public static function eliminarSeccion($secc){

        $respuesta = DB::connection('mysql')->table('secciones')->where('id', $secc)->update([
            'estado' => 'ELIMINADO'
        ]);
        return "ok";

    }

    public static function buscSeccion($idSec){
        $respuestaSecc = DB::connection('mysql')->table('secciones')
        ->where('id', $idSec)
        ->first();

        return $respuestaSecc;
    }

    public static function buscSecc($idTrata){
        $respuestaTrata = DB::connection('mysql')->table('secciones')
        ->where('tratamiento', $idTrata)
        ->get();

        return $respuestaTrata;
    }
    public static function buscServSecc($idSec){
        $respuestaSecc = DB::connection('mysql')->table('servicios_tratamiento')
        ->leftJoin("servicios","servicios.id","servicios_tratamiento.servicio")
        ->select("servicios_tratamiento.*", "servicios.nombre")
        ->where("servicios_tratamiento.estado","ACTIVO")
        ->where('seccion', $idSec)
        ->get();

        return $respuestaSecc;
    }
    
    public static function BuscarServicioEdit($idServ){
        $respuestaSecc = DB::connection('mysql')->table('servicios_tratamiento')
        ->leftJoin("servicios","servicios.id","servicios_tratamiento.servicio")
        ->select("servicios_tratamiento.*", "servicios.descuento")
        ->where('servicios_tratamiento.id', $idServ)
        ->first();

        return $respuestaSecc;
    }

    public static function busTotalSeccion($idSec){
        $totSeccion = DB::connection("mysql")->select("SELECT SUM(valor) AS totseccion FROM  servicios_tratamiento WHERE seccion = ".$idSec." AND estado='ACTIVO' GROUP BY seccion");
        if($totSeccion){
            return $totSeccion[0]->totseccion;
        }else{
            return 0;
        }
        
        
    }

    public static function allSeviciosTrat($idTrat){
        $respuestaServ = DB::connection('mysql')->table('servicios_tratamiento')
        ->where('tratamiento', $idTrat)
        ->get();

        return $respuestaServ;
    }
    

}
