<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    public static function login($request)
    {
        $usuario = DB::connection("mysql")->select("select * from users where login_usuario ='" . $request['usuario'] . "' AND estado='ACTIVO'");

        if (!empty($usuario)) {
            $usuario = $usuario[0];

            if (\Hash::check($request['pasword'], $usuario->pasword_usuario)) {
                auth()->loginUsingId($usuario->id);

                return $usuario;
            }
        }

        return false;
    }

    public static function Guardar($data)
    {

        $respuesta = DB::connection('mysql')->table('users')->insertGetId([
            'nombre_usuario' => $data['nombre'],
            'login_usuario' => $data['usuario'],
            'pasword_usuario' => bcrypt($data['pasword']),
            'tipo_usuario' => 'Profesional',
            'email_usuario' => $data['email'],
            'estado_cuenta' => $data['estado'],
            'estado' => 'ACTIVO',
        ]);

        return $respuesta;

    }

    public static function editar($request)
    {
        if ($request['pasword'] != "") {
            $respuesta = DB::connection('mysql')->table('users')->where('id', $request['idUsuario'])->update([
                'nombre_usuario' => $request['nombre'],
                'login_usuario' => $request['usuario'],
                'pasword_usuario' => bcrypt($request['pasword']),
                'email_usuario' => $request['email'],
                'estado_cuenta' => $request['estado'],
            ]);
        } else {
            $respuesta = DB::connection('mysql')->table('users')->where('id', $request['idUsuario'])->update([
                'nombre_usuario' => $request['nombre'],
                'login_usuario' => $request['usuario'],
                'email_usuario' => $request['email'],
                'estado_cuenta' => $request['estado'],
            ]);
        }
        return "ok";
    }

    public static function BuscarUsuario($login)
    {
        return DB::connection('mysql')->table('users')
            ->where('login_usuario', $login)
            ->first();
    }
    public static function verifUsuario($usu)
    {
        return DB::connection('mysql')->table('users')
            ->where('login_usuario', $usu)
            ->where('login_usuario', '<>', Auth::user()->login_usuario)
            ->get();
    }

    public static function cambiosPerfil($request) {

        if ($request['cambioPasw'] != "") {
            $respuesta = DB::connection('mysql')->table('users')->where('id', Auth::user()->id)->update([
                'nombre_usuario' => $request['nombre'],
                'login_usuario' => $request['usuario'],
                'pasword_usuario' => bcrypt($request['cambioPasw']),
                'email_usuario' => $request['email'],
                'telefono' => $request['telefono'],
                'foto' => $request['img']
            ]);
        } else {
            $respuesta = DB::connection('mysql')->table('users')->where('id',  Auth::user()->id)->update([
                'nombre_usuario' => $request['nombre'],
                'login_usuario' => $request['usuario'],
                'email_usuario' => $request['email'],
                'telefono' => $request['telefono'],
                'foto' => $request['img']
            ]);
        }
        return  "ok";

    }

}
