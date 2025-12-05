<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tarea'; // Especificar el nombre real de la tabla
    protected $primaryKey = 'IdTarea';
    
    protected $fillable = [
        'IdReporte',
        'idEmpleado',
        'fecha_asignacion',
        'estado_tarea'
    ];
    
    protected $dates = ['fecha_asignacion'];
    
    /**
     * Relación con Reporte
     */
    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'IdReporte', 'id');
        // Ajusta 'id' si la PK de reportes es diferente
    }
    
    /**
     * Relación con Empleado
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'id');
        // Ajusta 'id' si la PK de empleados es diferente
    }
    
    /**
     * Scope para tareas pendientes
     */
    public function scopePendientes($query)
    {
        return $query->where('estado_tarea', 'pendiente');
    }
    
    /**
     * Scope para tareas por empleado
     */
    public function scopePorEmpleado($query, $empleadoId)
    {
        return $query->where('idEmpleado', $empleadoId);
    }
}