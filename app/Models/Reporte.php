<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reporte';   // 
    protected $primaryKey = 'idReporte';

    protected $fillable = [
        'idReporte',
        'idUsuario',
        'idParque',
        'iddescripcion',
        'idestado',
        'fecha_reporte',
        'imaguen'
    ];
}
