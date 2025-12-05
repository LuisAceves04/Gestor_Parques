<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    
    protected $fillable = [
        'Nombre',
        'apellido',
        'telefono',
        'email',
        'id_departamento'
    ];
    
    /**
     * Relación con Departamento
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento', 'id');
    }
    
    /**
     * Relación con Tareas (tares)
     */
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'idEmpleado', 'id');
    }
    
    /**
     * Accesor para nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->Nombre} {$this->apellido}";
    }
    
    /**
     * Scope para buscar por nombre
     */
    public function scopeBuscar($query, $search)
    {
        return $query->where('Nombre', 'LIKE', "%{$search}%")
                     ->orWhere('apellido', 'LIKE', "%{$search}%")
                     ->orWhere('email', 'LIKE', "%{$search}%");
    }
    
    /**
     * Scope para empleados por departamento
     */
    public function scopePorDepartamento($query, $departamentoId)
    {
        return $query->where('id_departamento', $departamentoId);
    }
}