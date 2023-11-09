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
            'profesional' => $request['profesional'],
            'estado' => 'ACTIVO',
        ]);

        $respuestaTra = DB::connection('mysql')->table('tratamientos')
        ->where('id', $respuesta)
        ->first();

        return $respuestaTra;
    }
}
