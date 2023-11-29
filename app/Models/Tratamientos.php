<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Tratamientos extends Model
{
    public static function guardar($request)
    {

        $respuesta = DB::connection('mysql')->table('tratamientos')->insertGetId([
            'nombre' => $request['nombre_tratamiento'],
            'paciente' => $request['idPaciente'],
            'profesional' => $request['profesional'],
            'especialidad' => $request['especialidad'],
            'estado' => 'pendiente',
            'estado_reg' => 'ACTIVO',
            'estado_pago' => 'pendiente'

        ]);

        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->where('id', $respuesta)
            ->first();

        return $respuestaTra;
    }


    public static function guardarTransaccion($data){

        $respuesta = DB::connection('mysql')->table('transaccion')->insertGetId([
            'tratamiento' => $data['tratamientoSel'],
            'pago_total' => $data['totalServText'],
            'abono_libre' => $data['valorAbono'],
            'usuario' => Auth::user()->id,
            'estado' => 'ACTIVO'

        ]);
      
        return $respuesta;

    }
    
    public static function guardarMediosPago($data,$idTransaccion){
        
        foreach ($data["medioPago"] as $key => $val) {
            $respuesta = DB::connection('mysql')->table('medio_pagos_tratamiento')->insert([
                'transaccion' => $idTransaccion,
                'tratamiento' =>  $data['tratamientoSel'],
                'medio_pago' => $data["medioPago"][$key],
                'valor' => $data["valorPago"][$key],
                'referencia' => $data["referenciaPago"][$key]
            ]);
        }

        return $respuesta;

    }

    public static function eliminarTrata($trat)
    {

        $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $trat)->update([
            'estado_reg' => 'ELIMINADO',
        ]);
        return "ok";

    }

    public static function updateTrata($idTrata,$aboPrev){

        $consulEstadoServ = DB::connection('mysql')->table('servicios_tratamiento')
        ->where('tratamiento', $idTrata)
        ->get();

        if($consulEstadoServ->count() > 0){
            $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $idTrata)->update([
                'saldo_previo' => $aboPrev
            ]);
        }else{
            $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $idTrata)->update([
                'saldo_previo' => $aboPrev,
                'estado_pago' => 'Pagado'
            ]);
        }
        
       
        return "ok";
    }

    public static function editar($request)
    {
        $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $request['idTratamiento'])->update([
            'nombre' => $request['nombre_tratamiento'],
            'profesional' => $request['profesional'],
            'especialidad' => $request['especialidad'],
        ]);
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->where('id', $request['idTratamiento'])
            ->first();

        return $respuestaTra;
    }

    public static function busTatamiento($idTrat)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->where('id', $idTrat)
            ->first();
        return $respuestaTra;
    }

    public static function consulAllServ($idTrat)
    {
        $respuestaTra = DB::connection('mysql')->table('servicios_tratamiento')
            ->leftJoin("servicios", "servicios.id", "servicios_tratamiento.servicio")
            ->where('tratamiento', $idTrat)
            ->where("servicios_tratamiento.estado", "ACTIVO")
            ->select("servicios_tratamiento.*", "servicios.nombre")
            ->get();
        return $respuestaTra;
    }

    public static function AllActivos()
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe")
            ->get();
        return $respuestaTra;
    }

    public static function TratamientosPacientesAct($idPac)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe")
            ->where("paciente", $idPac)
            ->where('tratamientos.estado', '<>', 'Terminados')
            ->where('tratamientos.estado_reg', 'ACTIVO')
            ->get();
        return $respuestaTra;
    }

    public static function TratamientosPacientesRecaudo($idPac)
    {
        $respuestaTra = DB::connection("mysql")->select("SELECT st.*,tr.id, tr.saldo_previo sprev, tr.nombre AS ntrara, prof.nombre nprof, CONCAT(pac.identificacion,' - ',pac.nombre, ' ',pac.apellido) AS npac FROM servicios_tratamiento st 
        LEFT JOIN tratamientos tr ON st.tratamiento= tr.id
        LEFT JOIN profesionales prof ON tr.profesional= prof.id
        LEFT JOIN pacientes pac ON tr.paciente= pac.id
        WHERE tr.paciente=".$idPac." AND st.estado='ACTIVO'");
       
        return $respuestaTra;
    }

    public static function TratamientosPacientesOtr($idPac)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe")
            ->where("paciente", $idPac)
            ->where('tratamientos.estado', 'Terminados')
            ->where('tratamientos.estado_reg', 'ACTIVO')
            ->get();
        return $respuestaTra;
    }
}
