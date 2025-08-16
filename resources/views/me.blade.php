<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuario Autorizado</title>
    <style>
        body {
            background: linear-gradient(135deg, #7a9a9a 0%, #e5d1c6 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(70,90,90,0.2);
            padding: 40px 50px;
            text-align: center;
            max-width: 400px;
        }
        .card h1 {
            color: #7a9a9a;
            font-size: 2.2em;
            margin-bottom: 10px;
        }
        .card .icon {
            font-size: 3em;
            color: #e5d1c6;
            margin-bottom: 15px;
        }
        .card .user-info {
            margin: 20px 0;
            font-size: 1.1em;
            color: #333;
        }
        .card .token-info {
            background: #f7f7f7;
            border-radius: 8px;
            padding: 10px;
            font-size: 0.95em;
            color: #666;
            word-break: break-all;
        }
        .card .success {
            color: #2ecc71;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="icon">🔒</div>
            <h1>¡Acceso Autorizado!</h1>
            <div class="success">El usuario está autenticado mediante un token JWT.</div>
            <div class="user-info">
                <strong>Nombre:</strong> {{ $user->nombre ?? $user->name ?? 'N/A' }}<br>
                <strong>Apellido:</strong> {{ $user->apellido ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $user->email ?? 'N/A' }}<br>
                <strong>Rol:</strong> {{ $user->rol ?? 'N/A' }}
            </div>
            <div class="token-info">
                <strong>Token:</strong><br>
                {{ $token ?? 'Token no disponible' }}
            </div>
        </div>
    </div>
</body>
</html>
