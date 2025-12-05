<!DOCTYPE html>
<html>
<head>
    <title>Listado de Parques</title>
    <link rel="stylesheet" href="/css/estilos.css">

</head>
<body>
    <h1>Parques</h1>

    <a href="{{ route('parques.create') }}">Crear parque nuevo</a>

    <table border="1" cellspacing="0" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parques as $parque)
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>
                        <a href="{{ route('parques.edit', $parque->id) }}">Editar</a>

                        <form action="{{ route('parques.destroy', $parque->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
