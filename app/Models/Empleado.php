<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';


    protected $primaryKey = 'idEmpleado';


    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'Nombre',
        'puesto',
        'telefono_empleado'
    ];
}
