

@section('content')
<div class="container">
    <h1>Empleados</h1>

    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">
        Nuevo Empleado
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->idEmpleado }}</td>
                <td>{{ $empleado->Nombre }}</td>
                <td>{{ $empleado->puesto }}</td>
                <td>{{ $empleado->telefono_empleado }}</td>
                <td>
                    <a href="{{ route('empleados.show', $empleado->idEmpleado) }}" class="btn btn-info btn-sm">
                        Ver
                    </a>
                    <a href="{{ route('empleados.edit', $empleado->idEmpleado) }}" class="btn btn-warning btn-sm">
                        Editar
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $empleados->links() }}
</div>


