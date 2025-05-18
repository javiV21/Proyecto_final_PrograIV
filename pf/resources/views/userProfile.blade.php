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
            grid-template-columns:2fr 2fr;
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

        .share-btn {
            background: none;
            border: none;
            font-size: 0.9rem;
            color: var(--gray-medium);
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .share-btn:hover {
            background: var(--gray-light);
        }

        /* Comentarios */
        .comments-section {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .comments-section h2 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        /* Placeholder de comentarios */
        .comment-placeholder {
            text-align: center;
            color: var(--gray-m);
            padding: 2rem 0;
            font-size: 0.9rem;
        }

        .comment-list {
            list-style: none;
            padding: 0;
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .comment-list-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background: var(--gray-l);
            padding: 1rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            flex-wrap: wrap;
        }
        .comment-list-item > p {
        flex: 1 1 100%;
        margin-top: 0.5rem;
        }

        .comments-section form {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        /* Responsive Styles */	

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
                <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            </div>
            <div>
                <h1>{{ $user->name }}</h1>
                <p>/{{ $user->username }}</p>
            </div>
        </header>

        <div class="karma-stats">
            <div class="karma-card">
                <div class="karma-value">{{ $publicacionesCount }}</div>
                <div class="karma-label">Publicaciones</div>
            </div>
            <div class="karma-card">
                <div class="karma-value">{{ $comentariosCount }}</div>
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
        </div>

        <div class="tab-contents" id="tabsPublicaciones">
            @forelse($historias as $h)
                    <article class="story-card">
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
                                <button class="vote-btn">▲</button>
                                <span class="count">1.2k</span>
                                <button class="vote-btn">▼</button>
                            </div>
                            <div class="action-item">
                                <span class="comment-icon">💬</span>
                                <span class="count">{{ $comentariosCount }}</span>
                            </div>

                        </div>
                    </article>
            @empty
                <div class="main-content">
                    <h2>Tu primera publicación</h2>
                    <p>Comienza a compartir tus historias con la comunidad</p>
                    <button
                        style="background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 8px; margin-top: 1rem; cursor: pointer;"
                        id="createPost">
                        Crear Publicación
                    </button>
                </div>
            @endforelse
            <div class="achievements-section">
                <h3>Info</h3>
                <div class="achievement-item">
                    <span>🎉</span>
                    <div>
                        <h4>Te has unido a PlotChat</h4>
                        <p>Miembro desde {{ $user->created_at->format('d M Y') }}</p>
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
        <div class="tab-contents" id="tabsComentarios">
            @forelse($comentarios as $c)
                <li class="comment-list-item">
                    <div class="user-avatar">
                        {{ strtoupper(substr($c->user->username, 0, 1)) }}
                    </div>
                    <div class="meta-info">
                        <span class="author">{{ $c->user->username }}</span>
                        <span class="time">{{ $c->created_at->diffForHumans() }}</span>
                    </div>
                    <p>{{ $c->contenido }}</p>
                </li>
            @empty
                <div class="main-content">
                    <h2>No hay comentarios</h2>
                    <p>Tus opiniones hacen crecer a la comunidad. Participa dejando tus ideas en las publicaciones.</p>
                    <button
                        style="background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 8px; margin-top: 1rem; cursor: pointer;"
                        id="viewHomeComment">
                        Vea a Inicio
                    </button>
                </div>
            @endforelse

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
        const tabsPublicaciones = document.getElementById('tabsPublicaciones');
        const tabsComentarios = document.getElementById('tabsComentarios');
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-contents');

        const createPostButton = document.getElementById('createPost');
        createPostButton?.addEventListener('click', () => {
            window.location.href = '{{ route("createPost") }}';
        });

        const viewHomeCommentButton = document.getElementById('viewHomeComment');
        viewHomeCommentButton?.addEventListener('click', () => {
            window.location.href = '/home';
        });

        window.addEventListener('DOMContentLoaded', () => {
            // Ocultar todas las tabs primero
            tabContents.forEach(content => content.style.display = 'none');
            
            // Mostrar solo la primera tab
            tabsPublicaciones.style.display = 'grid';
            tabsPost.classList.add('active');
        });
        const setActiveTab = (activeTab) => {
            // Remover clases activas
            tabButtons.forEach(button => button.classList.remove('active'));
            tabContents.forEach(content => content.style.display = 'none');
            
            // Activar tab seleccionada
            activeTab.classList.add('active');
            const targetTabId = activeTab.id.replace('tab', 'tabs');
            document.getElementById(targetTabId).style.display = 'grid';
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