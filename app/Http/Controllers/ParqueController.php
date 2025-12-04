<?php

namespace App\Http\Controllers;

use App\Models\Parque;
use Illuminate\Http\Request;

class ParqueController extends Controller
{
    // Mostrar todos los parques
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
        Parque::create($request->all());
        return redirect()->route('parques.index');
    }

    // Mostrar formulario para editar
    public function edit($id)
    {
        $parque = Parque::findOrFail($id);
        return view('parques.edit', compact('parque'));
    }

    // Actualizar un parque
    public function update(Request $request, $id)
    {
        $parque = Parque::findOrFail($id);
        $parque->update($request->all());

        return redirect()->route('parques.index');
    }

    // Eliminar
    public function destroy($id)
    {
        $parque = Parque::findOrFail($id);
        $parque->delete();

        return redirect()->route('parques.index');
    }
}

