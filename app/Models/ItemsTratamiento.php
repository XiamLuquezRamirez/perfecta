<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemsTratamiento extends Model
{
    public static function guardar($serv, $tserv,$trat)
    {
        $respuesta = DB::connection('mysql')->table('item_tratamientos')->insertGetId([
            'tratamiento' => $trat,
            'tip_servi' => $tserv,
            'id_servi' => $serv
        ]);

        
        return $respuesta;
    }


    public static function consulAllItem($trat){

        $itemTrat = DB::connection('mysql')->table('item_tratamientos')
        ->where('tratamiento', $trat)
        ->orderBy('id', 'desc')
        ->get();
        return $itemTrat;

    }
}
