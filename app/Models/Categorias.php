<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categorias extends Model
{
    public static function AllCategorias()
    {
        return DB::connection('mysql')->table('categorias')
            ->where('estado', 'ACTIVO')
            ->get();
    }

    public static function guardar($request)
    {
        $respuesta = DB::connection('mysql')->table('categorias')->insertGetId([
            'descripcion' => $request['descripcionCategoria'],
            'estado' => 'ACTIVO'
        ]);

        return $respuesta;
    }

    public static function editar($request)
    {
        $respuesta = DB::connection('mysql')->table('categorias')->where('id', $request['idCategoria'])->update([
            'descripcion' => $request['descripcionCategoria']
        ]);
        return "ok";
    }

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('categorias')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }
}
