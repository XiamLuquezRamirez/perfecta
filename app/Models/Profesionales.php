<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profesionales extends Model
{
    public static function guardar($request, $usu)
    {

        $respuesta = DB::connection('mysql')->table('profesionales')->insertGetId([
            'identificacion' => $request['identificacion'],
            'nombre' => $request['nombre'],
            'correo' => $request['email'],
            'usuario' => $usu,
            'celular' => $request['telefono'],
            'estado' => 'ACTIVO',
        ]);

        return $respuesta;
    }

    public static function BuscarProfesional($id)
    {
        return DB::connection('mysql')->table('profesionales')
            ->leftJoin("users", "users.id", "profesionales.usuario")
            ->select("profesionales.*", "users.login_usuario", "users.estado_cuenta")
            ->where('profesionales.id', $id)
            ->first();
    }

    
    public static function editar($request)
    {
        $respuesta = DB::connection('mysql')->table('profesionales')->where('id', $request['idProfesional'])->update([
            'identificacion' => $request['identificacion'],
            'nombre' => $request['nombre'],
            'correo' => $request['email'],
            'celular' => $request['telefono']
        ]);
        return "ok";
    }

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('profesionales')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }

    public static function AllProfesional()
    {
        return DB::connection('mysql')->table('profesionales')
            ->where('estado', 'ACTIVO')
            ->get();
    }

}
