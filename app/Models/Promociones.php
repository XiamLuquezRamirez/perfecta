<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promociones extends Model
{
    public static function guardar($request)
    {

        $respuesta = DB::connection('mysql')->table('promociones')->insertGetId([
            'titulo' => $request['titulo'],
            'contenido' => $request['contenidoPromocion'],
            'archivo' => $request['archi'],
            'estado' => 'ACTIVO'
        ]);

        return $respuesta;
    }

    public static function BuscarPromocion($id)
    {
        return DB::connection('mysql')->table('promociones')
            ->where('id', $id)
            ->first();
    }

    public static function editar($request)
    {
        $respuesta = DB::connection('mysql')->table('promociones')->where('id', $request['idPromocion'])->update([
            'titulo' => $request['titulo'],
            'contenido' => $request['contenidoPromocion'],
            'archivo' => $request['archi']
        ]);
        return "ok";
    }

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('promociones')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }
}
