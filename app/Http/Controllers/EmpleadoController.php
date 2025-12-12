<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Mostrar lista de empleados
     */
    public function index()
    {
        // Con paginación y cargando departamento
        $empleados = Empleado::with('departamento')
                            ->orderBy('apellido')
                            ->orderBy('Nombre')
                            ->paginate(10);
        
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Mostrar formulario para crear nuevo empleado
     */
    public function create()
    {
        $departamentos = Departamento::orderBy('nombre')->get();
        
        return view('empleados.create', compact('departamentos'));
    }

    /**
     * Guardar nuevo empleado
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:empleados,email|max:100',
            'id_departamento' => 'required|exists:departamentos,id'
        ], [
            'Nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'id_departamento.required' => 'Debe seleccionar un departamento'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        Empleado::create($request->all());

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado creado correctamente');
    }

    /**
     * Mostrar detalles de un empleado específico
     */
    public function show($id)
    {
        $empleado = Empleado::with(['departamento', 'tareas.reporte'])
                           ->findOrFail($id);
        
        // Tareas asignadas a este empleado
        $tareas = Tarea::where('idEmpleado', $id)
                      ->with('reporte')
                      ->orderBy('fecha_asignacion', 'desc')
                      ->get();
        
        return view('empleados.show', compact('empleado', 'tareas'));
    }

    /**
     * Mostrar formulario para editar empleado
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $departamentos = Departamento::orderBy('nombre')->get();
        
        return view('empleados.edit', compact('empleado', 'departamentos'));
    }

    /**
     * Actualizar empleado
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:100|unique:empleados,email,' . $id,
            'id_departamento' => 'required|exists:departamentos,id'
        ], [
            'email.unique' => 'Este correo electrónico ya está registrado por otro empleado'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado actualizado correctamente');
    }

    /**
     * Eliminar empleado
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        
        // Verificar si tiene tareas asignadas
        $tareasCount = Tarea::where('idEmpleado', $id)->count();
        
        if ($tareasCount > 0) {
            return redirect()->route('empleados.index')
                             ->with('error', 'No se puede eliminar el empleado porque tiene tareas asignadas. Reasigna las tareas primero.');
        }
        
        $empleado->delete();

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado eliminado correctamente');
    }

    /**
     * Buscar empleados
     */
    public function buscar(Request $request)
    {
        $search = $request->get('search');
        
        $empleados = Empleado::with('departamento')
                            ->where('Nombre', 'LIKE', "%{$search}%")
                            ->orWhere('apellido', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%")
                            ->orWhere('telefono', 'LIKE', "%{$search}%")
                            ->paginate(10);
        
        return view('empleados.index', compact('empleados', 'search'));
    }

    /**
     * Empleados por departamento
     */
    public function porDepartamento($departamentoId)
    {
        $departamento = Departamento::findOrFail($departamentoId);
        $empleados = Empleado::where('id_departamento', $departamentoId)
                            ->orderBy('apellido')
                            ->paginate(10);
        
        return view('empleados.por-departamento', compact('empleados', 'departamento'));
    }

    /**
     * API: Obtener empleados en JSON
     */
    public function apiIndex()
    {
        $empleados = Empleado::with('departamento')->get();
        
        return response()->json([
            'success' => true,
            'data' => $empleados
        ]);
    }

    /**
     * Reporte de empleados
     */
    public function reporte()
    {
        // Empleados por departamento
        $empleadosPorDepartamento = Empleado::selectRaw('id_departamento, COUNT(*) as total')
                                           ->groupBy('id_departamento')
                                           ->with('departamento')
                                           ->get();
        
        // Total de empleados
        $totalEmpleados = Empleado::count();
        
        // Empleados con más tareas
        $empleadosConTareas = Empleado::withCount('tareas')
                                     ->orderBy('tareas_count', 'desc')
                                     ->limit(10)
                                     ->get();
        
        return view('empleados.reporte', compact(
            'empleadosPorDepartamento',
            'totalEmpleados',
            'empleadosConTareas'
        ));
    }

    /**
     * Asignar tarea a empleado
     */
    public function asignarTarea(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        
        $request->validate([
            'IdReporte' => 'required|exists:reportes,id',
            'fecha_asignacion' => 'required|date',
            'estado_tares' => 'required|string'
        ]);

        Tarea::create([
            'IdReporte' => $request->IdReporte,
            'idEmpleado' => $id,
            'fecha_asignacion' => $request->fecha_asignacion,
            'estado_tares' => $request->estado_tares
        ]);

        return redirect()->route('empleados.show', $id)
                         ->with('success', 'Tarea asignada correctamente al empleado');
    }
}