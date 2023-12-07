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

    public static function GastosCaja($fecIni)
    {
        // Convierte la fecha de inicio a un objeto DateTime
        $fechaInicio = new  \DateTime($fecIni);

        // Utiliza la fecha y hora actual como el último momento
        $fechaFin = new  \DateTime();

        $recaudoMes = DB::connection('mysql')
            ->table('gastos')
            ->whereBetween('fecha_pago', [$fechaInicio->format('Y-m-d'), $fechaFin->format('Y-m-d')])
            ->sum('valor');

        return $recaudoMes;
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
