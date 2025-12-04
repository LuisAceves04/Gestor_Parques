<!DOCTYPE html>
<html>
<head>
    <title>Editar Parque</title>
    <link rel="stylesheet" href="/css/estilos.css">

</head>
<body>
    <h1>Editar Parque</h1>

    <form action="{{ route('parques.update', $parque->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value=" " required><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" value=" " required><br><br>

        <button type="submit">Guardar cambios</button>
    </form>

    <a href="{{ route('parques.index') }}">Volver</a>
</body>
</html>
