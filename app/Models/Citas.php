<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Citas extends Model
{
    public static function CitasProfesional($idProf)
    {
        return DB::connection('mysql')->table('citas')
            ->join('pacientes', 'citas.paciente', '=', 'pacientes.id')
            ->select('citas.*', 'pacientes.nombre', 'pacientes.apellido')
            ->where('profesional', $idProf)
            ->where('citas.estado', '!=', 'Anulada')
            ->get();
    }
    public static function CitasPaciente($idPac)
    {
        return DB::connection('mysql')->table('citas')
            ->where('paciente', $idPac)
            ->where('citas.estado', '!=', 'Anulada')
            ->get();
    }

    public static function AllCitas()
    {
        return DB::connection('mysql')->table('citas')
            ->join('pacientes', 'citas.paciente', '=', 'pacientes.id')
            ->join('profesionales', 'citas.profesional', 'profesionales.id')
            ->select('citas.*', 'pacientes.nombre', 'pacientes.apellido', 'profesionales.nombre AS nomprof')
            ->where('citas.estado', '!=', 'Anulada')
            ->get();
    }
    public static function AllCitasHoy()
    {
        return DB::connection('mysql')->table('citas')
            ->where('citas.estado', '!=', 'Anulada')
            ->whereDate('citas.inicio', now()->format('Y-m-d'))
            ->get();
    }

    public static function buscaDetCitas($idCita)
    {
        return DB::connection('mysql')->table('citas')
            ->leftJoin('profesionales', 'citas.profesional', 'profesionales.id')
            ->leftJoin('especialidades', 'especialidades.id', 'citas.motivo')
            ->select('citas.*', 'profesionales.nombre AS nomprof', 'especialidades.nombre AS nespec')
            ->where('citas.id', $idCita)
            ->first();
    }
    public static function buscaCitasPacientes($idCita)
    {
        return DB::connection('mysql')->table('citas')
            ->join('profesionales', 'citas.profesional', 'profesionales.id')
            ->select('citas.*', 'profesionales.nombre AS nomprof')
            ->where('citas.paciente', $idCita)
            ->get();
    }

    public static function CambioEstadocita($idCita, $estado)
    {

        $respuesta = DB::connection('mysql')->table('citas')->where('id', $idCita)->update([
            'estado' => $estado,
        ]);
        return "ok";

    }

    public static function GuardarCitas($request)
    {
        $respuesta = DB::connection('mysql')->table('citas')->insertGetId([
            'paciente' => $request['idpac'],
            'profesional' => $request['profesional'],
            'motivo' => $request['motivo'],
            'inicio' => $request['fechaHoraInicio'],
            'final' => $request['fechaHoraFinal'],
            'comentario' => $request['comentario'],
            'duracion' => $request['duracionCita'],
            'estado' => "Por atender"
        ]);

        return $respuesta;
    }

    public static function EditarCitas($request){
        $respuesta = DB::connection('mysql')->table('citas')->where('id', $request['idCitaPac'])->update([
            'profesional' => $request['profesional'],
            'motivo' => $request['motivo'],
            'inicio' => $request['fechaHoraInicio'],
            'final' => $request['fechaHoraFinal'],
            'duracion' => $request['duracionCita'],
            'comentario' => $request['comentario']
        ]);
        return "ok";
    }
    public static function GuardarComentario($request){
        $respuesta = DB::connection('mysql')->table('citas')->where('id', $request['idCit'])->update([
            'comentario' => $request['comentarioCitaVal'],
        ]);
        return "ok";
    }
}
