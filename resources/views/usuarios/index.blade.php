<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid py-4">
    <div class="card shadow">

        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h4 class="mb-0"><i class="fas fa-users me-2"></i> Usuarios</h4>
            <a href="{{ route('usuarios.create') }}" class="btn btn-light">
                <i class="fas fa-plus"></i> Nuevo Usuario
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Tipo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->idUsuario }}</td>
                        <td>{{ $usuario->Nombre }}</td>
                        <td>{{ $usuario->Correo }}</td>
                        <td>{{ $usuario->telefono_usuario }}</td>
                        <td>{{ ucfirst($usuario->TipoUsuario) }}</td>
                        <td class="text-center">
                            <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $usuarios->links() }}
        </div>
    </div>
</div>

</body>
</html>
