<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consignacion extends Model
{
    public static function guardar($request)
    {

        $fechaPago = date("Y-m-d", strtotime(str_replace('/', '-', $request['fecPago'])));

        $respuesta = DB::connection('mysql')->table('consignaciones')->insertGetId([
            'descripcion' => $request['descripcion'],
            'fecha' => $fechaPago,
            'banco' => $request['banco'],
            'ncuenta' => $request['ncuenta'],
            'nconsignacion' => $request['nconsignacion'],
            'valor' => $request['valor'],       
            'estado' => 'ACTIVO'
        ]);

        return $respuesta;
    }

    
    public static function editar($request)
    {

        $fechaPago = date("Y-m-d", strtotime(str_replace('/', '-', $request['fecPago'])));

        $respuesta = DB::connection('mysql')->table('consignaciones')->where('id', $request['idConsignacion'])->update([
            'descripcion' => $request['descripcion'],
            'fecha' => $fechaPago,
            'banco' => $request['banco'],
            'ncuenta' => $request['ncuenta'],
            'nconsignacion' => $request['nconsignacion'],
            'valor' => $request['valor']
        ]);
        return "ok";
    }

    

    public static function BuscarConsig($id)
    {
        return DB::connection('mysql')->table('consignaciones')
            ->where('id', $id)
            ->first();
    }

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('consignaciones')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }

    public static function consigCaja($fecIni)
    {
        // Convierte la fecha de inicio a un objeto DateTime
        $fechaInicio = new  \DateTime($fecIni);

        // Utiliza la fecha y hora actual como el último momento
        $fechaFin = new  \DateTime();

        $recaudoMes = DB::connection('mysql')
            ->table('consignaciones')
            ->whereBetween('fecha', [$fechaInicio->format('Y-m-d'), $fechaFin->format('Y-m-d')])
            ->where("estado","ACTIVO")
            ->get();

        return $recaudoMes;
    }
}
