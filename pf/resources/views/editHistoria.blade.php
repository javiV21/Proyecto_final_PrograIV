<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Historia</title>
  <style>
    /* Variables globales */
    :root {
      --primary: #ff6b35;
      --primary-hover: #e55a28;
      --secondary: #4ecdc4; /* Keeping secondary from previous example for potential future use */
      --bg: #f7fff7;
      --surface: #ffffff;
      --text: #2d2d2d;
      --muted: #6c757d;
      --error-color: #dc3545; /* Explicit error color variable */
      --radius: .5rem;
      --spacing-sm: 0.5rem;
      --spacing-md: 1rem;
      --spacing-lg: 1.5rem;
      --transition: 0.3s ease;
      --font-base: 1rem;
      --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    }

    /* Reset y base */
    *, *::before, *::after { box-sizing: border-box; }
    body {
      margin: 0;
      padding: 0;
      font: var(--font-base)/1.6 var(--font-family);
      background: var(--bg);
      color: var(--text);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header, footer { flex-shrink: 0; }
    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start; /* Align to top */
      padding: var(--spacing-lg); /* Use consistent large spacing */
    }

    /* Contenedor de formulario */
    .form-container {
      background: var(--surface);
      padding: var(--spacing-lg);
      border-radius: var(--radius);
      box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* More prominent, yet subtle shadow */
      width: 100%;
      max-width: 600px;
      display: flex;
      flex-direction: column;
      gap: var(--spacing-lg); /* Gap between sections (title, form, delete section) */
    }

    h1 {
      font-size: 2rem; /* Larger title */
      text-align: center;
      margin: 0 0 var(--spacing-md) 0; /* Adjusted margin */
      color: var(--primary); /* Primary color for emphasis */
      font-weight: 700; /* Bolder */
    }

    form {
      display: flex; /* Flexbox for direct children of the form */
      flex-direction: column;
      gap: var(--spacing-md); /* Smaller gap for form groups */
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }
    label {
      margin-bottom: var(--spacing-sm);
      font-weight: 600;
      color: var(--text); /* Stronger color for labels */
      font-size: 0.95rem; /* Slightly larger label text */
    }
    input, select, textarea {
      padding: 0.75rem var(--spacing-md); /* Increased padding for better touch targets */
      border: 1px solid #e0e0e0; /* Lighter, softer border */
      border-radius: var(--radius);
      font: inherit; /* Inherit font properties from body */
      color: var(--text);
      transition: border-color var(--transition), box-shadow var(--transition);
      width: 100%; /* Ensure inputs take full width of their container */
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 0.2rem rgba(255,107,53,0.25); /* More subtle, wider shadow */
    }
    textarea {
      resize: vertical;
      min-height: 120px; /* Slightly reduced min-height for textarea */
    }

    .error {
      color: var(--error-color);
      font-size: 0.825rem; /* Slightly smaller error text */
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
      width: 100%; /* Ensure buttons take full width */
    }
    button:active {
      transform: translateY(1px); /* Simple press effect */
    }

    .btn-primary {
      background: var(--primary);
      color: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for primary button */
    }
    .btn-primary:hover {
      background: var(--primary-hover);
      box-shadow: 0 4px 8px rgba(0,0,0,0.15); /* More pronounced shadow on hover */
    }
    .btn-delete {
      background: var(--error-color);
      color: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .btn-delete:hover {
      background: #c82333; /* Darker red for hover */
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .delete-section {
      border-top: 1px solid #e0e0e0; /* Lighter border for separation */
      padding-top: var(--spacing-lg);
      margin-top: var(--spacing-md); /* Consistent spacing with other form elements */
      text-align: center;
    }
    .delete-section h2 {
      font-size: 1.3rem; /* Adjusted size for clarity */
      color: var(--text); /* Stronger color */
      margin-bottom: var(--spacing-sm);
    }
    .delete-section p.error { /* Use error color for irreversible message */
      margin-top: 0; /* Remove top margin from paragraph in this context */
      margin-bottom: var(--spacing-md); /* Add spacing below hint in this section */
      font-size: 0.9rem; /* Slightly larger for emphasis */
      font-weight: 500;
    }
     .delete-section form { /* Remove gap for the delete button form */
        gap: 0;
     }

    /* Accessibility (no se modifica) */
    [aria-invalid="true"] { border-color: var(--error-color) !important; }
  </style>
</head>
<body>
  <header>
    @include('partials.logNavbar')
  </header>
  <main>
    <section class="form-container" aria-labelledby="edit-historia-title">
      <h1 id="edit-historia-title">Editar Historia</h1>

      {{-- Formulario de edición --}}
      <form action="{{ route('historias.update', $historia) }}" method="POST" novalidate>
        @csrf @method('PUT')

        {{-- Título --}}
        <div class="form-group">
          <label for="titulo">Título</label>
          <input
            type="text"
            id="titulo"
            name="titulo"
            value="{{ old('titulo', $historia->titulo) }}"
            required
            aria-required="true"
          >
          @error('titulo')
            <span class="error">{{ $message }}</span>
          @enderror
        </div>

        {{-- Categoría --}}
        <div class="form-group">
          <label for="categoria_id">Categoría</label>
          <select id="categoria_id" name="categoria_id" required>
            <option value="">-- Selecciona una categoría --</option>
            @foreach($categorias as $cat)
              <option
                value="{{ $cat->id }}"
                {{ old('categoria_id', $historia->categoria_id) == $cat->id ? 'selected' : '' }}
              >
                {{ $cat->nombre }}
              </option>
            @endforeach
          </select>
          @error('categoria_id')
            <span class="error">{{ $message }}</span>
          @enderror
        </div>

        {{-- Contenido --}}
        <div class="form-group">
          <label for="contenido">Contenido</label>
          <textarea
            id="contenido"
            name="contenido"
            required
            aria-required="true"
          >{{ old('contenido', $historia->contenido) }}</textarea>
          @error('contenido')
            <span class="error">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="btn-primary">Guardar Cambios</button>
      </form>

      {{-- Sección de eliminación --}}
      <div class="delete-section">
        <h2>Eliminar Historia</h2>
        <p class="error">Esta acción es irreversible.</p>
        <form action="{{ route('historias.destroy', $historia) }}" method="POST">
          @csrf @method('DELETE')
          <button type="submit" class="btn-delete" onclick="return confirm('¿Seguro que deseas eliminar esta historia?')">
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