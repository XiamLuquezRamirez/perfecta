<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servicios extends Model
{
    public static function guardar($request)
    {

        $respuesta = DB::connection('mysql')->table('servicios')->insertGetId([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            'descuento' => $request['descuento'],
            'valor' => $request['valor'],
            'estado' => 'ACTIVO'
        ]);

        return $respuesta;
    }

    public static function editar($request)
    {
        $respuesta = DB::connection('mysql')->table('servicios')->where('id', $request['idServicio'])->update([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            'descuento' => $request['descuento'],
            'valor' => $request['valor']
        ]);
        return "ok";
    }

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('servicios')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }

    public static function BuscarServicio($id)
    {
        return DB::connection('mysql')->table('servicios')
            ->where('id', $id)
            ->first();
    }
    public static function BuscarAllServicio()
    {
        return DB::connection('mysql')->table('servicios')
            ->where('estado', "ACTIVO")
            ->get();
    }
}
