<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'idUsuario';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'Nombre',
        'Correo',
        'telefono_usuario',
        'Contraseña',
        'TipoUsuario'
    ];
}
