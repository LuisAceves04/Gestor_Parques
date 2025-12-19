<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ParqueController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\usuarioController;


Route::get('/', function () {
    return view('welcome');
});

// ========== PARQUES ==========
Route::get('/empleados', [EmpleadoController::class, 'index'])
    ->name('empleados.index');

Route::get('/empleados/create', [EmpleadoController::class, 'create'])
    ->name('empleados.create');

Route::post('/empleados', [EmpleadoController::class, 'store'])
    ->name('empleados.store');

Route::get('/empleados/{id}', [EmpleadoController::class, 'show'])
    ->name('empleados.show');

Route::get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])
    ->name('empleados.edit');

Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])
    ->name('empleados.update');

Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])
    ->name('empleados.destroy');

Route::get('/empleados-buscar', [EmpleadoController::class, 'buscar'])
    ->name('empleados.buscar');

// ========== EXTRA ==========
Route::get('/home', function () {
    return redirect()->route('tarea.index');
})->name('home');

//===========PARQUES==========
Route::resource('parques', ParqueController::class);

//===========TAREAS===========
Route::resource('tareas', TareaController::class);

//===========Reportes=========
Route::resource('reportes', ReporteController::class);

//===========Usuarios=========
Route::resource('usuarios', UsuarioController::class);


