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
            'estado_pago' => 'pendiente',
            'saldo_previo' => '0',

        ]);

        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->where('id', $respuesta)
            ->first();

        return $respuestaTra;
    }


    public static function guardarTransaccion($data)
    {
        $pagoRealizado = 0;
        if ($data['selAbono'] == "no") {
            $pagoRealizado = $data['totalServText'];
        } else {
            $pagoRealizado = $data['valorAbono'];
        }

        $respuesta = DB::connection('mysql')->table('transaccion')->insertGetId([
            'tratamiento' => $data['tratamientoSel'],
            'pago_total' => $data['totalServText'],
            'abono_libre' => $data['valorAbono'],
            'pago_realizado' => $pagoRealizado,
            'usuario' => Auth::user()->id,
            'estado' => 'ACTIVO'

        ]);

        return $respuesta;
    }

    public static function transaccionesPacientes($idPac)
    {

        return  DB::connection('mysql')->table('tratamientos')
            ->leftJoin("transaccion", "transaccion.tratamiento", "tratamientos.id")
            ->where('tratamientos.paciente', $idPac)
            ->where("transaccion.estado", "ACTIVO")
            ->select("transaccion.*", "tratamientos.nombre")
            ->orderBy("transaccion.id", "DESC")
            ->get();
    }

    public static function MediosPago($tran)
    {
        $serv = DB::connection("mysql")->select("SELECT  CASE WHEN medio_pago = 'e' THEN 'Efectivo' 
        WHEN medio_pago = 'tc' THEN 'Tarjeta de crédito'
        WHEN medio_pago = 'td' THEN 'Tarjeta de débito'
        WHEN medio_pago = 't' THEN 'Transferencia'
        END AS medpago, valor, referencia
         FROM medio_pagos_tratamiento
        WHERE  transaccion=" . $tran);

        return $serv;
    }

    public static function guardarMediosPago($data, $idTransaccion)
    {

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
    public static function guardarServAfectados($data, $idTransaccion)
    {

        foreach ($data["dataIds"] as $key => $val) {
            $respuesta = DB::connection('mysql')->table('pagos_afectados_transaccion')->insert([
                'transaccion' => $idTransaccion,
                'servicio' => $data["dataIds"][$key],
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
    public static function delTransaccion($transaccion)
    {
        $valRest = $transaccion->pago_realizado;
        $servTratamiento = DB::connection('mysql')->table('pagos_afectados_transaccion')
            ->where('transaccion', $transaccion->id)
            ->get();

        dd($servTratamiento);
        foreach ($servTratamiento as $dataServ) {
            $newValor = $dataServ->pagado - $valRest;

            if ($newValor < 0) {
                $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->where('id', $dataServ->id)->update([
                    'pagado' => '0',
                ]);

                $delServPago = DB::connection('mysql')->table('servicios_abonados')
                ->where('transaccion', $transaccion->id)
                ->where('servicio', $dataServ->id)
                ->delete();

                $newValor = abs($newValor);

            }else{
                $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->where('id', $dataServ->id)->update([
                    'pagado' => $newValor,
                ]);
            }
            
            $valRest = $newValor;
            
        }

        $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $valRest)->update([
            'estado_reg' => 'ELIMINADO',
        ]);
        return "ok";
    }

    public static function updateTrata($idTrata, $aboPrev)
    {

        $consulEstadoServ = DB::connection('mysql')->table('servicios_tratamiento')
            ->where('tratamiento', $idTrata)
            ->where("estado_pago", "Pendiente")
            ->get();

        if ($aboPrev < 0) {
            $aboPrev = 0;
        }

        if ($consulEstadoServ->count() > 0) {
            $respuesta = DB::connection('mysql')->table('tratamientos')->where('id', $idTrata)->update([
                'saldo_previo' => $aboPrev
            ]);
        } else {

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

    public static function buscTransaccion($tran)
    {
        $respuestaTra = DB::connection('mysql')->table('transaccion')
            ->where('id', $tran)
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
    public static function busTatamientoRecaudo($trata)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->leftJoin("pacientes", "pacientes.id", "tratamientos.paciente")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe", "pacientes.nombre AS npaciente", "pacientes.apellido", "pacientes.identificacion")
            ->where("tratamientos.id", $trata)
            ->first();
        return $respuestaTra;
    }

    public static function TratamientosPacientesAct($idPac)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->leftJoin("especialidades", "especialidades.id", "tratamientos.especialidad")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe", "especialidades.nombre AS nespecialidad")
            ->where("paciente", $idPac)
            ->where('tratamientos.estado', '<>', 'Terminados')
            ->where('tratamientos.estado_reg', 'ACTIVO')
            ->get();
        return $respuestaTra;
    }

    public static function TratamientosPacientes($idPac)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->leftJoin("especialidades", "especialidades.id", "tratamientos.especialidad")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe", "especialidades.nombre AS nespecialidad")
            ->where("paciente", $idPac)
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
        WHERE tr.paciente=" . $idPac . " AND st.estado='ACTIVO' AND tr.estado_pago='Pendiente'");

        return $respuestaTra;
    }

    public static function recaudosHoy()
    {
        $recaudoHoy = DB::connection('mysql')
            ->table('transaccion')
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->where("estado", "ACTIVO")
            ->sum('pago_realizado');


        return $recaudoHoy;
    }


    public static function recaudosMes()
    {
        $primerDiaDelMes = now()->startOfMonth();
        $ultimoDiaDelMes = now()->endOfMonth();

        $recaudoMes = DB::connection('mysql')
            ->table('transaccion')
            ->whereBetween('created_at', [$primerDiaDelMes, $ultimoDiaDelMes])
            ->where("estado", "ACTIVO")
            ->sum('pago_realizado');

        return $recaudoMes;
    }
    public static function recaudoCaja($fecIni)
    {
        // Convierte la fecha de inicio a un objeto DateTime
        $fechaInicio = new  \DateTime($fecIni);

        // Utiliza la fecha y hora actual como el último momento
        $fechaFin = new  \DateTime();

        $recaudoMes = DB::connection('mysql')
            ->table('transaccion')
            ->whereBetween('created_at', [$fechaInicio->format('Y-m-d H:i:s'), $fechaFin->format('Y-m-d H:i:s')])
            ->where("estado", "ACTIVO")
            ->sum('pago_realizado');

        return $recaudoMes;
    }

    public static function recaudosCajaResumen($fecIni)
    {
        // Convierte la fecha de inicio a un objeto DateTime
        $fechaInicio = new  \DateTime($fecIni);

        // Utiliza la fecha y hora actual como el último momento
        $fechaFin = new  \DateTime();

        $recaudoMes = DB::connection('mysql')
            ->table('medio_pagos_tratamiento')
            ->whereBetween('created_at', [$fechaInicio->format('Y-m-d H:i:s'), $fechaFin->format('Y-m-d H:i:s')])
            ->get();

        return $recaudoMes;
    }

    public static function TratamientosPacientesOtr($idPac)
    {
        $respuestaTra = DB::connection('mysql')->table('tratamientos')
            ->leftJoin("profesionales", "profesionales.id", "tratamientos.profesional")
            ->leftJoin("especialidades", "especialidades.id", "tratamientos.especialidad")
            ->select("tratamientos.*", "profesionales.nombre AS nprofe", "especialidades.nombre AS nespecialidad")
            ->where("paciente", $idPac)
            ->where('tratamientos.estado', 'Terminados')
            ->where('tratamientos.estado_reg', 'ACTIVO')
            ->get();
        return $respuestaTra;
    }
}
