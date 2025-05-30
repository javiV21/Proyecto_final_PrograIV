<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - Cuenta</title>
    <style>
        /* Variables globales */
        :root {
            --color-primary: #ff6b35;
            --color-primary-hover: #e55a28;
            --color-secondary: #4ecdc4;
            --color-bg: #f7fff7;
            --color-surface: #ffffff;
            --color-text: #2d2d2d;
            --color-text-muted: #6c757d;
            --radius: 0.5rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --transition: 0.3s ease;
            --font-base: 1rem;
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; /* Modern font stack */
        }

        /* Reset y base */
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font: var(--font-base)/1.6 var(--font-family);
            background: var(--color-bg);
            color: var(--color-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header, footer { flex-shrink: 0; }
        main {
            flex: 1;
            padding: var(--spacing-lg);
            display: flex;
            justify-content: center;
            align-items: center; /* Center content vertically */
        }

        /* Contenedor de formulario */
        .form-container {
            background: var(--color-surface);
            padding: var(--spacing-lg);
            border-radius: var(--radius);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* More prominent, yet subtle shadow */
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        }

        .form-title {
            font-size: 2rem; /* Larger title */
            text-align: center;
            margin: 0 0 var(--spacing-md) 0; /* Adjusted margin */
            color: var(--color-primary); /* Primary color for emphasis */
            font-weight: 700; /* Bolder */
        }

        /* Adjusted form to directly use grid for better control */
        form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg); /* Consistent gap within the form itself */
        }

        /* A partir de tablets (>=600px), 2 columnas */
        @media(min-width: 600px) {
            .edit-grid {
                display: grid; /* Enable grid layout */
                grid-template-columns: 1fr 1fr; /* Two columns */
                gap: var(--spacing-md); /* Gap between grid items */
            }
        }

        /* Clase para ocupar todo el ancho en grid */
        .full-width { grid-column: 1 / -1; }

        .form-group {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: var(--spacing-sm);
            font-weight: 600;
            color: var(--color-text); /* Stronger color for labels */
            font-size: 0.95rem; /* Slightly larger label text */
        }
        input {
            /* Adjusted padding to make inputs less tall */
            padding: 0.6rem var(--spacing-md);
            border: 1px solid #e0e0e0; /* Lighter, softer border */
            border-radius: var(--radius);
            font: inherit;
            width: 100%;
            color: var(--color-text);
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 0.2rem rgba(255,107,53,0.25); /* More subtle, wider shadow */
        }
        .hint {
            font-size: 0.825rem; /* Slightly smaller hint text */
            color: var(--color-text-muted);
            margin-top: 0.25rem; /* Small margin above hint */
        }
        .error {
            font-size: 0.825rem; /* Slightly smaller error text */
            color: #dc3545;
            margin-top: 0.25rem; /* Small margin above error */
        }

        button {
            padding: var(--spacing-md) var(--spacing-lg); /* More generous padding */
            border: none;
            border-radius: var(--radius);
            font: inherit;
            font-weight: 600; /* Bolder text */
            cursor: pointer;
            transition: background var(--transition), transform 0.1s ease, box-shadow var(--transition); /* Added transform and shadow transitions */
            text-transform: uppercase; /* Uppercase for buttons */
            letter-spacing: 0.05em; /* Slight letter spacing */
        }
        button:active {
            transform: translateY(1px); /* Simple press effect */
        }

        .btn-primary {
            background: var(--color-primary);
            color: #fff;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for primary button */
        }
        .btn-primary:hover {
            background: var(--color-primary-hover);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15); /* More pronounced shadow on hover */
        }
        .btn-delete {
            background: #dc3545;
            color: #fff;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-delete:hover {
            background: #c82333;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .delete-section {
            border-top: 1px solid #e0e0e0; /* Lighter border for separation */
            padding-top: var(--spacing-lg);
            margin-top: var(--spacing-lg); /* Add margin to separate from the main form */
            text-align: center;
        }
        .delete-title {
            font-size: 1.3rem; /* Adjusted size for clarity */
            color: var(--color-text); /* Stronger color */
            margin-bottom: var(--spacing-sm);
        }
        .delete-section .hint {
            margin-bottom: var(--spacing-md); /* Add spacing below hint in this section */
        }


        /* Accesibilidad (no se modifica) */
        [aria-invalid="true"] { border-color: #dc3545 !important; }
    </style>
</head>

<body>
    <header>
        @include('partials.logNavbar')
    </header>
    <main>
        <section class="form-container" aria-labelledby="edit-account-title">
            <h1 id="edit-account-title" class="form-title">Editar Cuenta</h1>
            <form action="{{ route('user.update', Auth::id()) }}" method="POST" novalidate>
                @csrf @method('PUT')
                <div class="edit-grid">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required aria-required="true">
                        <span class="error" id="error-name"></span>
                    </div>
                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" required>
                        <span class="error" id="error-username"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
                        <span class="error" id="error-email"></span>
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" min="1" max="120" value="{{ Auth::user()->edad }}" required>
                        <span class="error" id="error-edad"></span>
                    </div>
                    <div class="form-group full-width">
                        <label for="current_password">Contraseña actual</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Ingresa tu contraseña actual" required aria-required="true">
                        <span class="error" id="error-current"></span>
                    </div>
                    <div class="form-group full-width">
                        <label for="password">Nueva contraseña <small class="hint">(Opcional)</small></label>
                        <input type="password" id="password" name="password" placeholder="Deja en blanco para no cambiarla">
                        <span class="hint">Mínimo 8 caracteres</span>
                        <span class="error" id="error-password"></span>
                    </div>
                    <div class="form-group full-width">
                        <label for="password_confirmation">Confirmar nueva contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la nueva contraseña">
                        <span class="error" id="error-confirm"></span>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Guardar Cambios</button>
            </form>

            <div class="delete-section">
                <h2 class="delete-title">Eliminar Cuenta</h2>
                <p class="hint">Esta acción es irreversible.</p>
                <form action="{{ route('user.destroy', Auth::id()) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="button" id="delete-account-btn" class="btn-delete">Eliminar Cuenta</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        @include('partials.footer')
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form[method="POST"]');
            const fields = ['name', 'username', 'email', 'edad', 'current_password', 'password', 'password_confirmation'];

            // Validación en tiempo real
            fields.forEach(id => {
                const input = document.getElementById(id);
                // The error span ID in your original code uses `error-name` for `name`, `error-current` for `current_password`, etc.
                // It's not `error-current_password`. I'm keeping the original logic's expected ID for consistency.
                const error = document.getElementById(`error-${id.split('_')[0]}`);
                if (input && error) { // Ensure elements exist
                    input.addEventListener('input', () => validateField(input, error));
                }
            });

            function validateField(input, errorEl) {
                let valid = true;
                let msg = '';
                if (input.required && !input.value.trim()) { valid = false; msg = 'Este campo es obligatorio'; }
                if (valid && input.type === 'email') {
                    const re = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                    if (!re.test(input.value)) { valid = false; msg = 'Formato de email inválido'; }
                }
                if (valid && input.id === 'password' && input.value.length > 0 && input.value.length < 8) {
                    valid = false; msg = 'Mínimo 8 caracteres';
                }
                if (valid && input.id === 'password_confirmation') {
                    const pw = document.getElementById('password').value;
                    if (input.value !== pw) { valid = false; msg = 'Las contraseñas no coinciden'; }
                }
                if (!valid) {
                    input.setAttribute('aria-invalid', 'true');
                    errorEl.textContent = msg;
                } else {
                    input.removeAttribute('aria-invalid');
                    errorEl.textContent = '';
                }
                return valid;
            }

            form.addEventListener('submit', e => {
                let allValid = true;
                fields.forEach(id => {
                    const input = document.getElementById(id);
                    // Again, using the original logic's expected error ID
                    const error = document.getElementById(`error-${id.split('_')[0]}`);
                    if (input && error && !validateField(input, error)) allValid = false;
                });
                if (!allValid) e.preventDefault();
            });

            // Confirmación de eliminación
            document.getElementById('delete-account-btn').addEventListener('click', () => {
                if (confirm('¿Seguro que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
                    document.querySelector('.delete-section form').submit();
                }
            });
        });
    </script>
</body>

</html>