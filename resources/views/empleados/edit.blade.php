<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">

                {{-- HEADER --}}
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i> Editar Empleado
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('empleados.update', $empleado->idEmpleado) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text"
                                   name="Nombre"
                                   class="form-control"
                                   value="{{ $empleado->Nombre }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Puesto</label>
                            <input type="text"
                                   name="puesto"
                                   class="form-control"
                                   value="{{ $empleado->puesto }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text"
                                   name="telefono_empleado"
                                   class="form-control"
                                   value="{{ $empleado->telefono_empleado }}"
                                   required>
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Actualizar
                            </button>
                        </div>

                    </form>

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

