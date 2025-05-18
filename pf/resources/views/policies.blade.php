<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reglas y Privacidad – PlotChat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --primary-hover: #e55a28;
            --secondary: #4ecdc4;
            --dark: #2d2d2d;
            --light: #f8f9fa;
            --border: #e0e0e0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --radius: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font-main: 'Inter', system-ui, -apple-system, sans-serif;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-main);
        }

        body {
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        /* Navbar mejorada */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: var(--spacing-md) 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            z-index: 1000;
            transition: var(--transition);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .logo::before {
            content: '✍️';
            font-size: 1.2em;
        }

        .cta-buttons {
            display: flex;
            gap: var(--spacing-sm);
        }

        .btn {
            padding: var(--spacing-sm) var(--spacing-lg);
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* Hero section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, #ff8b60 100%);
            color: white;
            padding: 6rem var(--spacing-lg) 3rem;
            margin-top: 60px;
            text-align: center;
        }

        .container-hero {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: var(--spacing-md);
            line-height: 1.2;
        }

        .hero .subtitle {
            font-size: 1.125rem;
            opacity: 0.95;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: var(--spacing-xl) auto;
            gap: var(--spacing-xl);
            padding: 0 var(--spacing-lg);
        }

        main {
            flex: 0 0 70%;
            background: #fff;
            padding: var(--spacing-xl);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        aside {
            flex: 0 0 28%;
            background: #fff;
            padding: var(--spacing-lg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        /* pestañas aside */
        .tabs {
            display: flex;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
            border-bottom: 2px solid var(--border);
        }

        .tabs button {
            flex: 1;
            padding: var(--spacing-sm);
            background: var(--light);
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: color 0.3s ease;
            color: var(--dark);
            font-weight: 500;
        }

        .tabs button.active {
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        h2 {
            margin-bottom: var(--spacing-sm);
            color: var(--dark);
        }

        p,
        li {
            margin-bottom: var(--spacing-sm);
            color: #555;
            line-height: 1.6;
        }

        ul {
            list-style: disc inside;
            margin-left: var(--spacing-lg);
        }

        hr {
            border: 0;
            border-top: 1px solid var(--border);
            margin: var(--spacing-xl) 0;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: var(--spacing-xl) var(--spacing-lg);
            margin-top: var(--spacing-xl);
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: var(--spacing-md);
            flex-wrap: wrap;
            margin-top: var(--spacing-md);
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: var(--transition);
        }

        .footer-links a:hover {
            opacity: 1;
            color: var(--primary);
        }

        .footer-bottom {
            margin-top: var(--spacing-lg);
            font-size: 0.9rem;
            opacity: 0.7;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero {
                padding: 4rem var(--spacing-md) 2rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero .subtitle {
                font-size: 1rem;
            }

            .container {
                flex-direction: column;
                padding: 0 var(--spacing-md);
                gap: var(--spacing-md);
            }

            main,
            aside {
                padding: var(--spacing-lg);
                flex: 0 0 100%;
            }

            .tabs {
                gap: var(--spacing-sm);
            }

            .tabs button {
                font-size: 0.9rem;
                padding: var(--spacing-sm) 0.25rem;
                text-align: center;
            }

            .footer-links {
                gap: var(--spacing-sm);
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: var(--spacing-sm) var(--spacing-md);
            }

            .logo {
                font-size: 1.25rem;
            }

            .btn {
                padding: var(--spacing-sm) var(--spacing-md);
                font-size: 0.875rem;
            }

            .hero {
                padding: 3rem var(--spacing-sm) 1.5rem;
            }

            .hero h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="" class="logo">PlotChat</a>
            <div class="cta-buttons">
                <button id="btn-back" class="btn btn-primary">Volver</button>
            </div>
        </nav>
    </header>
    <section class="hero">
        <div class="container-hero">
            <h1>Reglas de PlotChat</h1>
            <p class="subtitle">Descubre las reglas y políticas de privacidad de la comunidad.</p>
        </div>
    </section>
    <div class="container">
        <aside>
            <div class="tabs">
                <button id="tab-reglas" class="active">Reglas</button>
                <button id="tab-privacidad">Privacidad</button>
            </div>
            <p>Selecciona una pestaña para ver las Reglas de uso o la Política de privacidad de PlotChat.</p>
        </aside>
        <main>
            <div id="content-reglas" class="tab-content active">
                <h2>Reglas de PlotChat</h2>
                <p>PlotChat es una vasta red de comunidades que crean, administran y frecuentan los usuarios de
                    PlotChat
                    como tú.</p>
                <p>
                    A través de estas comunidades, puedes publicar, comentar, votar, hablar, aprender, debatir, apoyar
                    y
                    conectar con personas que comparten tus intereses, y te animamos a encontrar, o incluso crear, tu
                    hogar en PlotChat.
                    <br><br>
                    Aunque no todas las comunidades encajen contigo (puede que no te identifiques con ellas o que las
                    encuentres ofensivas), ninguna debe utilizarse como arma. Las comunidades deben crear un
                    sentimiento
                    de pertenencia en sus miembros y no tratar de apagarlo en los demás. Del mismo modo, todos los que
                    pertenecemos a PlotChat debemos tener una expectativa de privacidad y seguridad, por lo que debemos
                    respetar la privacidad y seguridad de los demás.
                    <br><br>
                    Cada comunidad de PlotChat está definida por sus usuarios. Algunos de ellos ayudan a gestionar la
                    comunidad como moderadores. La cultura de cada comunidad está moldeada explícitamente por las
                    reglas
                    de la comunidad impuestas por los moderadores, e implícitamente por los votos positivos, negativos
                    y
                    las conversaciones de los miembros de su comunidad. Respeta las reglas de las comunidades en las
                    que
                    participas y no interfieras con aquellas de las que no formas parte.
                    <br><br>
                    Además de las reglas que rigen cada comunidad, se encuentran las reglas de toda la plataforma que
                    se
                    aplican a todos los que pertenecemos a PlotChat. Estas reglas las aplicamos nosotros, los
                    administradores.
                    <br><br>
                    PlotChat y sus comunidades son solo lo que hacemos de ellas juntos, y solo pueden existir si
                    operamos según un conjunto compartido de reglas. Te pedimos que cumplas no solo con la letra de
                    estas reglas, sino también con su espíritu.</p>
                <hr>
                <h3>Reglas</h3>
                <ul>
                    <li><strong>Regla 1:</strong> Recuerda al ser humano. PlotChat es un lugar para crear comunidad y
                        pertenencia, no para atacar a grupos de personas marginados o vulnerables. Todo el mundo tiene
                        derecho a usar PlotChat sin recibir acoso, bullying ni amenazas de violencia. Se banearán las
                        comunidades y usuarios que inciten a la violencia o que promuevan el odio por motivos de
                        identidad o vulnerabilidad.</li>
                    <li><strong>Regla 2:</strong> Cumple con las reglas de la comunidad. Publica contenido auténtico en
                        comunidades en las que tengas un interés personal y no hagas trampas ni participes en la
                        manipulación del contenido (incluido el spam, la manipulación de votos, la evasión de baneo o el
                        fraude de suscriptores) ni interfieras o alteres las comunidades de PlotChat.</li>
                    <li><strong>Regla 3:</strong> Respeta la privacidad de los demás. No se permite instigar el acoso,
                        por ejemplo, revelando información personal o confidencial de alguien. No publiques o amenaces
                        con publicar contenido multimedia íntimo o sexualmente explícito de alguien sin su
                        consentimiento.</li>
                    <li><strong>Regla 4:</strong> No compartas ni animes a compartir contenidos sexuales, ofensivos o
                        insinuantes que impliquen a menores. También está estrictamente prohibido cualquier
                        comportamiento depredador o inapropiado que implique a un menor.</li>
                    <li><strong>Regla 5:</strong> No tienes que usar tu verdadero nombre para utilizar PlotChat, pero no
                        te hagas pasar por una persona o una entidad de manera engañosa.</li>
                </ul>
            </div>

            <div id="content-privacidad" class="tab-content">
                <h2>Política de Privacidad de PlotChat</h2>
                <p>En PlotChat, creemos que la privacidad es un derecho. Queremos capacitar a nuestros usuarios para
                    que
                    sean los dueños de su identidad. En esta política de privacidad, queremos ayudarte a entender cómo
                    y
                    por qué PlotChat ("PlotChat", "nosotros" o "nos") recopila, utiliza y comparte información sobre
                    ti
                    cuando utilizas nuestros sitios web, aplicaciones móviles, widgets, API, correos electrónicos y
                    otros productos y servicios en línea (colectivamente, los "Servicios") o cuando interactúas de
                    cualquier otra forma con nosotros o recibes una comunicación nuestra.</p>
                <p>Queremos que esta política de privacidad te permita tomar mejores decisiones sobre cómo utilizas
                    PlotChat. Nos gustaría que leyeras toda la política, pero si no lo haces, aquí tienes el resumen:
                </p>
                <h3>Resumen</h3>
                <ul>
                    <li><strong>PlotChat es una plataforma pública.</strong> PlotChat es una plataforma pública.
                        Nuestras comunidades son en gran medida públicas y cualquiera puede ver tus publicaciones y tus
                        comentarios.</li>
                    <li><strong>Recopilamos un mínimo de información.</strong> Si solo quiere navegar, no tiene que
                        tener una cuenta. Si quiere crear una cuenta para participar en un subPlotChat, no es necesario
                        que nos dé su nombre real. No llevamos un seguimiento de su ubicación exacta. Incluso puede
                        navegar de forma privada. Puede compartir tanto o tan poco sobre sí mismo como quiera cuando
                        utilice PlotChat.</li>
                    <li><strong>Solo utilizamos los datos para hacer una comunidad mejor.</strong> Todos los datos que
                        recopilamos se utilizan principalmente para prestar nuestros Servicios, que se centran en
                        permitir que las personas se reúnan y formen comunidades. No vendemos tus datos personales a
                        terceros, y nunca trabajamos con intermediarios de datos.</li>
                </ul>
            </div>
        </main>
    </div>

    <footer>
        <div class="container footer-content">
            <p class="footer-bottom">&copy; 2023 PlotChat. Todos los derechos reservados.</p>
            <div class="footer-links">
                <a href="/policies">Términos de servicio</a>
                <a href="/policies">Política de privacidad</a>
            </div>
        </div>
    </footer>

    <script>
        const btnReglas = document.getElementById('tab-reglas');
        const btnPriv = document.getElementById('tab-privacidad');
        const contentReg = document.getElementById('content-reglas');
        const contentPriv = document.getElementById('content-privacidad');
        const btnBack = document.getElementById('btn-back');

        btnReglas.addEventListener('click', () => {
            btnReglas.classList.add('active');
            btnPriv.classList.remove('active');
            contentReg.classList.add('active');
            contentPriv.classList.remove('active');
        });
        btnPriv.addEventListener('click', () => {
            btnPriv.classList.add('active');
            btnReglas.classList.remove('active');
            contentPriv.classList.add('active');
            contentReg.classList.remove('active');
        });

        btnBack.addEventListener('click', () => {
            window.history.back();
        });
    </script>
</body>

</html>