@extends('layouts.app')

@section('title', 'Detalles de Tarea #' . $tarea->IdTarea)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-tasks me-2"></i>Tarea #{{ $tarea->IdTarea }}
                    </h4>
                    <div>
                        @php
                            $estados = [
                                'pendiente' => 'warning',
                                'en_proceso' => 'info',
                                'completada' => 'success',
                                'cancelada' => 'danger'
                            ];
                            $color = $estados[$tarea->estado_tarea] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }} fs-6">
                            {{ ucfirst(str_replace('_', ' ', $tarea->estado_tarea)) }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Información General</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">ID:</th>
                                    <td><strong>#{{ $tarea->IdTarea }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Fecha Asignación:</th>
                                    <td>
                                        {{ \Carbon\Carbon::parse($tarea->fecha_asignacion)->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($tarea->fecha_asignacion)->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creada:</th>
                                    <td>
                                        {{ $tarea->created_at->format('d/m/Y H:i') }}
                                        <br>
                                        <small class="text-muted">{{ $tarea->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Última Actualización:</th>
                                    <td>
                                        {{ $tarea->updated_at->format('d/m/Y H:i') }}
                                        <br>
                                        <small class="text-muted">{{ $tarea->updated_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Asignaciones</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Empleado:</th>
                                    <td>
                                        @if($tarea->empleado)
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-lg bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                                    <span class="text-white fs-4">{{ substr($tarea->empleado->Nombre, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <strong>{{ $tarea->empleado->Nombre }} {{ $tarea->empleado->apellido }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $tarea->empleado->email }}</small>
                                                    <br>
                                                    <span class="badge bg-info">{{ $tarea->empleado->departamento->nombre ?? 'Sin departamento' }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-danger">No asignado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Reporte:</th>
                                    <td>
                                        @if($tarea->reporte)
                                            <a href="#" class="text-decoration-none">
                                                <span class="badge bg-primary">Reporte #{{ $tarea->reporte->id }}</span>
                                            </a>
                                            <br>
                                            <small>{{ $tarea->reporte->descripcion ?? 'Sin descripción' }}</small>
                                        @else
                                            <span class="text-muted">Sin reporte asociado</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Cambiar estado -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Cambiar Estado</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('tarea.cambiar-estado', $tarea->IdTarea) }}" method="POST" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-8">
                                            <select name="estado" class="form-select">
                                                <option value="pendiente" {{ $tarea->estado_tarea == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="en_proceso" {{ $tarea->estado_tarea == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                                <option value="completada" {{ $tarea->estado_tarea == 'completada' ? 'selected' : '' }}>Completada</option>
                                                <option value="cancelada" {{ $tarea->estado_tarea == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Actualizar Estado
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tarea.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
                        </a>
                        <div>
                            <a href="{{ route('tarea.edit', $tarea->IdTarea) }}" class="btn btn-warning me-2">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar con acciones rápidas -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Acciones Rápidas</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-paper-plane me-2"></i> Enviar Recordatorio
                        </a>
                        <a href="#" class="btn btn-outline-success">
                            <i class="fas fa-file-pdf me-2"></i> Generar Reporte
                        </a>
                        <a href="#" class="btn btn-outline-warning">
                            <i class="fas fa-exchange-alt me-2"></i> Reasignar Empleado
                        </a>
                        <a href="#" class="btn btn-outline-info">
                            <i class="fas fa-history me-2"></i> Ver Historial
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Historial de cambios -->
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0"><i class="fas fa-history me-2"></i>Actividad Reciente</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @php
                            $actividades = [
                                ['fecha' => $tarea->created_at, 'accion' => 'Tarea creada', 'usuario' => 'Sistema'],
                                ['fecha' => $tarea->updated_at, 'accion' => 'Última actualización', 'usuario' => 'Admin'],
                            ];
                        @endphp
                        
                        @foreach($actividades as $actividad)
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">{{ $actividad['accion'] }}</h6>
                                <p class="text-muted mb-0">
                                    <small>
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $actividad['fecha']->format('d/m/Y H:i') }}
                                        <br>
                                        <i class="fas fa-user me-1"></i>
                                        {{ $actividad['usuario'] }}
                                    </small>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar la tarea #{{ $tarea->IdTarea }}?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Esta acción no se puede deshacer. Se eliminarán todos los datos relacionados.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('tarea.destroy', $tarea->IdTarea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Permanentemente</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-lg {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline-item {
        position: relative;
    }
    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }
    .timeline-content {
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    .timeline-item:last-child .timeline-content {
        border-bottom: none;
    }
</style>
@endpush