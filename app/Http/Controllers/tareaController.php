<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Empleado;
use App\Models\Reporte;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::with(['empleado', 'reporte'])->paginate(10);
        $empleados = Empleado::all();

        return view('tareas.index', compact('tareas', 'empleados'));
    }

   public function create()
{
    $reportes = Reporte::all();   // Traer todos los reportes
    $empleados = Empleado::all(); // Traer todos los empleados

    return view('tareas.create', compact('reportes', 'empleados'));
}


    public function store(Request $request)
{
    $validated = $request->validate([
        'idReporte' => 'required|integer',
        'idEmpleado' => 'required|integer',
        'fecha_asignacion' => 'required|date',
        'estado_tarea' => 'required'
    ]);

    Tarea::create($validated);

    return redirect()->route('tareas.index')
        ->with('success', 'Tarea creada correctamente');
}

    public function edit($id)
    {
        return view('tareas.edit', [
            'tarea' => Tarea::findOrFail($id),
            'empleados' => Empleado::all(),
            'reportes' => Reporte::all()
        ]);
    }

 public function update(Request $request, Tarea $tarea)
{
    $request->validate([
        'idReporte'        => 'required|exists:reporte,idReporte',
        'idEmpleado'       => 'required|exists:empleados,idEmpleado',
        'fecha_asignacion' => 'required|date',
        'estado_tarea'     => 'required|in:pendiente,en_proceso,completada,cancelada',
        'descripcion'      => 'nullable|string',
    ]);

    $tarea->update([
        'idReporte'        => $request->idReporte,
        'idEmpleado'       => $request->idEmpleado,
        'fecha_asignacion' => $request->fecha_asignacion,
        'estado_tarea'     => $request->estado_tarea,
        'descripcion'      => $request->descripcion,
    ]);

    return redirect()->route('tareas.index')
        ->with('success', 'Tarea actualizada correctamente');
}



    public function destroy($id)
    {
        Tarea::findOrFail($id)->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada');
    }
}
