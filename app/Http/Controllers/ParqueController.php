<?php

namespace App\Http\Controllers;

use App\Models\Parque;
use Illuminate\Http\Request;

class ParqueController extends Controller
{
    public function index()
    {
        $parques = Parque::all();
        return view('parques.index', compact('parques'));
    }

    public function create()
    {
        return view('parques.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Ubicacion' => 'required|string|max:255',
            'Descripcion' => 'nullable|string'
        ]);

        Parque::create([
            'Nombre' => $request->Nombre,
            'Ubicacion' => $request->Ubicacion,
            'Descripcion' => $request->Descripcion
        ]);

        return redirect()->route('parques.index')
                         ->with('success', 'Parque creado correctamente');
    }

    public function edit(Parque $parque)
    {
        return view('parques.edit', compact('parque'));
    }

    public function update(Request $request, Parque $parque)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Ubicacion' => 'required|string|max:255',
            'Descripcion' => 'nullable|string'
        ]);

        $parque->update([
            'Nombre' => $request->Nombre,
            'Ubicacion' => $request->Ubicacion,
            'Descripcion' => $request->Descripcion
        ]);

        return redirect()->route('parques.index')
                         ->with('success', 'Parque actualizado correctamente');
    }

    public function destroy(Parque $parque)
    {
        $parque->delete();

        return redirect()->route('parques.index')
                         ->with('success', 'Parque eliminado correctamente');
    }
}



