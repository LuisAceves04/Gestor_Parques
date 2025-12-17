<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nueva Tarea</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Crear Nueva Tarea
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Reporte Asociado -->
                            <div class="col-md-6 mb-3">
                                <label for="idReporte" class="form-label">Reporte Asociado</label>
                                <select name="idReporte" id="idReporte"
                                        class="form-select @error('idReporte') is-invalid @enderror" required>
                                    <option value="">Seleccionar Reporte</option>
                                    @foreach($reportes as $reporte)
                                        <option value="{{ $reporte->id }}"
                                            {{ old('idReporte') == $reporte->id ? 'selected' : '' }}>
                                            {{ $reporte->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idReporte')
                                    <div class="invalid-feedback">
                                        Selecciona el reporte al que pertenece esta tarea
                                    </div>
                                @enderror
                            </div>

                            <!-- Empleado Asignado -->
                            <div class="col-md-6 mb-3">
                                <label for="idEmpleado" class="form-label">Empleado Asignado</label>
                                <select name="idEmpleado" id="idEmpleado"
                                        class="form-select @error('idEmpleado') is-invalid @enderror" required>
                                    <option value="">Seleccionar Empleado</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{ $empleado->id }}"
                                            {{ old('idEmpleado') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idEmpleado')
                                    <div class="invalid-feedback">
                                        Persona responsable de realizar la tarea
                                    </div>
                                @enderror
                            </div>

                            <!-- Fecha de Asignación -->
                            <div class="col-md-6 mb-3">
                                <label for="fecha_asignacion" class="form-label">Fecha de Asignación</label>
                                <input type="date"
                                       name="fecha_asignacion"
                                       id="fecha_asignacion"
                                       class="form-control @error('fecha_asignacion') is-invalid @enderror"
                                       value="{{ old('fecha_asignacion', date('Y-m-d')) }}"
                                       required>
                                @error('fecha_asignacion')
                                    <div class="invalid-feedback">Fecha inválida</div>
                                @enderror
                            </div>

                            <!-- Estado de la Tarea -->
                            <div class="col-md-6 mb-3">
                                <label for="estado_tarea" class="form-label">Estado</label>
                                <select name="estado_tarea"
                                        id="estado_tarea"
                                        class="form-select @error('estado_tarea') is-invalid @enderror"
                                        required>
                                    <option value="pendiente" {{ old('estado_tarea') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en_proceso" {{ old('estado_tarea') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                    <option value="completada" {{ old('estado_tarea') == 'completada' ? 'selected' : '' }}>Completada</option>
                                    <option value="cancelada" {{ old('estado_tarea') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                                @error('estado_tarea')
                                    <div class="invalid-feedback">Estado inválido</div>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="col-md-12 mb-3">
                                <label for="descripcion" class="form-label">Descripción Adicional</label>
                                <textarea name="descripcion"
                                          id="descripcion"
                                          class="form-control @error('descripcion') is-invalid @enderror"
                                          rows="3">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">Descripción inválida</div>
                                @enderror
                                <small class="text-muted">Detalles adicionales sobre la tarea</small>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row mt-4">
                            <div class="col-md-12 d-flex justify-content-between">
                                <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Guardar Tarea
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.getElementById('fecha_asignacion');
    if (fechaInput) {
        const today = new Date().toISOString().split('T')[0];
        fechaInput.min = today;
    }
});
</script>

</body>
</html>
