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
            display: block;
            padding: 0.5rem;
            border-radius: 4px;
            color: var(--dark-color);
            text-decoration: none;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .sidebar-menu a:hover {
            background-color: var(--gray-light);
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
        }

        .divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 1rem 0;
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

            .sidebar-left {
                transform: translateX(-100%);
                transition: var(--transition);
                z-index: 999;
                background-color: white;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .mobile-menu-toggle {
                display: flex;
                position: fixed;
                top: 4rem;
                right: 1rem;
                background-color: var(--primary-color);
                color: white;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                align-items: center;
                justify-content: center;
                z-index: 1001;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                cursor: pointer;
            }
            
            .sidebar-left.active {
                transform: translateX(0);
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
                <li><a href="#" class="active">Popular</a></li>
                <li><a href="#">Explorar</a></li>
                <li><a href="#">Todos</a></li>
            </ul>
        </div>

        <div class="divider"></div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Feeds Personalizadas</h3>
            <ul class="sidebar-menu">
                <li><a href="#">Crear una Feed personalizado</a></li>
            </ul>
        </div>

        <div class="divider"></div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Comunidades</h3>
            <ul class="sidebar-menu">
                <li><a href="#">Crear una comunidad</a></li>
                <li><a href="#">/AskPlotchat</a></li>
                <li><a href="#">/confession</a></li>
                <li><a href="#">/esConversacion</a></li>
            </ul>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="posts-container">
            <div class="post-placeholder">
                Área de publicaciones (scroll vertical)
            </div>
            <div class="post-placeholder">
                Las publicaciones aparecerán aquí
            </div>
            <div class="post-placeholder">
                Contenido central scrollable
            </div>
            <div class="post-placeholder">
                Más espacio para publicaciones
            </div>
        </div>
    </main>

    <!-- Sidebar derecha -->
    <aside class="sidebar-right" id="sidebarRight">
        <h3 class="sidebar-title">Mejores Comunidades</h3>

        <div class="community-card">
            <div class="community-header">
                <span>!</span>
                <span class="community-name">PlotchatPregunta</span>
            </div>
            <div class="community-meta">hace 4 d • Sugerido para ti</div>
            <button class="join-btn">Unirse</button>
            <div class="community-description">
                Para ex's visitantes de la deep web cuál fue lo más turbio que vieron?
            </div>
            <div class="post-stats">
                <span>24 comentarios</span>
                <span>239 votos</span>
                <span>Compartir</span>
            </div>
        </div>

        <div class="community-card">
            <div class="community-header">
                <span>!</span>
                <span class="community-name">NecesitoDesahogarme</span>
            </div>
            <div class="community-meta">hace 3 d</div>
            <button class="join-btn">Unirse</button>
            <div class="community-meta">Similar a /TengoMiedoDePreguntar</div>
            <div class="community-description">
                Me la mande en el chat del trabajo y quiero morir. Tenemos un chat en donde estamos todos los del
                sector...
            </div>
            <div class="post-stats">
                <span>14 mil comentarios</span>
                <span>197 votos</span>
                <span>Compartir</span>
            </div>
        </div>

        <div class="community-card">
            <div class="community-header">
                <span>!</span>
                <span class="community-name">GT46</span>
            </div>
            <div class="community-meta">hace 3 d • Popular en PlotChat ahora mismo</div>
            <button class="join-btn">Unirse</button>
            <div class="community-description">
                The recent post from "Rockstar Employee"
            </div>
        </div>

        <div class="footer-links">
            <a href="#">Reglas de Plotchat</a>
            <a href="#">Política de privacidad</a>
            <a href="#">Acuerdo del usuario</a>
        </div>
        <div class="copyright">
            PlotChat, inc. © 2025. Todos los derechos reservados.
        </div>
    </aside>

    <!-- Menús móviles -->
    <div class="mobile-menu-toggle" id="mobileMenuToggle"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebarLeft = document.getElementById('sidebarLeft');

            if (mobileMenuToggle && sidebarLeft) {
                mobileMenuToggle.addEventListener('click', function () {
                    sidebarLeft.classList.toggle('active');
                });
            }

            // Cerrar menús al hacer clic fuera
            document.addEventListener('click', function (e) {
                if (window.innerWidth <= 992) {
                    if (!sidebarLeft.contains(e.target) && e.target !== mobileMenuToggle) {
                        sidebarLeft.classList.remove('active');
                    }
                }
            });

            // Smooth scroll para evitar saltos bruscos
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function (e) {
                    if (window.innerWidth <= 992) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            window.scrollTo({
                                top: target.offsetTop - 20,
                                behavior: 'smooth'
                            });
                        }
                        sidebarLeft.classList.remove('active');
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