<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Citas extends Model
{
    public static function CitasProfesional($idProf)
    {
        return DB::connection('mysql')->table('citas')
        ->where('profesional', $idProf)
            ->where('estado', 'ACTIVO')
            ->get();
    }
}
