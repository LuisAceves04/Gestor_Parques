<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Parque</title>

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
                        <i class="fas fa-tree me-2"></i> Editar Parque
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('parques.update', $parque->idParque) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text"
                                   name="Nombre"
                                   class="form-control"
                                   value="{{ $parque->Nombre }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ubicación</label>
                            <input type="text"
                                   name="Ubicacion"
                                   class="form-control"
                                   value="{{ $parque->Ubicacion }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <input type="text"
                                   name="Descripcion"
                                   class="form-control"
                                   value="{{ $parque->Descripcion }}"
                                   required>
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('parques.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Guardar cambios
                            </button>
                        </div>

                    </form>

                </div>

                <div class="card-footer text-muted text-end">
                    <small>Gestión de parques</small>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
