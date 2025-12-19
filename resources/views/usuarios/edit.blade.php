<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h4>Editar Usuario</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST">
                @csrf
                @method('PUT')

                <input class="form-control mb-3" name="Nombre" value="{{ $usuario->Nombre }}" required>
                <input class="form-control mb-3" name="Correo" value="{{ $usuario->Correo }}" required>
                <input class="form-control mb-3" name="telefono_usuario" value="{{ $usuario->telefono_usuario }}" required>
                <input class="form-control mb-3" name="Contraseña" value="{{ $usuario->Contraseña }}" required>

                <select name="TipoUsuario" class="form-control mb-3">
                    <option value="ciudadano" {{ $usuario->TipoUsuario == 'ciudadano' ? 'selected' : '' }}>Ciudadano</option>
                    <option value="admin" {{ $usuario->TipoUsuario == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>

                <button class="btn btn-warning">Actualizar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
