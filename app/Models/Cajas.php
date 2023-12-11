<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cajas extends Model
{
    public static function guardar($request)
    {
        $fechaApert = date("Y-m-d H:i:s");

        $respuesta = DB::connection('mysql')->table('cajas')->insertGetId([
            'usuario' => Auth::user()->id,
            'saldo_anterior' => $request['saldoAnte'],
            'abono_inicial' => $request['abono'],
            'saldo_inicial' => $request['saldoAnte'] + $request['abono'],
            'fecha_apertura' => $fechaApert,
            'fecha_cierre' => '',
            'recaudos' => '',
            'gastos' => '',
            'saldo_cierre' => '',
            'estado_caja' => 'Abierta',
            'estado_reg' => 'ACTIVO'
        ]);

        return $respuesta;
    }

    public static function BuscarCajas($idCaja)
    {
        return DB::connection('mysql')->table('cajas')
            ->leftJoin("users", "users.id", "cajas.usuario")
            ->select("cajas.*", "users.nombre_usuario")
            ->where('cajas.id', $idCaja)
            ->first();
    }

    public static function CambioEstado($idCaja, $request)
    {

        $respuesta = DB::connection('mysql')->table('cajas')->where('id', $idCaja)->update([
            'fecha_cierre' => $request[''],
            'recaudos' => $request[''],
            'gastos' => $request[''],
            'saldo_cierre' => $request[''],
            'estado_caja' => 'Cerrada'
        ]);
        return "ok";

    }
}
