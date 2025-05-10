<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlotChat - Iniciar sesión</title>
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #4ecdc4;
            --dark-color: #292f36;
            --light-color: #f7fff7;
            --hover-color: #f8f9fa;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Estilos del fondo decorativo */
        .background-container {
            flex: 1;
            background: linear-gradient(135deg, rgba(255,107,53,0.1) 0%, rgba(78,205,196,0.1) 100%);
            position: relative;
            display: flex;
            align-items: center;
            padding: 2rem;
        }

        .background-content {
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 2rem;
        }

        .background-content h1 {
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .background-content p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .story-cards {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .story-card {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: var(--shadow);
            width: 150px;
            transition: var(--transition);
        }

        .story-card:hover {
            transform: translateY(-5px);
        }

        .story-card h3 {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .story-card p {
            font-size: 0.8rem;
            color: #888;
        }

        /* Estilos del formulario de login */
        .login-container {
            width: 450px;
            min-height: 100vh;
            background-color: white;
            box-shadow: -5px 0 30px rgba(0, 0, 0, 0.08);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            z-index: 10;
        }

        .login-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .login-header h2 {
            font-size: 2rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #666;
        }

        .login-logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .login-logo::before {
            content: "✍️";
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 38px;
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
        }

        .checkbox-container input {
            margin-right: 0.5rem;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 1.5rem;
        }

        .login-btn:hover {
            background-color: #ff5a1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }

        .social-login {
            margin-bottom: 1.5rem;
        }

        .social-login p {
            text-align: center;
            color: #666;
            margin-bottom: 1rem;
            position: relative;
        }

        .social-login p::before,
        .social-login p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #e0e0e0;
        }

        .social-login p::before {
            left: 0;
        }

        .social-login p::after {
            right: 0;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .background-container {
                display: none;
            }

            .login-container {
                width: 100%;
                max-width: 500px;
                margin: 0 auto;
                box-shadow: none;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .login-header h2 {
                font-size: 1.8rem;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .login-container {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
    <div class="background-container">
        <div class="background-content">
            <h1 style="color: #ff5a1f;">Bienvenido a PlotChat</h1>
            <p>Únete a nuestra comunidad de escritores y lectores. Descubre historias fascinantes, comparte tus relatos y conecta con otros amantes de la literatura.</p>
            
            <div class="story-cards">
                <div class="story-card">
                    <h3>La última noche ...</h3>
                    <p>por @marialectora</p>
                </div>
                <div class="story-card">
                    <h3>El secreto del faro</h3>
                    <p>por @juanescritor</p>
                </div>
            </div>
        </div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">PlotChat</div>
            <h2>Iniciar sesión</h2>
            <p>Ingresa a tu cuenta para continuar</p>
        </div>

        <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="tucorreo@ejemplo.com" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <button type="button" class="password-toggle" id="togglePassword">👁️</button>
            </div>

            <div class="remember-forgot">
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="login-btn">Iniciar sesión</button>
            <div class="register-link">
                ¿No tienes una cuenta? <a href="/signup">Regístrate</a>
            </div>
        </form>
    </div>

    <script>
        // Mostrar/ocultar contraseña
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '👁️‍🗨️';
        });

        // Validación del formulario
        const loginForm = document.getElementById('loginForm');

        loginForm.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Validación simple
            if (!email || !password) {
                alert('Por favor completa todos los campos');
                return;
            }

        });

        // Animación al cargar
        document.addEventListener('DOMContentLoaded', () => {
            const loginContainer = document.querySelector('.login-container');
            loginContainer.style.opacity = '1';
        });
    </script>
</body>
</html>