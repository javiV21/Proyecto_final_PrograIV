<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #4ecdc4;
            --dark-color: #292f36;
            --light-color: #f7fff7;
            --gray-dark: #495057;
            --gray-medium: #6c757d;
            --gray-light: #f8f9fa;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            padding: 2rem;
        }

        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 1.5rem 1.5rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .footer-logo::before {
            content: "✍️";
        }

        .footer-about p {
            color: var(--gray-medium);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .footer-heading {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-heading::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-color);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: var(--gray-medium);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--primary-color);
            padding-left: 5px;
        }

        .footer-links a::before {
            content: "›";
            color: var(--primary-color);
            font-weight: bold;
            opacity: 0;
            transition: var(--transition);
        }

        .footer-links a:hover::before {
            opacity: 1;
        }

        .footer-newsletter p {
            color: var(--gray-medium);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .newsletter-input {
            padding: 0.8rem 1rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
        }

        .newsletter-input:focus {
            outline: 2px solid var(--primary-color);
        }

        .newsletter-btn {
            padding: 0.8rem 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .newsletter-btn:hover {
            background-color: #ff5a1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 3rem auto 0;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .copyright {
            color: var(--gray-medium);
            font-size: 0.9rem;
        }

        .legal-links {
            display: flex;
            gap: 1.5rem;
        }

        .legal-links a {
            color: var(--gray-medium);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .legal-links a:hover {
            color: var(--primary-color);
        }

        .back-to-top {
            background-color: var(--primary-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            right: 20px;
            bottom: 20px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 1000;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        }

        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .footer-heading {
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .footer-heading::after {
                content: "+";
                position: static;
                background: none;
                width: auto;
                height: auto;
                font-size: 1.5rem;
                font-weight: normal;
            }

            .footer-heading.active::after {
                content: "-";
            }

            .footer-links {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .footer-heading.active + .footer-links {
                max-height: 500px;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .legal-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (min-width: 769px) {
            .footer-heading::after {
                display: none;
            }
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="footer-container">

            <div class="footer-links-container">
                <h3 class="footer-heading">Explorar</h3>
                <ul class="footer-links">
                    <li><a href="#">Historias populares</a></li>
                    <li><a href="#">Categorías</a></li>
                    <li><a href="#">Autores destacados</a></li>
                </ul>
            </div>

            <div class="footer-links-container">
                <h3 class="footer-heading">Comunidad</h3>
                <ul class="footer-links">
                    <li><a href="#">Foros</a></li>
                    <li><a href="#">Grupos</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

            <div class="footer-newsletter">
                <h3 class="footer-heading">Newsletter</h3>
                <p>Suscríbete para recibir las mejores historias y actualizaciones directamente en tu correo.</p>
                <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <input type="email" class="newsletter-input" placeholder="tu@email.com" name="email" required>
                    <button type="submit" class="newsletter-btn">Suscribirse</button>
                </form>
            </div>
            @if(session('success'))
                <p>{{ session('success') }}</p>
            @endif
        </div>

        <div class="footer-bottom">
            <p class="copyright">© 2025 PlotChat. Todos los derechos reservados.</p>
            <div class="legal-links">
                <a href="/policies">Términos de servicio</a>
                <a href="/policies">Política de privacidad</a>
            </div>
        </div>
    </footer>

    <div class="back-to-top" id="backToTop" aria-label="Volver arriba">↑</div>

    <script>
        // Botón "volver arriba"
        const backToTop = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Acordeón para móviles
        if (window.innerWidth <= 768) {
            const footerHeadings = document.querySelectorAll('.footer-heading');
            const footerLinks = document.querySelectorAll('.footer-links');
            footerLinks.forEach(link => {
                link.style.maxHeight = '0';
                link.style.overflow = 'hidden';
            });
            footerHeadings.forEach(heading => {
                heading.addEventListener('click', function() {
                    const links = this.nextElementSibling;
                    if (links.style.maxHeight) {
                        links.style.maxHeight = null;
                    } else {
                        links.style.maxHeight = links.scrollHeight + 'px';
                    }
                });
            });
        } else {
            const footerHeadings = document.querySelectorAll('.footer-heading');
            const footerLinks = document.querySelectorAll('.footer-links');
            footerLinks.forEach(link => {
                link.style.maxHeight = 'none';
                link.style.overflow = 'visible';
            });
            footerHeadings.forEach(heading => {
                heading.addEventListener('click', function() {
                    this.classList.toggle('active');
                });
            });
        }

        const newsletterForm = document.querySelector('.newsletter-form');

        // Efecto hover mejorado para enlaces
        document.querySelectorAll('.footer-links a').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    </script>
</body>
</html>