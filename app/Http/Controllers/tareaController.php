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
        $request->validate([
            'idReporte' => 'required|integer',
            'idEmpleado' => 'required|integer',
            'fecha_asignacion' => 'required|date',
            'estado_tarea' => 'required'
        ]);

        Tarea::create($request->all());

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

    public function update(Request $request, $id)
    {
        Tarea::findOrFail($id)->update($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea actualizada');
    }

    public function destroy($id)
    {
        Tarea::findOrFail($id)->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada');
    }
}
