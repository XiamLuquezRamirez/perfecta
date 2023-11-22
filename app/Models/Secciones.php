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

    public static function buscSeccion($idSec){
        $respuestaSecc = DB::connection('mysql')->table('secciones')
        ->where('id', $idSec)
        ->first();

        return $respuestaSecc;
    }
    

}
