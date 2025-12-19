<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Reporte</title>

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

                {{-- HEADER --}}
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i> Nuevo Reporte
                    </h4>
                </div>

                {{-- BODY --}}
                <div class="card-body">
                    <form action="{{ route('reportes.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            {{-- Usuario --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="number"
                                       name="idUsuario"
                                       class="form-control"
                                       required>
                            </div>

                            {{-- Parque --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Parque</label>
                                <input type="number"
                                       name="idParque"
                                       class="form-control"
                                       required>
                            </div>

                            {{-- Estado --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select" required>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="en_proceso">En proceso</option>
                                    <option value="resuelto">Resuelto</option>
                                </select>
                            </div>

                            {{-- Descripción --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion"
                                          class="form-control"
                                          rows="3"
                                          required></textarea>
                            </div>

                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('reportes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>
                            <button class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Guardar
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

