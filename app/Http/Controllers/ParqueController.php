<?php

namespace App\Http\Controllers;

use App\Models\Parque;
use Illuminate\Http\Request;

class ParqueController extends Controller
{
    // Mostrar lista de parques
    public function index()
    {
        $parques = Parque::all();
        return view('parques.index', compact('parques'));
    }

    // Formulario para crear un parque
    public function create()
    {
        return view('parques.create');
    }

    // Guardar un parque nuevo
    public function store(Request $request)
    {
        // Validación (IMPORTANTE)
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        // Guardar en la BD
        Parque::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('parques.index')
                         ->with('success', 'Parque creado correctamente');
    }

    // Formulario para editar
    public function edit(Parque $parque) // Usa Route Model Binding
    {
        return view('parques.edit', compact('parque'));
    }

    // Actualizar un parque
    public function update(Request $request, Parque $parque)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        // Actualizar
        $parque->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('parques.index')
                         ->with('success', 'Parque actualizado correctamente');
    }

    // Eliminar
    public function destroy(Parque $parque)
    {
        $parque->delete();

        return redirect()->route('parques.index')
                         ->with('success', 'Parque eliminado correctamente');
    }
}


