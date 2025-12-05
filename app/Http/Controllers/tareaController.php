<?php

namespace App\Http\Controllers;

use App\Models\Tarea; 
use App\Models\Reporte; 
use App\Models\Empleado; 
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Mostrar lista de tareas
     */
    public function index()
    {
        // Cargar relaciones con reporte y empleado
        $tareas = Tarea::with(['reporte', 'empleado'])->latest()->get();
        
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Mostrar formulario para crear nueva tarea
     */
    public function create()
    {
        // Obtener reportes y empleados para los select
        $reportes = Reporte::all();
        $empleados = Empleado::all();
        
        return view('tareas.create', compact('reportes', 'empleados'));
    }

    /**
     * Guardar nueva tarea
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'IdReporte' => 'required|exists:reportes,id',
            'idEmpleado' => 'required|exists:empleados,id',
            'fecha_asignacion' => 'required|date',
            'estado_tarea' => 'required|string|max:50'
        ]);

        Tarea::create($validated);

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea asignada correctamente');
    }

    /**
     * Mostrar detalles de una tarea específica
     */
    public function show(Tarea $tarea)
    {
        // Cargar relaciones
        $tarea->load(['reporte', 'empleado']);
        
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Mostrar formulario para editar tarea
     */
    public function edit(Tarea $tarea)
    {
        $reportes = Reporte::all();
        $empleados = Empleado::all();
        
        return view('tareas.edit', compact('tarea', 'reportes', 'empleados'));
    }

    /**
     * Actualizar tarea
     */
    public function update(Request $request, Tarea $tarea)
    {
        $validated = $request->validate([
            'IdReporte' => 'required|exists:reportes,id',
            'idEmpleado' => 'required|exists:empleados,id',
            'fecha_asignacion' => 'required|date',
            'estado_tarea' => 'required|string|max:50'
        ]);

        $tarea->update($validated);

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea actualizada correctamente');
    }

    /**
     * Eliminar tarea
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea eliminada correctamente');
    }

    /**
     * API: Obtener tareas en JSON
     */
    public function apiIndex()
    {
        $tareas = Tarea::with(['reporte', 'empleado'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $tareas
        ]);
    }

    /**
     * Cambiar estado de una tarea
     */
    public function cambiarEstado(Request $request, Tarea $tarea)
    {
        $request->validate([
            'estado' => 'required|string|max:50'
        ]);

        $tarea->update(['estado_tarea' => $request->estado]);

        return back()->with('success', 'Estado de tarea actualizado');
    }

    /**
     * Tareas por empleado
     */
    public function porEmpleado($empleadoId)
    {
        $tareas = Tarea::where('idEmpleado', $empleadoId)
                      ->with('reporte')
                      ->get();
        
        $empleado = Empleado::findOrFail($empleadoId);
        
        return view('tareas.por-empleado', compact('tareas', 'empleado'));
    }

    /**
     * Tareas pendientes
     */
    public function pendientes()
    {
        $tareas = Tarea::where('estado_tarea', 'pendiente')
                      ->orWhere('estado_tarea', 'en_proceso')
                      ->with(['reporte', 'empleado'])
                      ->get();
        
        return view('tareas.pendientes', compact('tareas'));
    }
}