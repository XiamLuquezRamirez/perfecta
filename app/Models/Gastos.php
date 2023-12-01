<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gastos extends Model
{
    public static function guardar($request)
    {
        $fechaGasto = date("Y-m-d", strtotime(str_replace('/', '-', $request['fecGasto'])));

        $fechaPago = date("Y-m-d", strtotime(str_replace('/', '-', $request['fecPago'])));

        $respuesta = DB::connection('mysql')->table('gastos')->insertGetId([
            'descripcion' => $request['descripcion'],
            'categoria' => $request['categoria'],
            'valor' => $request['valor'],
            'fecha_gasto' => $fechaGasto,
            'fecha_pago' => $fechaPago,
            'estado' => 'ACTIVO'
        ]);

        return $respuesta;
    }

    public static function editar($request)
    {

        $fechaGasto = date("Y-m-d", strtotime(str_replace('/', '-', $request['fecGasto'])));

        $fechaPago = date("Y-m-d", strtotime(str_replace('/', '-', $request['fecPago'])));

        $respuesta = DB::connection('mysql')->table('gastos')->where('id', $request['idGastos'])->update([
            'descripcion' => $request['descripcion'],
            'categoria' => $request['categoria'],
            'valor' => $request['valor'],
            'fecha_gasto' => $fechaGasto,
            'fecha_pago' => $fechaPago
        ]);
        return "ok";
    }


    public static function BuscarGastos($id)
    {
        return DB::connection('mysql')->table('gastos')
            ->where('id', $id)
            ->first();
    }

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('gastos')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }
}
