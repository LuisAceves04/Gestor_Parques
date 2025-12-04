<!DOCTYPE html>
<html>
<head>
    <title>Crear Parque</title>
    <link rel="stylesheet" href="/css/estilos.css">

</head>
<body>
    <h1>Crear Nuevo Parque</h1>

    <form action="{{ route('parques.store') }}" method="POST">
        @csrf
        @method('PUT')    

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" required><br><br>


        <button type="submit">Crear</button>
    </form>

    <a href="{{ route('parques.index') }}">Volver</a>
</body>
</html>
