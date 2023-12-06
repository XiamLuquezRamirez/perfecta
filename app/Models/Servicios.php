<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servicios extends Model
{
    public static function guardar($request)
    {

        $respuesta = DB::connection('mysql')->table('servicios')->insertGetId([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            'descuento' => $request['descuento'],
            'valor' => $request['valor'],
            'estado' => 'ACTIVO'
        ]);

        return $respuesta;
    }

    public static function guardarServTerm($ser,$tran){
        $respuesta = DB::connection('mysql')->table('servicios_abonados')->insertGetId([
            'transaccion' => $tran,
            'servicio' => $ser
         
        ]);

        return $respuesta;
    }

    public static function ConultservTerminado($tran) {
        $serv = DB::connection("mysql")->select("select ser.nombre, st.valor from servicios_abonados sa 
        left join servicios_tratamiento st on sa.servicio=st.id
        left join servicios ser on st.servicio=ser.id
        where sa.transaccion=".$tran);

        return $serv;

    }

    public static function editar($request)
    {
        $respuesta = DB::connection('mysql')->table('servicios')->where('id', $request['idServicio'])->update([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            'descuento' => $request['descuento'],
            'valor' => $request['valor']
        ]);
        return "ok";
    }

  public static function updateSaldoServicio($data){

    $valorTotal = $data['totalServText'];
    $valorAbono = $data['valorAbono'];
    $valorAbonoPrev = $data['valorAbonoPrev'];
    $abonoPrev = 0;
    $collectServTerm = collect();
  
    if($data['selAbono']=="si"){
        $abonoPrevCal = $valorTotal - $valorAbono;
        if($abonoPrevCal < 0){
            $abonoPrev = $valorAbono-$valorTotal;
        }
        $valorTotal = $valorAbono;
    }

    $valorTotal = $valorTotal + $valorAbonoPrev;
    
    

    foreach ($data["dataIds"] as $key => $val) {
     
        $consulSaldo = DB::connection('mysql')->table('servicios_tratamiento')
        ->where('id', $data["dataIds"][$key])
        ->first();
        
        $saldoServ = $consulSaldo->valor - $consulSaldo->pagado;
       
        if($saldoServ <= $valorTotal){
            $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->where('id', $data["dataIds"][$key])->update([
                'pagado' => $consulSaldo->valor,
                'estado_pago' => 'Pagado',
            ]);
            $collectServTerm->push($data["dataIds"][$key]);
        }else{
            if($valorTotal<0){
                $valorTotal = 0;
            }
            $respuesta = DB::connection('mysql')->table('servicios_tratamiento')->where('id', $data["dataIds"][$key])->update([
                'pagado' => $valorTotal
            ]);
        }

        $valorTotal = $valorTotal - $saldoServ;
        
    }

    $resultado = [
        'valorTotal' => $valorTotal,
        'collectServTerm' => $collectServTerm->toArray(),
    ];

    return $resultado;


  }

  public static function buscSeccServPac($idPaci)
  {
      $respuestaSecc = DB::connection('mysql')->table('servicios_tratamiento')          
          ->where('estado', "ACTIVO")
          ->where('paciente', $idPaci)
          ->where('estado_serv', "Terminado")
          ->get();

      return $respuestaSecc;
  }

    public static function Eliminar($id)
    {
        return DB::connection('mysql')->table('servicios')->where('id', $id)->update([
            'estado' => 'ELIMINADO',
        ]);
    }

    public static function BuscarServicio($id)
    {
        return DB::connection('mysql')->table('servicios')
            ->where('id', $id)
            ->first();
    }
    public static function BuscarAllServicio()
    {
        return DB::connection('mysql')->table('servicios')
            ->where('estado', "ACTIVO")
            ->get();
    }



}
