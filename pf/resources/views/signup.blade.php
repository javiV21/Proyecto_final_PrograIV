<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlotChat - Regístrate</title>
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
            background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }

        .background-content {
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 2rem;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .background-content h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .background-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .benefits-list {
            list-style: none;
        }

        .benefits-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .benefits-list li::before {
            content: "✓";
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Estilos del formulario de registro */
        .register-container {
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

        .register-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .register-header h2 {
            font-size: 2rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: #666;
        }

        .register-logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .register-logo::before {
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

        .password-strength {
            height: 4px;
            background: #eee;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            background: #ccc;
            transition: width 0.3s ease;
        }

        .register-btn {
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

        .register-btn:hover {
            background-color: #ff5a1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .background-container {
                display: none;
            }

            .register-container {
                width: 100%;
                max-width: 500px;
                margin: 0 auto;
                box-shadow: none;
            }
        }

        @media (max-width: 576px) {
            .register-container {
                padding: 2rem 1.5rem;
            }

            .register-header h2 {
                font-size: 1.8rem;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .register-container {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Tooltip para requisitos de contraseña */
        .password-requirements {
            display: none;
            position: absolute;
            background: white;
            border: 1px solid #e0e0e0;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
            width: 250px;
            right: 0;
            top: 100%;
            z-index: 100;
            font-size: 0.85rem;
        }

        .password-requirements ul {
            list-style: none;
            margin-top: 0.5rem;
        }

        .password-requirements li {
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .password-requirements li::before {
            content: "•";
            color: var(--primary-color);
        }

        .password-requirements li.valid {
            color: #4CAF50;
        }

        .password-requirements li.valid::before {
            content: "✓";
        }

        .show-password-requirements .password-requirements {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Contenido decorativo del lado izquierdo -->
    <div class="background-container">
        <div class="background-content">
            <h1 style="color: #ff5a1f;">Únete a nuestra comunidad</h1>
            <p>Regístrate en PlotChat y comienza a compartir tus historias con miles de lectores apasionados.</p>
            
            <ul class="benefits-list">
                <li>Publica tus relatos y recibe feedback</li>
                <li>Conecta con otros escritores y lectores</li>
                <li>Descubre historias de todo el mundo</li>
                <li>Personaliza tu perfil de escritor</li>
                <li>Participa en desafíos literarios</li>
            </ul>
        </div>
    </div>

    <!-- Formulario de registro a la derecha -->
    <div class="register-container">
        <div class="register-header">
            <div class="register-logo">PlotChat</div>
            <h2>Crea tu cuenta</h2>
            <p>Comienza tu viaje literario hoy mismo</p>
        </div>

        <form id="registerForm">
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" class="form-control" placeholder="ejemplo123" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" class="form-control" placeholder="tucorreo@ejemplo.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" class="form-control" placeholder="••••••••" required>
                <button type="button" class="password-toggle" id="togglePassword">👁️</button>
                <div class="password-strength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="password-requirements" id="passwordRequirements">
                    <strong>Tu contraseña debe contener:</strong>
                    <ul>
                        <li id="req-length">Al menos 8 caracteres</li>
                        <li id="req-uppercase">Una letra mayúscula</li>
                        <li id="req-number">Un número</li>
                        <li id="req-special">Un carácter especial</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirmar contraseña</label>
                <input type="password" id="confirmPassword" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="register-btn">Registrarse</button>

            <div class="login-link">
                ¿Ya tienes una cuenta? <a href="/login">Inicia sesión</a>
            </div>
        </form>
    </div>

    <script>
        // Mostrar/ocultar contraseña
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordRequirements = document.getElementById('passwordRequirements');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            confirmPassword.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '👁️‍🗨️';
        });

        // Validación de contraseña en tiempo real
        password.addEventListener('input', function() {
            const value = this.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            
            // Verificar requisitos
            const hasLength = value.length >= 8;
            const hasUppercase = /[A-Z]/.test(value);
            const hasNumber = /[0-9]/.test(value);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(value);
            
            // Actualizar indicadores visuales
            document.getElementById('req-length').classList.toggle('valid', hasLength);
            document.getElementById('req-uppercase').classList.toggle('valid', hasUppercase);
            document.getElementById('req-number').classList.toggle('valid', hasNumber);
            document.getElementById('req-special').classList.toggle('valid', hasSpecial);
            
            // Calcular fortaleza (simple)
            let strength = 0;
            if (hasLength) strength += 25;
            if (hasUppercase) strength += 25;
            if (hasNumber) strength += 25;
            if (hasSpecial) strength += 25;
            
            // Actualizar barra
            strengthBar.style.width = strength + '%';
            
            // Cambiar color según fortaleza
            if (strength < 50) {
                strengthBar.style.backgroundColor = '#ff5252';
            } else if (strength < 75) {
                strengthBar.style.backgroundColor = '#ffb142';
            } else {
                strengthBar.style.backgroundColor = '#4CAF50';
            }
        });


        // Validación del formulario
        const registerForm = document.getElementById('registerForm');

        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;
            
            // Validaciones
            if (!username || !email || !password || !confirmPassword) {
                alert('Por favor completa todos los campos');
                return;
            }
            
            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                return;
            }

        });

        // Animación al cargar
        document.addEventListener('DOMContentLoaded', () => {
            const registerContainer = document.querySelector('.register-container');
            registerContainer.style.opacity = '1';
        });
    </script>
</body>
</html>