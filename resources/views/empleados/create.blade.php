<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Empleado</title>

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
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i> Nuevo Empleado
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('empleados.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text"
                                   name="Nombre"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Puesto</label>
                            <input type="text"
                                   name="puesto"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text"
                                   name="telefono_empleado"
                                   class="form-control"
                                   required>
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Guardar
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

