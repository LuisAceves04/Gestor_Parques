<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Mostrar lista de empleados
     */
    public function index()
    {
        $empleados = Empleado::orderBy('Nombre')->paginate(10);

        return view('empleados.index', compact('empleados'));
    }

    /**
     * Mostrar formulario para crear empleado
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Guardar empleado
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'puesto' => 'required|string|max:100',
            'telefono_empleado' => 'required|string|max:20',
        ]);

        Empleado::create($request->only([
            'Nombre',
            'puesto',
            'telefono_empleado'
        ]));

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado correctamente');
    }

    /**
     * Buscar empleados
     */
    public function buscar(Request $request)
    {
        $search = $request->search;

        $empleados = Empleado::where('Nombre', 'like', "%$search%")
            ->orWhere('puesto', 'like', "%$search%")
            ->paginate(10);

        return view('empleados.index', compact('empleados', 'search'));
    }
    /**
 * Editar empleado
 */
        public function edit($id)
        {
            $empleado = Empleado::findOrFail($id);
            return view('empleados.edit', compact('empleado'));
        }
        public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|string|max:100',
            'puesto' => 'required|string|max:100',
            'telefono_empleado' => 'required|string|max:20',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
                        ->with('success', 'Empleado actualizado correctamente');
    }


}
