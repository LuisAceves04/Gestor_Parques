<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarea #{{ $tarea->IdTarea }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; background-color: #f8f9fa; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .required { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h2 class="mb-0">
                    <i class="fas fa-edit"></i> Editar Tarea 
                </h2>
            </div>
            
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('tarea.update', $tarea->IdTarea) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="IdReporte" class="form-label">
                                Reporte Asociado <span class="required">*</span>
                            </label>
                            <select name="IdReporte" id="IdReporte" class="form-control" required>
                                <option value="">Seleccionar Reporte</option>
                                @foreach($reportes as $reporte)
                                    <option value="{{ $reporte->id }}" 
                                        {{ old('IdReporte', $tarea->IdReporte) == $reporte->id ? 'selected' : '' }}>
                                        Reporte #{{ $reporte->id }} - {{ $reporte->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="idEmpleado" class="form-label">
                                Empleado Asignado <span class="required">*</span>
                            </label>
                            <select name="idEmpleado" id="idEmpleado" class="form-control" required>
                                <option value="">Seleccionar Empleado</option>
                                @foreach($empleados as $empleado)
                                    <option value="{{ $empleado->id }}" 
                                        {{ old('idEmpleado', $tarea->idEmpleado) == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->Nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_asignacion" class="form-label">
                                Fecha de Asignación <span class="required">*</span>
                            </label>
                            <input type="date" name="fecha_asignacion" id="fecha_asignacion" 
                                   class="form-control" 
                                   value="{{ old('fecha_asignacion', $tarea->fecha_asignacion) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="estado_tarea" class="form-label">
                                Estado <span class="required">*</span>
                            </label>
                            <select name="estado_tarea" id="estado_tarea" class="form-control" required>
                                <option value="pendiente" {{ old('estado_tarea', $tarea->estado_tarea) == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="en_proceso" {{ old('estado_tarea', $tarea->estado_tarea) == 'en_proceso' ? 'selected' : '' }}>
                                    En Proceso
                                </option>
                                <option value="completada" {{ old('estado_tarea', $tarea->estado_tarea) == 'completada' ? 'selected' : '' }}>
                                    Completada
                                </option>
                                <option value="cancelada" {{ old('estado_tarea', $tarea->estado_tarea) == 'cancelada' ? 'selected' : '' }}>
                                    Cancelada
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label">Descripción Adicional (Opcional)</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tarea.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar y Volver
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-footer text-muted">
                <small>
                    Última actualización: {{ $tarea->updated_at->format('d/m/Y H:i') }}
                    <br>
                    Tarea creada: {{ $tarea->created_at->format('d/m/Y') }}
                </small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    
    <script>
        // Si no tienes Font Awesome, quita los iconos o usa esta alternativa
        document.addEventListener('DOMContentLoaded', function() {
            // Establecer fecha mínima
            const fechaInput = document.getElementById('fecha_asignacion');
            const hoy = new Date().toISOString().split('T')[0];
            fechaInput.min = hoy;
            
            // Si no hay Font Awesome, ocultar iconos
            const iconos = document.querySelectorAll('.fas, .fa');
            if (iconos.length > 0 && !window.FontAwesome) {
                iconos.forEach(icon => icon.style.display = 'none');
            }
        });
    </script>
</body>
</html>