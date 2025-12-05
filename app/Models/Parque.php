<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ParqueController;

class Parque extends Model
{
    protected $fillable = ['nombre', 'direccion', 'capacidad'];
}
