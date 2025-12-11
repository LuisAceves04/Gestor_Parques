@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-tasks me-2"></i>Lista de Tareas</h4>
                    <a href="{{ route('tarea.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i> Nueva Tarea
                    </a>
                </div>

                <div class="card-body">

                    {{-- FILTROS --}}
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('tarea.index') }}" class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label">Estado</label>
                                            <select name="estado" class="form-select">
                                                <option value="">Todos los estados</option>
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
                                                    <option value="{{ $emp->id }}" 
                                                        {{ request('empleado')==$emp->id ? 'selected' : '' }}>
                                                        {{ $emp->Nombre }} {{ $emp->apellido }}
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
                                </div>
                            </div>
                        </div>
                    </div>

                     

                    <h1> TABLA </h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
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

                                    <td class="fw-bold">Aqui va el id</td>

                                    
                                    <td>
                                        @if ($tarea->reporte)
                                            <span class="badge bg-primary">Reporte </span>
                                            <br>
                                            <small></small>
                                        @else
                                            <small class="text-muted">Sin reporte</small>
                                        
                                    </td>

                                    
                                    <td>
                                        
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle text-white d-flex justify-content-center align-items-center me-2">
                                                        Empleado
                                                </div>
                                                <div>
                                                    <strong></strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        
                                                    </small>
                                                </div>
                                            </div>
                                        
                                            <span class="text-danger"></span>
                                        
                                    </td>

                                    
                                    <td>
                                        
                                        <br>
                                        <small class="text-muted">
                                            Fecha Asignada
                                        </small>
                                    </td>

                                    
                                    <td>
                                        

                                        <span class="badge bg-{{ $e[0] }}">
                                            <i class="fas fa-{{ $e[1] }} me-1"></i>
                                            Estado actual
                                        </span>
                                    </td>

                                   
                                    <td>
                                        Actualizado
                                        <br>
                                        <small class="text-muted"></small>
                                    </td>

                                    
                                    <td class="text-center">
                                        <div class="btn-group">

                                            <a href="{{ route('tarea.show', $tarea->IdTarea) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('tarea.edit', $tarea->IdTarea) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#del{{ $tarea->IdTarea }}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </div>

                                        
                                        <div class="modal fade" id="del{{ $tarea->IdTarea }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header bg-danger text-white">
                                                        <h5>Eliminar Tarea</h5>
                                                        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        ¿Eliminar la tarea <strong></strong>?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                                        <form action="{{ route('tarea.destroy', $tarea->IdTarea) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger">Eliminar</button>
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
                                            <a href="{{ route('tarea.create') }}" class="alert-link">Crear tarea</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    

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
        font-size: 0.85rem;
    }
</style>
@endpush
