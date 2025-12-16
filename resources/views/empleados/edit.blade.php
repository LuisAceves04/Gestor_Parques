

@section('content')
<div class="container">
    <h1>Editar Empleado</h1>

    <form action="{{ route('empleados.update', $empleado->idEmpleado) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="Nombre" class="form-control"
                   value="{{ $empleado->Nombre }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Puesto</label>
            <input type="text" name="puesto" class="form-control"
                   value="{{ $empleado->puesto }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono_empleado" class="form-control"
                   value="{{ $empleado->telefono_empleado }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

