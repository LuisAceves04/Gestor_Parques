<!DOCTYPE html>
<html>
<head>
    <title>Editar Parque</title>
    <link rel="stylesheet" href="/css/estilos.css">

</head>
<body>
    <h1>Editar Parque</h1>

    <form action="{{ route('parques.update', $parque->idParque) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="Nombre" value="{{ $parque->Nombre }}" required><br><br>

    <label>Ubicación:</label>
    <input type="text" name="Ubicacion" value="{{ $parque->Ubicacion }}" required><br><br>

    <label>Descripción:</label>
    <input type="text" name="Descripcion" value="{{ $parque->Descripcion }}" required><br><br>

    <button type="submit">Guardar cambios</button>
</form>


    <a href="{{ route('parques.index') }}">Volver</a>
</body>
</html>
