<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tarea';
    protected $primaryKey = 'idTarea';

    public $timestamps = true;

    protected $fillable = [
        'idReporte',
        'idEmpleado',
        'fecha_asignacion',
        'estado_tarea',
        'descripcion',
    ];

    // Relaciones
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'idReporte', 'idReporte');
    }
}
