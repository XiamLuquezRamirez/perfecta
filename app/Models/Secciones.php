<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Secciones extends Model
{
    public static function guardar($request)
    {

        $respuesta = DB::connection('mysql')->table('secciones')->insertGetId([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            'estado' => 'ACTIVO'
        ]);

        $respuestaSecc = DB::connection('mysql')->table('secciones')
        ->where('id', $respuesta)
        ->first();

        return $respuestaSecc;
    }

}
