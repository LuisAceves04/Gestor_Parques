<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <style>
    body {
      background-color: #111;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #fff;
    }
    .form-container {
      background-color: #222;
      padding: 30px;
      border-radius: 8px;
      width: 300px;
      box-shadow: 0 0 10px #000;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 5px;
      border: none;
    }
    button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      border: none;
      border-radius: 5px;
      background-color: #28a745;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
    a {
      color: #0d6efd;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
    .error {
      background-color: #ff4d4d;
      padding: 5px;
      border-radius: 4px;
      margin-bottom: 8px;
      font-size: 14px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2 style="text-align:center;">Iniciar Sesión</h2>

    @if ($errors->any())
      <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Entrar</button>
    </form>

    <p style="text-align:center; margin-top:10px;">
      ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
    </p>
  </div>
</body>
</html>

