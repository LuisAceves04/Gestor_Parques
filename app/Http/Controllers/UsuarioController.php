<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string',
            'Correo' => 'required|email',
            'telefono_usuario' => 'required|string',
            'Contraseña' => 'required|string',
            'TipoUsuario' => 'required|string',
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'required|string',
            'Correo' => 'required|email',
            'telefono_usuario' => 'required|string',
            'Contraseña' => 'required|string',
            'TipoUsuario' => 'required|string',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }
}
