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

<label>Nombre:</label>
<input type="text" name="Nombre">

<label>Ubicación:</label>
<input type="text" name="Ubicacion">

<label>Descripción:</label>
<input type="text" name="Descripcion">

<button type="submit">Crear</button>
</form>



    <a href="{{ route('parques.create') }}">Crear Parque</a>

</body>
</html>
