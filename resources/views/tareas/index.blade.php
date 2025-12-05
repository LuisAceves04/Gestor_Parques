@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-tasks me-2"></i>Lista de Tareas
                    </h4>
                    <a href="{{ route('tarea.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i> Nueva Tarea
                    </a>
                </div>
                
                <div class="card-body">
                    <!-- Filtros -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('tarea.index') }}" class="row g-3">
                                        <div class="col-md-3">
                                            <label for="estado" class="form-label">Estado</label>
                                            <select name="estado" id="estado" class="form-select">
                                                <option value="">Todos los estados</option>
                                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="en_proceso" {{ request('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                                <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                                                <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="empleado" class="form-label">Empleado</label>
                                            <select name="empleado" id="empleado" class="form-select">
                                                <option value="">Todos los empleados</option>
                                                @foreach($empleados as $emp)
                                                    <option value="{{ $emp->id }}" {{ request('empleado') == $emp->id ? 'selected' : '' }}>
                                                        {{ $emp->Nombre }} {{ $emp->apellido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="fecha_desde" class="form-label">Fecha desde</label>
                                            <input type="date" name="fecha_desde" id="fecha_desde" 
                                                   class="form-control" value="{{ request('fecha_desde') }}">
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <div class="w-100">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fas fa-filter me-1"></i> Filtrar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resumen de tareas -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total</h5>
                                    <h2>{{ $totalTareas }}</h2>
                                    <p class="mb-0">Tareas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pendientes</h5>
                                    <h2>{{ $pendientes }}</h2>
                                    <p class="mb-0">Por hacer</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Completadas</h5>
                                    <h2>{{ $completadas }}</h2>
                                    <p class="mb-0">Finalizadas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-secondary text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">En Proceso</h5>
                                    <h2>{{ $enProceso }}</h2>
                                    <p class="mb-0">Trabajando</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de tareas -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Reporte</th>
                                    <th>Empleado Asignado</th>
                                    <th>Fecha Asignación</th>
                                    <th>Estado</th>
                                    <th>Última Actualización</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tareas as $tarea)
                                <tr>
                                    <td class="fw-bold">#{{ $tarea->IdTarea }}</td>
                                    <td>
                                        @if($tarea->reporte)
                                            <span class="badge bg-primary">Reporte #{{ $tarea->reporte->id }}</span>
                                            <br>
                                            <small>{{ Str::limit($tarea->reporte->descripcion ?? 'Sin descripción', 30) }}</small>
                                        @else
                                            <span class="text-muted">Sin reporte</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tarea->empleado)
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    <span class="text-white">{{ substr($tarea->empleado->Nombre, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <strong>{{ $tarea->empleado->Nombre }} {{ $tarea->empleado->apellido }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $tarea->empleado->departamento->nombre ?? 'Sin departamento' }}</small>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-danger">No asignado</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($tarea->fecha_asignacion)->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($tarea->fecha_asignacion)->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $estados = [
                                                'pendiente' => ['color' => 'warning', 'icon' => 'clock'],
                                                'en_proceso' => ['color' => 'info', 'icon' => 'play-circle'],
                                                'completada' => ['color' => 'success', 'icon' => 'check-circle'],
                                                'cancelada' => ['color' => 'danger', 'icon' => 'times-circle']
                                            ];
                                            $estado = $estados[$tarea->estado_tarea] ?? ['color' => 'secondary', 'icon' => 'question-circle'];
                                        @endphp
                                        <span class="badge bg-{{ $estado['color'] }}">
                                            <i class="fas fa-{{ $estado['icon'] }} me-1"></i>
                                            {{ ucfirst(str_replace('_', ' ', $tarea->estado_tarea)) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $tarea->updated_at->format('d/m/Y H:i') }}
                                        <br>
                                        <small class="text-muted">{{ $tarea->updated_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tarea.show', $tarea->IdTarea) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tarea.edit', $tarea->IdTarea) }}" 
                                               class="btn btn-sm btn-warning" 
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    title="Eliminar"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $tarea->IdTarea }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Modal de confirmación para eliminar -->
                                        <div class="modal fade" id="deleteModal{{ $tarea->IdTarea }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar la tarea #{{ $tarea->IdTarea }}?
                                                        <br>
                                                        <strong>Empleado:</strong> {{ $tarea->empleado->Nombre ?? 'No asignado' }}
                                                        <br>
                                                        <strong>Estado:</strong> {{ ucfirst($tarea->estado_tarea) }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('tarea.destroy', $tarea->IdTarea) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            No hay tareas registradas. 
                                            <a href="{{ route('tarea.create') }}" class="alert-link">Crea la primera tarea</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    @if($tareas->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Mostrando {{ $tareas->firstItem() }} a {{ $tareas->lastItem() }} de {{ $tareas->total() }} tareas
                        </div>
                        <div>
                            {{ $tareas->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-weight: bold;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
    // Cambiar estado rápido
    document.addEventListener('DOMContentLoaded', function() {
        const estadoSelects = document.querySelectorAll('.estado-rapido');
        
        estadoSelects.forEach(select => {
            select.addEventListener('change', function() {
                const tareaId = this.dataset.tarea;
                const nuevoEstado = this.value;
                
                fetch(`/tarea/${tareaId}/cambiar-estado`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ estado: nuevoEstado })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar estado');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
        
        // Filtro de fecha
        const fechaDesde = document.getElementById('fecha_desde');
        const fechaHasta = document.getElementById('fecha_hasta');
        
        if (fechaDesde && fechaHasta) {
            fechaHasta.min = fechaDesde.value;
            
            fechaDesde.addEventListener('change', function() {
                fechaHasta.min = this.value;
            });
        }
    });
</script>
@endpush
