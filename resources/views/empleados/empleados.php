@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Empleados</h1>
    
    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">
        Nuevo Empleado
    </a>
    
    <!-- Buscador -->
    <form method="GET" action="{{ route('empleados.buscar') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar empleados...">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Departamento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td>
                    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    
</div>
@endsection