<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background: #e5e5e5;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #7a9a9a;
            border-radius: 10px;
            box-shadow: 0 0 20px #0003;
            display: flex;
            padding: 30px 40px;
            min-width: 600px;
        }
        .form-section {
            background: #fff;
            border-radius: 8px;
            padding: 25px 20px;
            width: 220px;
            margin-right: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-section label {
            color: #333;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .form-section input {
            margin-bottom: 18px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            font-size: 15px;
        }
        .form-section button {
            background: #7a9a9a;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 0;
            font-size: 16px;
            cursor: pointer;
            margin-top: 5px;
        }
        .welcome-section {
            flex: 1;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .welcome-section h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .welcome-section hr {
            width: 80%;
            border: 1px solid #bdbdbd;
            margin: 15px 0;
        }
        .welcome-section a {
            color: #7a9a9a;
            text-decoration: underline;
            font-size: 14px;
            margin: 2px 0;
            display: block;
        }
        .welcome-section .volver {
            margin-top: 15px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <form class="form-section" method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" placeholder="Correo" required>
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Login</button>
            </form>
            <div class="welcome-section">
                <h2>Bienvenido</h2>
                <hr>
                <a href="#">¿Perdiste tu contraseña?</a>
                <a href="#">¿No tienes Cuenta? Regístrate</a>
                <a href="#" class="volver">&lt; Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
