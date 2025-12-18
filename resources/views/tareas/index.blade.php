<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>

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
                        <i class="fas fa-tasks me-2"></i> Lista de Tareas
                    </h4>
                    <a href="{{ route('tareas.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i> Nueva Tarea
                    </a>
                </div>

                <div class="card-body">

                    {{-- FILTROS --}}
                    <form method="GET" action="{{ route('tareas.index') }}" class="row g-3 mb-4">

                        <div class="col-md-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="">Todos</option>
                                <option value="pendiente" {{ request('estado')=='pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en_proceso" {{ request('estado')=='en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="completada" {{ request('estado')=='completada' ? 'selected' : '' }}>Completada</option>
                                <option value="cancelada" {{ request('estado')=='cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Empleado</label>
                            <select name="empleado" class="form-select">
                                <option value="">Todos</option>
                                @foreach($empleados as $emp)
                                    <option value="{{ $emp->idEmpleado }}"
                                        {{ request('empleado') == $emp->idEmpleado ? 'selected' : '' }}>
                                        {{ $emp->Nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha desde</label>
                            <input type="date"
                                   name="fecha_desde"
                                   value="{{ request('fecha_desde') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                        </div>

                    </form>

                    {{-- TABLA --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Reporte</th>
                                    <th>Empleado</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Actualización</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($tareas as $tarea)
                                <tr>
                                    <td class="fw-bold">{{ $tarea->idTarea }}</td>

                                    <td>
                                        {{ $tarea->reporte?->idReporte ?? 'Sin reporte' }}
                                    </td>

                                    <td>
                                        {{ $tarea->empleado?->Nombre ?? 'Sin asignar' }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($tarea->fecha_asignacion)->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($tarea->estado_tarea) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $tarea->updated_at ?? '—' }}
                                    </td>

                                    {{-- ACCIONES --}}
                                    <td class="text-center">
                                        <a href="{{ route('tareas.edit', $tarea->idTarea) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('tareas.destroy', $tarea->idTarea) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Eliminar tarea?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="alert alert-info mb-0">
                                            No hay tareas registradas.
                                            <a href="{{ route('tareas.create') }}">Crear tarea</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $tareas->links() }}

                </div>

                <div class="card-footer text-muted text-end">
                    <small>Gestión de tareas</small>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
