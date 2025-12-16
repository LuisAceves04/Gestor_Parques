

@section('content')
<div class="container">
    <h1>Nuevo Empleado</h1>

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="Nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Puesto</label>
            <input type="text" name="puesto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono_empleado" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

