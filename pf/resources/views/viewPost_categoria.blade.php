@if(!request()->ajax())
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías y Publicaciones - PlotChat</title>
    <style>
        :root {
            --primary-color: #ff6b35; /* Naranja */
            --secondary-color: #4ecdc4; /* Turquesa */
            --dark-color: #292f36; /* Azul oscuro */
            --light-color: #f7fff7; /* Blanco casi puro */
            --gray-light: #f8f9fa; /* Gris muy claro */
            --gray-medium: #6c757d; /* Gris medio */
            --gray-dark: #495057; /* Gris oscuro */
            --border-color: #e0e0e0; /* Gris para bordes */
            --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.05);
            --shadow-medium: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition-ease: all 0.2s ease-in-out;
            --font-main: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--gray-light);
            color: var(--dark-color);
            font-family: var(--font-main);
            line-height: 1.6;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: var(--light-color);
            box-shadow: var(--shadow-light);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .container-layout {
            display: flex;
            flex-grow: 1;
            padding-top: 1rem; /* Espacio para el header si no es fixed */
            padding-bottom: 1rem; /* Espacio para el footer si no es fixed */
            gap: 2rem;
            max-width: 1400px; /* Ancho máximo para el layout principal */
            margin: 0 auto; /* Centrar el layout */
            width: 100%;
        }

        /* Sidebar de Categorías */
        .sidebar-categories {
            flex-shrink: 0;
            width: 280px; /* Ancho fijo para la sidebar de categorías */
            background-color: var(--light-color);
            border-radius: 8px;
            box-shadow: var(--shadow-light);
            padding: 1.5rem;
            align-self: flex-start; /* Se alinea al inicio y no crece */
            position: sticky;
            top: calc(1rem + 60px); /* Ajustar según altura del header */
            max-height: calc(100vh - 2rem - 60px - 60px); /* Altura dinámica, ajusta por header/footer */
            overflow-y: auto;
        }

        .sidebar-categories h2 {
            font-size: 1.3rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
            font-weight: 700;
        }

        .category-list {
            display: grid;
            gap: 0.75rem;
        }

        .category-card {
            background: var(--gray-light);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.8rem 1.2rem;
            transition: var(--transition-ease);
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--dark-color);
            text-align: left;
            display: block; /* Asegura que el div actúa como bloque */
            text-decoration: none; /* Si fuera un enlace */
        }

        .category-card:hover {
            background-color: var(--border-color);
            box-shadow: var(--shadow-light);
            transform: translateY(-2px);
        }

        .category-card.selected {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px var(--primary-color), var(--shadow-medium);
            background-color: rgba(255, 107, 53, 0.08); /* Fondo claro con el color primario */
            color: var(--primary-color);
            font-weight: 600;
            transform: translateY(0);
        }

        /* Sección de Historias */
        .stories-section {
            flex-grow: 1;
            padding: 1.5rem;
            background-color: var(--light-color);
            border-radius: 8px;
            box-shadow: var(--shadow-light);
        }

        .stories-section h2 {
            font-size: 1.8rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            font-weight: 700;
            text-align: center;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Columnas adaptables */
            gap: 1.5rem;
        }

        .story-card {
            background: var(--light-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1.2rem;
            transition: var(--transition-ease);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: var(--shadow-light);
        }

        .story-card:hover {
            box-shadow: var(--shadow-medium);
            transform: translateY(-3px);
        }

        .story-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap; /* Permite que los elementos se envuelvan */
            gap: 0.5rem;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            background: var(--secondary-color);
            color: white;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 600;
            flex-shrink: 0; /* No se encoge */
        }

        .meta-container {
            line-height: 1.3;
        }

        .story-author {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--dark-color);
            margin: 0;
        }

        .story-time {
            font-size: 0.75rem;
            color: var(--gray-medium);
            margin: 0;
        }

        .story-category-tag { /* Cambiado de story-category para evitar conflictos y ser más específico */
            background: var(--gray-light);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--gray-dark);
            white-space: nowrap; /* Evita que se rompa el texto */
        }

        .story-title {
            font-size: 1.3rem;
            margin: 0 0 0.75rem;
            line-height: 1.4;
            color: var(--dark-color);
            font-weight: 700;
        }

        .story-content {
            font-size: 0.95rem;
            margin-bottom: 1rem;
            color: var(--gray-dark);
            line-height: 1.6;
            flex-grow: 1; /* Permite que el contenido crezca */
        }

        .story-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding-top: 0.75rem;
            border-top: 1px solid var(--border-color);
            margin-top: 1rem;
        }

        .action-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--gray-medium);
            font-size: 0.9rem;
        }

        .vote-btn {
            background: none;
            border: none;
            font-size: 1.3rem;
            cursor: pointer;
            color: var(--gray-medium);
            transition: color 0.2s ease;
        }

        .vote-btn:hover {
            color: var(--primary-color);
        }

        .count {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--gray-dark);
        }

        /* Mensaje de no historias */
        .no-stories-message {
            text-align: center;
            color: var(--gray-medium);
            font-size: 1.1em;
            padding: 30px;
            background-color: var(--gray-light);
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: var(--shadow-light);
        }


        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: var(--gray-medium);
            padding: 2rem;
            text-align: center;
            font-size: 0.85rem;
            margin-top: auto; /* Empuja el footer al final de la página */
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container-layout {
                flex-direction: column;
                gap: 1.5rem;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .sidebar-categories {
                width: 100%;
                position: static; /* Deja de ser sticky en pantallas pequeñas */
                max-height: none;
                margin-bottom: 1.5rem;
            }

            .stories-section {
                padding: 1rem;
            }

            .stories-section h2 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .posts-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar-categories {
                padding: 1rem;
            }

            .sidebar-categories h2 {
                font-size: 1.2rem;
                margin-bottom: 1rem;
            }

            .category-card {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .stories-section h2 {
                font-size: 1.3rem;
                text-align: left; /* Alinear título a la izquierda en móvil */
            }

            .story-card {
                padding: 1rem;
            }

            .story-title {
                font-size: 1.1rem;
            }

            .story-content {
                font-size: 0.85rem;
            }

            .story-actions {
                gap: 0.8rem;
                flex-wrap: wrap;
            }

            .vote-btn {
                font-size: 1.1rem;
            }

            .count {
                font-size: 0.8rem;
            }
            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .posts-grid {
                grid-template-columns: 1fr; /* Una columna en pantallas muy pequeñas */
            }

            .sidebar-categories {
                padding: 0.75rem;
            }

            .category-card {
                font-size: 0.85rem;
            }

            .story-card {
                padding: 0.8rem;
            }

            .story-title {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>@include('partials.logNavbar')</header>

    <div class="container-layout">
        {{-- ASIDE: Categorías --}}
        <aside class="sidebar-categories">
            <h2>Categorías</h2>
            <div class="category-list">
                @foreach($categorias as $cat)
                    <div
                        class="category-card {{ optional($categoria)->id === $cat->id ? 'selected' : '' }}"
                        data-url="{{ route('categorias.historias.ajax', $cat) }}"
                    >
                        {{ $cat->nombre }}
                    </div>
                @endforeach
            </div>
        </aside>

        {{-- SECTION: Historias --}}
        <section class="stories-section">
            <h2 id="stories-section-title">
                {{ $categoria
                    ? 'Historias de: '.$categoria->nombre
                    : 'Publicaciones Recientes'
                }}
            </h2>
            <div class="posts-grid" id="historias-container">
                {{-- Si al entrar por URL había categoría, ya vienen historias cargadas --}}
                @include('partials._historias_list', ['historias' => $historias])
            </div>
        </section>
    </div>

    <footer>@include('partials.footer')</footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const historiasContainer = document.getElementById('historias-container');
            const categoryCards = document.querySelectorAll('.category-card');
            const storiesSectionTitle = document.getElementById('stories-section-title');
            const defaultTitle = storiesSectionTitle.textContent.trim();

            const loadStories = (url, categoryName = null) => {
                historiasContainer.innerHTML = '<p class="no-stories-message">Cargando historias...</p>';

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error de red al cargar historias.');
                    }
                    return response.text();
                })
                .then(html => {
                    historiasContainer.innerHTML = html;
                    if (categoryName) {
                        storiesSectionTitle.textContent = `Historias de: ${categoryName}`;
                    } else {
                        storiesSectionTitle.textContent = defaultTitle;
                    }
                    attachVoteListeners();
                })
                .catch(error => {
                    console.error('Error al cargar historias:', error);
                    historiasContainer.innerHTML = '<p class="no-stories-message" style="color: #dc3545;">Error al cargar las historias. Por favor, inténtalo de nuevo.</p>';
                    storiesSectionTitle.textContent = defaultTitle;
                });
            };

            categoryCards.forEach(card => {
                card.addEventListener('click', () => {
                    categoryCards.forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    loadStories(card.dataset.url, card.textContent.trim());
                });
            });

            const attachVoteListeners = () => {
                document.querySelectorAll('.vote-btn').forEach(button => {
                    button.removeEventListener('click', handleVote);
                    button.addEventListener('click', handleVote);
                });
            };

            const handleVote = (event) => {
                const button = event.currentTarget;
                const storyId = button.dataset.storyId;
                const voteType = button.dataset.voteType;

                const countSpan = button.parentNode.querySelector('.count');

                fetch('/votar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        historia_id: storyId, // Cambiado de 'story_id' a 'historia_id' para que coincida con el controlador
                        reaccion: voteType === 'up' ? 1 : -1 // Mapea 'up' a 1 y 'down' a -1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        countSpan.textContent = data.new_reacciones_count;
                    } else {
                        alert(data.message || 'Error al votar.');
                    }
                })
                .catch(error => {
                    console.error('Error en la votación AJAX:', error);
                    alert('Hubo un error al procesar tu voto.');
                });
            };

            attachVoteListeners();
        });
    </script>
</body>
</html>
@else
    {{-- Sólo fragmento de historias (AJAX) --}}
    @include('partials._historias_list', ['historias' => $historias])
@endif