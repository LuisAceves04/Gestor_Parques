<?php

namespace App\Http\Controllers;

use App\Models\Parque;
use Illuminate\Http\Request;

class ParqueController extends Controller
{
    // READ – Mostrar todos los registros
    public function index()
    {
        $parques = Parque::all();
        return response()->json($parques);
    }

    // CREATE – Crear un registro nuevo
    public function store(Request $request)
    {
        $parque = Parque::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'capacidad' => $request->capacidad,
        ]);

        return response()->json(['mensaje' => 'Parque creado correctamente', 'data' => $parque]);
    }

    // READ – Mostrar un registro
    public function show($id)
    {
        $parque = Parque::findOrFail($id);
        return response()->json($parque);
    }

    // UPDATE – Actualizar un registro
    public function update(Request $request, $id)
    {
        $parque = Parque::findOrFail($id);

        $parque->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'capacidad' => $request->capacidad,
        ]);

        return response()->json(['mensaje' => 'Parque actualizado', 'data' => $parque]);
    }

    // DELETE – Eliminar un registro
    public function destroy($id)
    {
        $parque = Parque::findOrFail($id);
        $parque->delete();

        return response()->json(['mensaje' => 'Parque eliminado correctamente']);
    }
}
