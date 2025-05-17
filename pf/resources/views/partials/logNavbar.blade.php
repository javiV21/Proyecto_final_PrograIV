<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlotChat - Inicio</title>
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
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            padding-top: 60px;
        }

        /* Navbar */
        .navbar {
            background-color: white;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            z-index: 1000;
        }

        .navbar-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo::before {
            content: "✍️";
        }

        .search-bar {
            flex: 1;
            max-width: 600px;
            margin: 0 1.5rem;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            background-color: var(--gray-light);
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.2);
            background-color: white;
        }

        .search-bar::before {
            content: "🔍";
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.5;
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-button {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .nav-button:hover {
            background-color: var(--gray-light);
        }

        .nav-button.active {
            color: var(--primary-color);
        }

        .nav-button.create {
            background-color: var(--primary-color);
            color: white;
            width: auto;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .nav-button.create:hover {
            background-color: #ff5a1f;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            cursor: pointer;
            position: relative;
        }

        .user-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: var(--shadow);
            width: 220px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 1001;
        }

        .user-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-menu-item {
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            color: var(--dark-color);
            transition: var(--transition);
        }

        .user-menu-btn {
            padding: 0.8rem 1rem;
            background-color: transparent;
            border: none;
            color: var(--dark-color);
            cursor: pointer;
            width: 100%;
            text-align: left;
            font-size: 1rem;
        }

        .user-menu-item:hover {
            background-color: var(--gray-light);
        }

        .user-menu-divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 0.3rem 0;
        }

        /* Mobile menu */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 0 1rem;
            }
            
            .search-bar {
                display: none;
            }
            
            .nav-buttons {
                gap: 0.5rem;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .mobile-search-toggle {
                display: block;
            }
            
            .mobile-search {
                position: fixed;
                top: 60px;
                left: 0;
                width: 100%;
                padding: 1rem;
                background-color: white;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                display: none;
                z-index: 999;
            }
            
            .mobile-search.active {
                display: block;
            }
            
            .mobile-search input {
                width: 100%;
                padding: 0.8rem 1rem 0.8rem 2.5rem;
                border-radius: 4px;
                border: 1px solid var(--border-color);
            }
            
            .mobile-search::before {
                content: "🔍";
                position: absolute;
                left: 1.8rem;
                top: 50%;
                transform: translateY(-50%);
                opacity: 0.5;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/home" class="logo">PlotChat</a>
                        
            <div class="search-bar">
                <input type="text" placeholder="Buscar en PlotChat">
            </div>
            
            <div class="nav-buttons">
                <button class="nav-button active" title="Inicio" id="btnHome">🏠</button>
                <button class="nav-button create" title="Crear" id="btnCrear">+ Crear</button>
                <div class="user-dropdown">
                    @auth
                    <div class="user-avatar" id="userAvatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
</div>
                    @endauth
                    <div class="user-menu" id="userMenu">
                        <a href="/userProfile" class="user-menu-item">👤 Mi perfil</a>
                        <a href="/userProfile" class="user-menu-item">📝 Mis historias</a>
                        <div class="user-menu-divider"></div>
                        <a href="#" class="user-menu-item">⚙️ Configuración</a>
                        <a href="#" class="user-menu-item">❓ Ayuda</a>
                        <div class="user-menu-divider"></div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="user-menu-btn">🚪 Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const btnHome = document.getElementById('btnHome');
        const btnCrear = document.getElementById('btnCrear');

        btnHome.addEventListener('click', function() {
            window.location.href = '{{ route("home") }}';
        });
        btnCrear.addEventListener('click', function() {
            window.location.href = '{{ route("createPost") }}';
        });

        // Menú desplegable del usuario
        const userAvatar = document.getElementById('userAvatar');
        const userMenu = document.getElementById('userMenu');
        
        userAvatar.addEventListener('click', function(e) {
            e.stopPropagation();
            userMenu.classList.toggle('active');
        });
        
        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function() {
            userMenu.classList.remove('active');
        });
        
        // Evitar que se cierre al hacer clic dentro del menú
        userMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        

    
    </script>
</body>
</html>