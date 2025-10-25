<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center justify-center bg-green-50">
  <div class="text-center">
    <h1 class="text-3xl font-bold text-green-700 mb-4">¡Bienvenido al Dashboard!</h1>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="bg-red-500 text-white px-4 py-2 rounded">Cerrar sesión</button>
    </form>
  </div>
</body>
</html>
