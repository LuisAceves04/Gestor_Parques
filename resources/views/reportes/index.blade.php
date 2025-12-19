<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Reportes</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">

                {{-- HEADER --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i> Reportes
                    </h4>
                    <a href="{{ route('reportes.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i> Nuevo Reporte
                    </a>
                </div>

                {{-- BODY --}}
                <div class="card-body table-responsive">

                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>IDUsuario</th>
                                <th>Parque</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($reportes as $reporte)
                            <tr>
                                <td class="fw-bold">{{ $reporte->idReporte }}</td>

                                <td>{{ $reporte->idUsuario }}</td>

                                <td>{{ $reporte->idParque }}</td>

                                <td>{{ $reporte->descripcion }}</td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($reporte->estado) }}
                                    </span>
                                </td>

                                <td>{{ $reporte->fecha_reporte }}</td>

                                <td class="text-center">
                                    <a href="{{ route('reportes.edit', $reporte->idReporte) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="alert alert-info mb-0">
                                        No hay reportes registrados.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{-- PAGINACIÓN --}}
                    <div class="mt-3">
                        {{ $reportes->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
