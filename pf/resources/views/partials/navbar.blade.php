<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        :root {
            --primary-color: #ff6b35; /* Naranja más vibrante */
            --secondary-color: #4ecdc4; /* Turquesa moderno */
            --dark-color: #292f36;
            --light-color: #f7fff7;
            --hover-color: #f8f9fa;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            padding-top: 70px;
            background-color: var(--light-color);
        }
        
        .navbar {
            background-color: white;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            width: 100%;
            padding: 12px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            transition: var(--transition);
        }
        
        .navbar.scrolled {
            padding: 8px 5%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .navbar-brand::before {
            content: "✍️";
            font-size: 1.2rem;
        }
        
        .navbar-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .navbar-link {
            color: var(--dark-color);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .navbar-link:hover {
            background-color: var(--hover-color);
            transform: translateY(-2px);
        }
        
        .navbar-link.primary {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 2px 8px rgba(255, 107, 53, 0.3);
        }
        
        .navbar-link.primary:hover {
            background-color: #ff5a1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.4);
        }
        
        .navbar-link.secondary {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }
        
        .navbar-link.secondary:hover {
            background-color: rgba(78, 205, 196, 0.1);
            border-color: var(--secondary-color);
        }
        
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--dark-color);
            transition: var(--transition);
            padding: 8px;
            border-radius: 50%;
        }
        
        .menu-toggle:hover {
            background-color: var(--hover-color);
        }
        
        /* Mobile styles */
        @media (max-width: 768px) {
            .navbar {
                padding: 12px 5%;
            }
            
            .navbar-links {
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: white;
                flex-direction: column;
                align-items: center;
                padding: 20px 5%;
                box-shadow: var(--shadow);
                transform: translateY(-150%);
                opacity: 0;
                transition: transform 0.4s ease-out, opacity 0.3s ease;
                gap: 15px;
            }
            
            .navbar-links.active {
                transform: translateY(0);
                opacity: 1;
            }
            
            .navbar-link {
                width: 100%;
                text-align: center;
                padding: 12px;
            }
            
            .menu-toggle {
                display: block;
            }
            
            /* Animación de hamburguesa */
            .menu-toggle.active .bar:nth-child(1) {
                transform: translateY(6px) rotate(45deg);
            }
            
            .menu-toggle.active .bar:nth-child(2) {
                opacity: 0;
            }
            
            .menu-toggle.active .bar:nth-child(3) {
                transform: translateY(-6px) rotate(-45deg);
            }
        }
        
        /* Hamburguesa animada */
        .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            background-color: var(--dark-color);
            transition: var(--transition);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="navbar-brand">PlotChat</a>
        
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        
        <div class="navbar-links">
            <a href="/login" class="navbar-link secondary">Iniciar sesión</a>
            <a href="/signup" class="navbar-link primary">Registrarse</a>
        </div>
    </nav>

    <script>
        // Menú móvil
        const mobileMenu = document.getElementById('mobile-menu');
        const navbarLinks = document.querySelector('.navbar-links');
        
        mobileMenu.addEventListener('click', function() {
            this.classList.toggle('active');
            navbarLinks.classList.toggle('active');
        });
        
        // Cerrar menú al hacer clic en un enlace (mobile)
        document.querySelectorAll('.navbar-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                navbarLinks.classList.remove('active');
            });
        });
        
        // Efecto de scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scroll para todos los enlaces
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>