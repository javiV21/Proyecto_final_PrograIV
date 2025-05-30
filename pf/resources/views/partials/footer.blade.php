<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer de PlotChat</title>
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
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2.5rem;
        }

        .footer-about {
            margin-right: 2rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .footer-logo::before {
            content: "✍️";
            font-size: 1.8rem;
        }

        .footer-about p {
            color: var(--gray-medium);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .footer-heading {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
            position: relative;
            padding-bottom: 0.5rem;
            transition: var(--transition);
        }

        .footer-heading::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
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
            font-size: 0.95rem;
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
            font-size: 0.95rem;
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .newsletter-input {
            padding: 0.8rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            font-size: 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transition: var(--transition);
        }

        .newsletter-input::placeholder {
            color: var(--gray-medium);
        }

        .newsletter-input:focus {
            outline: 2px solid var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.3);
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 3.5rem auto 0;
            padding-top: 1.8rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
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
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            right: 25px;
            bottom: 25px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 1000;
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.5);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .footer {
                padding: 2rem 1rem;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-links-section,
            .footer-newsletter-section { /* Aplicar estilos de sección para acordeón */
                margin-bottom: 1.5rem;
            }

            .footer-heading {
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .footer-heading::after {
                content: "+";
                position: static;
                background: none;
                width: auto;
                height: auto;
                font-size: 1.8rem;
                font-weight: normal;
                color: var(--primary-color);
                transition: transform 0.3s ease;
            }

            .footer-heading.active::after {
                content: "-";
                transform: rotate(180deg);
            }

            .footer-links,
            .footer-newsletter-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.4s ease-out, opacity 0.4s ease-out;
                opacity: 0;
                padding-top: 0;
            }

            .footer-links.active,
            .footer-newsletter-content.active {
                max-height: 500px;
                opacity: 1;
                padding-top: 1.5rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding-top: 1rem;
                margin-top: 2.5rem;
            }

            .legal-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.8rem;
            }

            .back-to-top {
                width: 40px;
                height: 40px;
                right: 15px;
                bottom: 15px;
                font-size: 1.3rem;
            }
        }

        /* Ocultar el icono de acordeón en desktop */
        @media (min-width: 769px) {
            .footer-heading::after {
                content: "";
                width: 40px;
            }
            .footer-links,
            .footer-newsletter-content {
                max-height: none !important;
                overflow: visible !important;
                opacity: 1 !important;
                padding-top: 0 !important;
            }
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="footer-container">

            <div class="footer-about">
                <a href="/" class="footer-logo">PlotChat</a>
                <p>Explora un universo de historias únicas. Lee, escribe y comparte tus pasiones con una comunidad que valora la narrativa.</p>
            </div>

            <div class="footer-links-section">
                <h3 class="footer-heading" data-target="#exploreLinks">Explorar</h3>
                <ul class="footer-links" id="exploreLinks">
                    <li><a href="{{ route('home') }}">Historias populares</a></li>
                    <li><a href="{{ route('categorias.index') }}">Categorías</a></li>
                    <li><a href="{{ route('createPost') }}">Crea Nuevas historias</a></li>
                    <li><a href=>          </a></li>
                </ul>
            </div>

            <div class="footer-newsletter-section">
                <h3 class="footer-heading" data-target="#newsletterContent">Newsletter</h3>
                <div class="footer-newsletter-content" id="newsletterContent">
                    <p>Suscríbete para recibir las mejores historias y actualizaciones directamente en tu correo.</p>
                    <br>
                    <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input type="email" class="newsletter-input" placeholder="tu@email.com" name="email" required>
                        <button type="submit" class="newsletter-btn">Suscribirse</button>
                    </form>
                    @if(session('success'))
                        <p style="color: var(--secondary-color); font-size: 0.9em; margin-top: 10px;">{{ session('success') }}</p>
                    @endif
                    @if(session('error'))
                        <p style="color: #dc3545; font-size: 0.9em; margin-top: 10px;">{{ session('error') }}</p>
                    @endif
                    <li><a href=>          </a></li>
                </div>
            </div>

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
        document.addEventListener('DOMContentLoaded', () => {
            // Botón "volver arriba"
            const backToTopButton = document.getElementById('backToTop');

            const toggleBackToTopButton = () => {
                if (window.scrollY > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
            };

            window.addEventListener('scroll', toggleBackToTopButton);
            toggleBackToTopButton();

            backToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Acordeón para móviles (y tabletas pequeñas)
            const setupAccordion = () => {
                const footerHeadings = document.querySelectorAll('.footer-heading');

                footerHeadings.forEach(heading => {
                    heading.removeEventListener('click', toggleAccordion); // Evita duplicados
                    heading.addEventListener('click', toggleAccordion);

                    const targetId = heading.dataset.target;
                    const targetElement = document.querySelector(targetId);

                    // Inicializar el estado al cargar o redimensionar
                    if (window.innerWidth <= 768) {
                        targetElement.style.maxHeight = '0';
                        targetElement.style.opacity = '0';
                        targetElement.style.paddingTop = '0';
                        heading.classList.remove('active');
                    } else {
                        targetElement.style.maxHeight = 'none';
                        targetElement.style.opacity = '1';
                        targetElement.style.paddingTop = '0';
                        heading.classList.remove('active');
                    }
                });
            };

            const toggleAccordion = function() {
                if (window.innerWidth <= 768) {
                    const targetId = this.dataset.target;
                    const targetElement = document.querySelector(targetId);

                    this.classList.toggle('active');

                    if (targetElement.style.maxHeight && targetElement.style.maxHeight !== '0px') {
                        targetElement.style.maxHeight = '0';
                        targetElement.style.opacity = '0';
                        targetElement.style.paddingTop = '0';
                    } else {
                        targetElement.style.maxHeight = targetElement.scrollHeight + 'px';
                        targetElement.style.opacity = '1';
                        targetElement.style.paddingTop = '1.5rem';
                    }
                }
            };

            setupAccordion();

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    setupAccordion();
                }, 250);
            });
        });
    </script>
</body>
</html>