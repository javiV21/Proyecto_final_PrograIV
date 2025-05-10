<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - PlotChat</title>
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #4ecdc4;
            --dark-color: #292f36;
            --light-color: #f7fff7;
            --bg-color: #ffffff;
            --text-primary: #2d2d2d;
            --text-secondary: #6c757d;
            --border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-primary);
        }

        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--light-color);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .avatar-section {
            position: relative;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .karma-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .karma-card {
            text-align: center;
            padding: 1.5rem;
            background: var(--light-color);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .karma-value {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .tabs {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
            border-bottom: 2px solid var(--border-color);
        }

        .tab-button {
            padding: 1rem 2rem;
            border: none;
            background: none;
            cursor: pointer;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .tab-button.active {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
        }

        .tab-contents {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .main-content {
            background: var(--light-color);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }


        .achievements-section {
            background: var(--light-color);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .achievement-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            margin: 1rem 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .karma-stats {
                grid-template-columns: 1fr;
            }

            .tab-contents {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.logNavbar')</header>
    <div class="profile-container">
        <header class="profile-header">
            <div class="avatar-section">
                <div class="profile-avatar">U</div>
            </div>
            <div>
                <h1>{{ $user->name }}</h1>
                <p>/{{ $user->username }}</p>
            </div>
        </header>

        <div class="karma-stats">
            <div class="karma-card">
                <div class="karma-value">0</div>
                <div class="karma-label">Publicaciones</div>
            </div>
            <div class="karma-card">
                <div class="karma-value">0</div>
                <div class="karma-label">Comentarios</div>
            </div>
            <div class="karma-card">
                <div class="karma-value"> {{ $user->created_at->format('d M Y') }}</div>
                <div class="karma-label">Te uniste a PlotChat</div>
            </div>
        </div>

        <div class="tabs">
            <button class="tab-button" id="tabPublicaciones">Publicaciones</button>
            <button class="tab-button" id="tabComentarios">Comentarios</button>
            <button class="tab-button" id="tabGuardados">Guardados</button>
        </div>

        <div class="tab-contents" id="tabsPublicaciones">
            <div class="main-content">
                <h2>Tu primera publicación</h2>
                <p>Comienza a compartir tus historias con la comunidad</p>
                <button
                    style="background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 8px; margin-top: 1rem; cursor: pointer;" id="createPost">
                    Crear Publicación
                </button>
            </div>

            <div class="achievements-section">
                <h3>Info</h3>
                <div class="achievement-item">
                    <span>🎉</span>
                    <div>
                        <h4>Te has unido a PlotChat</h4>
                        <p>Miembro desde  {{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="achievement-item">
                    <span>🔒</span>
                    <div>
                        <h4>Cuenta protegida</h4>
                        <p>Verificación en dos pasos activada</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-contents" id="tabsGuardados">
            <div class="main-content">
                <h2>Guardados</h2>
                <p>Tus favoritos, siempre a mano</p>
                <button
                    style="background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 8px; margin-top: 1rem; cursor: pointer;" id="viewHomeSaved">
                    Vea a Inicio
                </button>
            </div>

            <div class="achievements-section">
                <h3>Info</h3>
                <div class="achievement-item">
                    <span>🎉</span>
                    <div>
                        <h4>Guarda publicaciones</h4>
                        <p>Guarda tu contenido favorito</p>
                    </div>
                </div>
                <div class="achievement-item">
                    <span>🗣️</span>
                    <div>
                        <h4>Temas que te interesen</h4>
                        <p>Dale me gusta a las publicaciones</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-contents" id="tabsComentarios">
            <div class="main-content">
                <h2>No hay comentarios</h2>
                <p>Tus opiniones hacen crecer a la comunidad. Participa dejando tus ideas en las publicaciones.</p>
                <button
                    style="background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 8px; margin-top: 1rem; cursor: pointer;" id="viewHomeComment">
                    Vea a Inicio
                </button>
            </div>

            <div class="achievements-section">
                <h3>Info</h3>
                <div class="achievement-item">
                    <span>🎉</span>
                    <div>
                        <h4>Comenta las publicaciones</h4>
                        <p>Comienza a interactuar con la comunidad</p>
                    </div>
                </div>
                <div class="achievement-item">
                    <span>🔒</span>
                    <div>
                        <h4>Respeta la integridad</h4>
                        <p>Respeta las reglas de la comunidad</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        @include('partials.footer')
    </footer>
    <script>
        const tabsPost = document.getElementById('tabPublicaciones');
        const tabsComment = document.getElementById('tabComentarios');
        const tabsSaved = document.getElementById('tabGuardados');
        const tabsPublicaciones = document.getElementById('tabsPublicaciones');
        const tabsComentarios = document.getElementById('tabsComentarios');
        const tabsGuardados = document.getElementById('tabsGuardados');
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-contents');

        const createPostButton = document.getElementById('createPost');
        createPostButton.addEventListener('click', () => {
            window.location.href = '/createPost';
        });

        const viewHomeSavedButton = document.getElementById('viewHomeSaved');
        viewHomeSavedButton.addEventListener('click', () => {
            window.location.href = '/home';
        });
        const viewHomeCommentButton = document.getElementById('viewHomeComment');
        viewHomeCommentButton.addEventListener('click', () => {
            window.location.href = '/home';
        });

        const setActiveTab = (activeTab) => {
            tabButtons.forEach((button) => {
                button.classList.remove('active');
            });
            tabContents.forEach((content) => {
                content.style.display = 'none';
            });
            activeTab.classList.add('active');
            document.getElementById(`tabs${activeTab.id.replace('tab', '')}`).style.display = 'grid';
        };

        // Agregar los event listeners
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                setActiveTab(button);
            });
        });

        // Mostrar solo la primera pestaña al cargar
        window.addEventListener('DOMContentLoaded', () => {
            setActiveTab(tabsPost);
        });
    </script>

</body>

</html>