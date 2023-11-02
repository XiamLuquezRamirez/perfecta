<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    public static function guardar($request)
    {

        $fechaFormateada = date("Y-m-d", strtotime(str_replace('/', '-', $request['nacimiento'])));
        $respuesta = DB::connection('mysql')->table('pacientes')->insertGetId([
            'tipo_identificacion' => $request['tipoId'],
            'identificacion' => $request['identificacion'],
            'nombre' => $request['nombre'],
            'apellido' => $request['apellido'],
            'sexo' => $request['sexo'],
            'fecha_nacimiento' => $fechaFormateada,
            'email' => $request['email'],
            'direccion' => $request['direccion'],
            'ciudad' => $request['ciudad'],
            'telefono' => $request['telefono'],
            'observaciones' => $request['observaciones'],
            'foto' => $request['img'],
            'estado' => 'ACTIVO'
        ]);

        return  $respuesta;
    }

    public static function editar($request)
    {
        $fecha= explode('/', $request['nacimiento']);

        $respuesta = DB::connection('mysql')->table('pacientes')->where('id', $request['idPaciente'])->update([
            'tipo_identificacion' => $request['tipoId'],
            'identificacion' => $request['identificacion'],
            'nombre' => $request['nombre'],
            'apellido' => $request['apellido'],
            'sexo' => $request['sexo'],
            'fecha_nacimiento' => $fecha[2].'-'.$fecha[1].'-'.$fecha[0],
            'email' => $request['email'],
            'direccion' => $request['direccion'],
            'ciudad' => $request['ciudad'],
            'telefono' => $request['telefono'],
            'observaciones' => $request['observaciones'],
            'foto' => $request['img'],
        ]);
        return  "ok";
    }

    public static function BuscarPaciente($id)
    {
        return DB::connection('mysql')->table('pacientes')
            ->where('id', $id)
            ->first();
    }
}
