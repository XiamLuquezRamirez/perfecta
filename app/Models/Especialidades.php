<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Especialidades extends Model
{
    public static function AllEspecialidades(){
        return DB::connection('mysql')->table('especialidades')
        ->where('estado', 'ACTIVO')
        ->get();
    }
}
