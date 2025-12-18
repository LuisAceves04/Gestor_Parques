
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow">

                {{-- HEADER --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i> Empleados
                    </h4>

                    <a href="{{ route('empleados.create') }}" class="btn btn-light">
                        <i class="fas fa-user-plus me-1"></i> Nuevo Empleado
                    </a>
                </div>

                <div class="card-body">

                    {{-- TABLA --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Teléfono</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($empleados as $empleado)
                                <tr>
                                    <td class="fw-bold">{{ $empleado->idEmpleado }}</td>
                                    <td>{{ $empleado->Nombre }}</td>
                                    <td>{{ $empleado->puesto }}</td>
                                    <td>{{ $empleado->telefono_empleado }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('empleados.show', $empleado->idEmpleado) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('empleados.edit', $empleado->idEmpleado) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-info mb-0">
                                            No hay empleados registrados.
                                            <a href="{{ route('empleados.create') }}">Crear empleado</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINACIÓN --}}
                    {{ $empleados->links() }}

                </div>

                <div class="card-footer text-muted text-end">
                    <small>Gestión de empleados</small>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
