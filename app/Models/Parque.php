<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parque extends Model
{
    // Nombre correcto de la tabla
    protected $table = 'parques';

    // Llave primaria personalizada
    protected $primaryKey = 'idParque';

    
    public $timestamps = true;

    // Campos permitidos para inserción/actualización
    protected $fillable = ['Nombre', 'Ubicacion', 'Descripcion'];
}

