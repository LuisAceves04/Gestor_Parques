<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Crear Usuario</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <input class="form-control mb-3" name="Nombre" placeholder="Nombre" required>
                <input class="form-control mb-3" name="Correo" placeholder="Correo" required>
                <input class="form-control mb-3" name="telefono_usuario" placeholder="Teléfono" required>
                <input class="form-control mb-3" name="Contraseña" placeholder="Contraseña" required>

                <select name="TipoUsuario" class="form-control mb-3" required>
                    <option value="ciudadano">Ciudadano</option>
                    <option value="admin">Administrador</option>
                </select>

                <button class="btn btn-primary">Guardar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
