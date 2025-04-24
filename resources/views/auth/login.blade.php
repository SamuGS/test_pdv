<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fef9ed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-box {
            border-radius: 15px;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .login-left {
            background-color:  #1c2b3a;
            color: #fef9ed;
            padding: 60px 30px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-left h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-left img {
            max-width: 150px;
            margin-top: 20px;
        }

        .login-right {
            background-color: #7ea4a8;
            width: 50%;
            padding: 50px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h3 {
            font-weight: bold;
            margin-bottom: 30px;
            color: #1c2b3a;
        }

        .form-control {
            background-color:  #1c2b3a;;
            border: none;
        }

        .btn-login {
            background-color: #f3b340;
            color: #fff;
            border: none;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #dca531;
        }

        a {
            color: #1c2b3a;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="login-box">
        <!-- Lado izquierdo con texto e imagen -->
        <div class="login-left">
            <h1>INVENTORY<br>MANAGEMENT<br>SYSTEM</h1>
            <img src="{{ asset('images/logoPDV.png') }}" alt="Logo" style="width: 10000px; height: auto;">
        </div>

        <!-- Lado derecho con formulario -->
        <div class="login-right">
            <h3>Iniciar sesión</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Recuérdame</label>
                </div>

                <button type="submit" class="btn btn-login mb-3">Ingresar</button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                @endif
            </form>
        </div>
    </div>
</div>

</body>
</html>
