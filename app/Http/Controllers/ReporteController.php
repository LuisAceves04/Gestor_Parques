<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Listado de reportes
     */
    public function index()
    {
        $reportes = Reporte::orderBy('idReporte', 'desc')->paginate(10);
        return view('reportes.index', compact('reportes'));
    }

    /**
     * Formulario crear
     */
    public function create()
    {
        return view('reportes.create');
    }

    /**
     * Guardar reporte
     */
    public function store(Request $request)
    {
        $request->validate([
            'idParque'    => 'required|integer',
            'descripcion' => 'required|string',
            'estado'      => 'required|string'
        ]);

        Reporte::create([
            'idUsuario'     => auth()->id() ?? 1, // usa usuario logueado o 1
            'idParque'      => $request->idParque,
            'descripcion'   => $request->descripcion,
            'estado'        => $request->estado,
            'fecha_reporte' => now()
        ]);

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte creado correctamente');
    }

    /**
     * Formulario editar
     */
    public function edit($id)
    {
        $reporte = Reporte::findOrFail($id);
        return view('reportes.edit', compact('reporte'));
    }

    /**
     * Actualizar reporte
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'idParque'    => 'required|integer',
            'descripcion' => 'required|string',
            'estado'      => 'required|string'
        ]);

        $reporte = Reporte::findOrFail($id);

        $reporte->update([
            'idParque'    => $request->idParque,
            'descripcion' => $request->descripcion,
            'estado'      => $request->estado
        ]);

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte actualizado correctamente');
    }

    /**
     * Eliminar reporte (opcional)
     */
    public function destroy($id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->delete();

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte eliminado');
    }
}
