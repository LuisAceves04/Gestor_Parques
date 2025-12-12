<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ParqueController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('welcome');
});

// ========== PARQUES ==========
Route::resource('parques', ParqueController::class);

// ========== TAREAS ==========
Route::resource('tarea', TareaController::class);

Route::get('tarea/empleado/{empleado}', [TareaController::class, 'porEmpleado'])
     ->name('tarea.por-empleado');
     
Route::get('tarea/pendientes', [TareaController::class, 'pendientes'])
     ->name('tarea.pendientes');
     
Route::put('tarea/{tarea}/estado', [TareaController::class, 'cambiarEstado'])
     ->name('tarea.cambiar-estado');

// ========== EMPLEADOS ==========
Route::resource('empleados', EmpleadoController::class);

Route::get('empleados/buscar', [EmpleadoController::class, 'buscar'])
     ->name('empleados.buscar');
     
Route::get('empleados/departamento/{id}', [EmpleadoController::class, 'porDepartamento'])
     ->name('empleados.por-departamento');
     
Route::get('empleados/reporte', [EmpleadoController::class, 'reporte'])
     ->name('empleados.reporte');
     
Route::post('empleados/{id}/asignar-tarea', [EmpleadoController::class, 'asignarTarea'])
     ->name('empleados.asignar-tarea');

// ========== EXTRA ==========
Route::get('/home', function () {
    return redirect()->route('tarea.index');
})->name('home');
