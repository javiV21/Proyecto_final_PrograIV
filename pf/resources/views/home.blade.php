<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlotChat - Home</title>
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #4ecdc4;
            --dark-color: #292f36;
            --light-color: #f7fff7;
            --gray-light: #f8f9fa;
            --gray-medium: #6c757d;
            --gray-dark: #495057;
            --border-color: #e0e0e0;
            --error-color: #EF4444; /* Tailwind red-500 */
            --success-color: #22C55E; /* Tailwind green-500 */
            --border-radius: 8px; /* General border radius */
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: var(--gray-light);
            color: var(--dark-color);
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1002;
        }

        .feedback-message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95em;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1); /* Light green background */
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1)
            border: 1px solid var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85em;
            margin-top: -10px;
            margin-bottom: 6px;
            display: block;
        }

        /* Sidebar izquierda */
        .sidebar-left {
            width: 240px;
            background-color: white;
            border-right: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            padding: 1rem;
            z-index: 100;
            transition: transform 0.3s ease-in-out; /* Added for smooth mobile transition */
        }

        .sidebar-section {
            margin-bottom: 1.5rem;
        }

        .sidebar-title {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--gray-medium);
            margin-bottom: 0.8rem;
            padding-left: 0.5rem;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 0.3rem;
        }

        .sidebar-menu a {
            display: flex; /* Changed to flex for better alignment with bullet */
            align-items: center; /* Align items vertically */
            padding: 0.5rem;
            border-radius: 4px;
            color: var(--dark-color);
            text-decoration: none;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .sidebar-menu a:hover {
            background-color: var(--gray-light);
            color: var(--primary-color); /* Added hover color */
        }

        .sidebar-menu a.active {
            background-color: rgba(255, 107, 53, 0.1);
            color: var(--primary-color);
            font-weight: 500;
        }

        .sidebar-menu a.active::before {
            content: "•";
            margin-right: 0.5rem;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2em; /* Slightly larger bullet */
            line-height: 1; /* Ensure bullet aligns well */
        }

        .divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 1rem 0;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none; /* Hidden by default for desktop */
            position: fixed;
            bottom: 1rem; /* Adjusted to bottom right */
            right: 1rem;
            background-color: var(--primary-color);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem; /* Larger icon */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1001;
            transition: background-color 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            background-color: #ff5a1f;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                margin-right: 0;
                padding-bottom: 4rem;
            }

            .sidebar-right {
                display: none;
            }

            .sidebar-left {
                transform: translateX(-100%);
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar-left.active {
                transform: translateX(0);
            }

            .mobile-menu-toggle {
                display: flex; /* Show only on mobile */
            }
        }
        /* Contenido principal */
        .main-content {
            flex: 1;
            margin-left: 240px;
            margin-right: 320px;
            padding: 1.5rem;
            background-color: white;
            min-height: 100vh;
        }

        .posts-container {
            max-width: 680px;
            margin: 0 auto;
            max-height: !important;
            overflow: visible !important;
        }

        .post-placeholder {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-medium);
            border: 1px dashed var(--border-color);
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .posts-container {
            max-width: 800px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .story-card {
            background: #fff;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.1s ease;
        }

        .story-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-avatar {
            background: var(--gray-light);
            border-radius: 50%;
            padding: 0.3rem 0.5rem;
            font-size: 0.9rem;
        }

        .meta-container {
            line-height: 1.3;
        }

        .story-author {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--dark-color);
            margin: 0;
        }

        .story-time {
            font-size: 0.75rem;
            color: var(--gray-medium);
            margin: 0;
        }

        .story-category {
            background: var(--gray-light);
            color: var(--gray-dark);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .story-title {
            font-size: 1.1rem;
            color: var(--dark-color);
            margin: 0 0 0.5rem 0;
            line-height: 1.4;
        }

        .story-content {
            font-size: 0.9rem;
            color: var(--gray-dark);
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .story-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid var(--border-color);
        }

        .action-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .vote-btn {
            background: none;
            border: none;
            font-size: 1.1rem;
            cursor: pointer;
            color: var(--gray-medium);
            padding: 0.2rem;
        }

        .vote-btn:hover {
            color: var(--primary-color);
        }

        .count {
            font-size: 0.8rem;
            color: var(--gray-medium);
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .story-card {
                padding: 0.75rem;
            }

            .story-actions {
                gap: 1rem;
            }

            .story-title {
                font-size: 1rem;
            }

            .story-content {
                font-size: 0.85rem;
            }
        }


        /* Sidebar derecha */
        .sidebar-right {
            width: 320px;
            background-color: white;
            border-left: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            overflow-y: auto;
            padding: 1.5rem;
            z-index: 100;
        }

        .main-content {
            padding-bottom: 200px;
            /* o el alto estimado del footer */
        }

        .sidebar-left,
        .sidebar-right {
            margin-top: 60px;
            /* Ajusta según la altura real de tu navbar */
        }

        footer {
            position: relative;
            z-index: 101;
            /* Mayor que el de sidebars (100) */
        }

        .community-card {
            background-color: var(--gray-light);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .community-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .community-name {
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .community-meta {
            font-size: 0.8rem;
            color: var(--gray-medium);
            margin-bottom: 0.8rem;
        }

        .community-description {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .join-btn {
            display: block;
            width: 100%;
            padding: 0.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .join-btn:hover {
            background-color: #ff5a1f;
        }

        .post-stats {
            display: flex;
            gap: 1rem;
            margin-top: 0.8rem;
            font-size: 0.8rem;
            color: var(--gray-medium);
        }

        .footer-links {
            margin-top: 2rem;
            font-size: 0.8rem;
            color: var(--gray-medium);
        }

        .footer-links a {
            color: var(--gray-medium);
            text-decoration: none;
            margin-right: 0.8rem;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .copyright {
            margin-top: 1rem;
            font-size: 0.8rem;
            color: var(--gray-medium);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                margin-right: 0;
                padding-bottom: 4rem;
            }

            .sidebar-right {
                display: none;
            }

        }

        @media (min-width: 993px) {
            .mobile-menu-toggle {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <header>
        @include('partials.logNavbar')
    </header>
    <!-- Sidebar izquierda -->
    <aside class="sidebar-left" id="sidebarLeft">
        <div class="sidebar-section">
            <h3 class="sidebar-title">Principal</h3>
            <ul class="sidebar-menu">
                <li><a href="/home" class="active">Popular</a></li>
            </ul>
        </div>

        <div class="divider"></div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Ver categorías</h3>
            <ul class="sidebar-menu">
                <li><a href="{{ route('categorias.index') }}">Ve y descubre las categorías de contenido disponible</a></li>
            </ul>
        </div>

        <div class="divider"></div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Más</h3>
            <ul class="sidebar-menu">
                <li><a href="/createPost">Crear una historia</a></li>
                <li><a href="{{ route('user.profile') }}">Ve tu perfil</a></li>
            </ul>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="posts-container">
            @if(session('status'))
                <p class="feedback-message success">
                    {{ session('status') }}
                </p>
            @endif
            @if(session('error'))
                <p class="feedback-message error">
                    {{ session('error') }}
                </p>
            @endif
            @forelse($historias as $h)
                <article class="story-card clickable" data-url="{{ route('historias.show', $h) }}">
                    <div class="story-header">
                        <div class="author-info">
                            <span
                                class="user-avatar">{{ strtoupper(substr($h->user->name ?? $h->user->username, 0, 1)) }}</span>
                            <div class="meta-container">
                                <p class="story-author">{{ $h->user->username }}</p>
                                <p class="story-time">{{ $h->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="story-category">{{ $h->categoria->nombre }}</span>
                    </div>

                    <div class="story-body">
                        <h2 class="story-title">{{ $h->titulo }}</h2>
                        <div class="story-content">
                            {{ Str::limit($h->contenido, 500) }}
                        </div>
                    </div>
                    <div class="story-actions">
                        <div class="action-item">
                            <form method="POST" action="{{ route('reacc_historias.store') }}">
                                @csrf
                                <input type="hidden" name="historia_id" value="{{ $h->id }}">
                                <input type="hidden" name="reaccion" value="1">
                                <button class="vote-btn" id="positive-vote">▲</button>
                            </form>
                            <span class="count">{{ $h->reacciones_count }}</span>
                            <form method="POST" action="{{ route('reacc_historias.store') }}">
                                @csrf
                                <input type="hidden" name="historia_id" value="{{ $h->id }}">
                                <input type="hidden" name="reaccion" value="-1">
                                <button class="vote-btn" id="negative-vote">▼</button>
                            </form>
                        </div>
                        <div class="action-item">
                            <span class="comment-icon">💬</span>
                            <span class="count">{{ $h->comentarios_count }} comentarios</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="post-placeholder">
                    No hay historias aún. ¡Sé el primero en publicar!
                </div>
            @endforelse
        </div>
    </main>

    <!-- Sidebar derecha -->
    <aside class="sidebar-right" id="sidebarRight">
        <h3 class="sidebar-title">Mejores hsitorias</h3>

        <div class="community-card">
            <div class="community-header">
                <span>!</span>
                <span class="community-name">Ve las categorías</span>
            </div>
            <div class="community-meta">Sugerido para ti</div>
            <button class="join-btn">Vamos  a ver</button>
            <div class="community-description">
                Ve contenido de las categorías que más te interesan. ¡Descubre nuevas historias y comparte las tuyas!
            </div>
        </div>

        <div class="footer-links">
            <a href="/policies">Reglas de Plotchat</a>
            <a href="/policies">Política de privacidad</a>
        </div>
        <div class="copyright">
            PlotChat, inc. © 2025. Todos los derechos reservados.
        </div>
    </aside>

    <!-- Menús móviles -->
    <div class="mobile-menu-toggle" id="mobileMenuToggle"></div>
<script>
        // Animación al pasar el mouse sobre las tarjetas
        document.querySelectorAll('.story-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'scale(1.02)';
                card.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'scale(1)';
                card.style.boxShadow = 'none';
            });
        });

        // Clickear historia y redirigir a la página de historia
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.story-card.clickable').forEach(card => {
                card.style.cursor = 'pointer';
                card.addEventListener('click', (event) => {
                    // Prevent navigation if an action button (like vote) was clicked
                    if (event.target.closest('.vote-btn') || event.target.closest('form')) {
                        return;
                    }
                    window.location.href = card.dataset.url;
                });
            });

            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebarLeft = document.getElementById('sidebarLeft');
            const joinBtn = document.querySelector('.join-btn');

            if (joinBtn) {
                joinBtn.addEventListener('click', function () {
                    window.location.href = '/categorias';
                });
            }

            if (mobileMenuToggle && sidebarLeft) {
                mobileMenuToggle.addEventListener('click', function (event) {
                    event.stopPropagation(); // Prevent this click from closing the sidebar immediately
                    sidebarLeft.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside of it on mobile
            document.addEventListener('click', function (e) {
                if (window.innerWidth <= 992) {
                    if (sidebarLeft.classList.contains('active') && !sidebarLeft.contains(e.target) && e.target !== mobileMenuToggle) {
                        sidebarLeft.classList.remove('active');
                    }
                }
            });

            // Smooth scroll for sidebar links (if they target sections on the same page)
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function (e) {
                    if (window.innerWidth <= 992) {
                        // Check if the link is an internal anchor
                        const href = this.getAttribute('href');
                        if (href && href.startsWith('#')) {
                            e.preventDefault();
                            const target = document.querySelector(href);
                            if (target) {
                                window.scrollTo({
                                    top: target.offsetTop - 20, // Adjust offset as needed
                                    behavior: 'smooth'
                                });
                            }
                        }
                        sidebarLeft.classList.remove('active'); // Always close sidebar after clicking a link
                    }
                });
            });
        });
    </script>
</body>
<footer>
    @include('partials.footer')
</footer>

</html>