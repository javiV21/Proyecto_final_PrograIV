<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Historia</title>
    <style>
        :root {
            --primary: #ff6b35;
            --primary-hover: #e55a28;
            --bg: #f7fff7;
            --surface: #fff;
            --text: #2d2d2d;
            --muted: #6c757d;
            --radius: .5rem;
            --spacing: 1rem;
            --transition: .3s;
            --font: 1rem 'Helvetica Neue', Arial, sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font: var(--font);
            background: var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header,
        footer {
            flex-shrink: 0;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: var(--spacing);
        }

        .form-container {
            background: var(--surface);
            padding: var(--spacing);
            border-radius: var(--radius);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: var(--spacing);
        }

        h1 {
            margin: 0;
            text-align: center;
            color: var(--primary);
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: .5rem;
            font-weight: 600;
            color: var(--muted);
        }

        input,
        select,
        textarea {
            padding: .5rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font: inherit;
            transition: border-color var(--transition);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        .error {
            color: #dc3545;
            font-size: .875rem;
        }

        button {
            padding: .75rem;
            border: none;
            border-radius: var(--radius);
            font: inherit;
            cursor: pointer;
            transition: background var(--transition);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            width: 100%;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-delete {
            background: #dc3545;
            color: #fff;
            width: 100%;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .delete-section {
            border-top: 1px solid #ddd;
            padding-top: var(--spacing);
        }
    </style>
</head>

<body>
    <header>
        @include('partials.logNavbar')
    </header>
    <main>
        <section class="form-container" aria-labelledby="edit-historia-title">
            <h1 id="edit-historia-title">Editar Comentario</h1>

            {{-- Formulario de edición --}}
            <form action="{{ route('comentarios.update', $comentario) }}" method="POST" novalidate>
                @csrf @method('PUT')

                {{-- Contenido --}}
                <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <textarea id="contenido" name="contenido" required
                        aria-required="true">{{ old('contenido', $comentario->contenido) }}</textarea>
                    @error('contenido')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">Guardar Cambios</button>
            </form>

            {{-- Sección de eliminación --}}
            <div class="delete-section">
                <h2>Eliminar Comentario</h2>
                <p class="error">Esta acción es irreversible.</p>
                <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete"
                        onclick="return confirm('¿Seguro que deseas eliminar esta historia?')">
                        Eliminar Historia
                    </button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        @include('partials.footer')
    </footer>
</body>

</html>