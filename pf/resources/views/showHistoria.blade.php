<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $historia->titulo }} – PlotChat</title>
    <style>
        :root {
            --primary: #ff6b35;
            --secondary: #4ecdc4;
            --dark: #292f36;
            --light: #f7fff7;
            --gray-l: #f8f9fa;
            --gray-m: #6c757d;
            --gray-d: #495057;
            --border: #e0e0e0;
            --radius: 8px;
            --shadow: 0 2px 10px rgba(0, 0, 0, .05);
            --transition: .3s ease;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        main {
            font-family: 'Inter', sans-serif;
            background: var(--gray-l);
            color: var(--dark);
            line-height: 1.6;
            padding: 1rem;
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .view-post-container {
            max-width: 820px;
            width: 100%;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .post-header {
            background: var(--primary);
            color: #fff;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .post-header .back-link {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: var(--radius);
            transition: background var(--transition), color var(--transition);
        }

        .post-header .back-link:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .story-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .user-avatar {
            background: var(--gray-l);
            color: var(--gray-d);
            font-weight: 600;
            border-radius: 50%;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .meta-info {
            display: flex;
            flex-direction: column;
            font-size: 0.9rem;
        }

        .meta-info .author {
            font-weight: 600;
            color: var(--dark);
        }

        .meta-info .time {
            color: var(--gray-m);
            font-size: 0.8rem;
        }

        .story-category {
            margin-left: auto;
            background: var(--secondary);
            color: #fff;
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .story-body {
            padding: 1.5rem;
        }

        .story-title {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .full-story {
            white-space: pre-wrap;
            font-size: 1rem;
            color: var(--gray-d);
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

        .comment-list-item>p {
            flex: 1 1 100%;
            margin-top: 0.5rem;
        }

        .comments-section form {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .create-comment-input {
            width: 100%;
            padding: 0.75rem;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 1rem;
            resize: vertical;
            min-height: 100px;
            background: #fff;
            color: var(--dark);
        }

        .create-comment-btn {
            align-self: flex-end;
            padding: 0.5rem 1.25rem;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background var(--transition);
        }

        .create-comment-btn:hover {
            background: #e55b27;
        }

        @media screen and (max-width: 768px) {
            .view-post-container {
                margin: 0 1rem;
            }

            .post-header h1 {
                font-size: 1.3rem;
            }

            .post-header .back-link {
                font-size: 0.8rem;
            }

            .story-title {
                font-size: 1.2rem;
            }

            .full-story {
                font-size: 0.95rem;
            }

            .comments-section h2 {
                font-size: 1.1rem;
            }

        }
    </style>
</head>

<body>
    <header>@include('partials.logNavbar')</header>
    <main>
        <div class="view-post-container">
            <header class="post-header">
                <h1>{{ $historia->titulo }}</h1>
                <a href="{{ route('home') }}" class="back-link">← Volver</a>
            </header>

            <div class="story-meta">
                <div class="user-avatar">
                    {{ strtoupper(substr($historia->user->name ?? $historia->user->username, 0, 1)) }}
                </div>
                <div class="meta-info">
                    <span class="author">{{ $historia->user->username }}</span>
                    <span class="time">{{ $historia->created_at->diffForHumans() }}</span>
                </div>
                <span class="story-category">{{ $historia->categoria->nombre }}</span>
            </div>

            <section class="story-body">
                <h2 class="story-title">{{ $historia->titulo }}</h2>
                <div class="full-story">{{ $historia->contenido }}</div>
                <div class="story-actions">
                    <div class="action-item">
                        <form method="POST" action="{{ route('reacc_historias.store') }}">
                            @csrf
                            <input type="hidden" name="historia_id" value="{{ $historia->id }}">
                            <input type="hidden" name="reaccion" value="1">
                            <button class="vote-btn" id="positive-vote">▲</button>
                        </form>
                        <span class="count">{{ $historia->reacciones_count }}</span>
                        <form method="POST" action="{{ route('reacc_historias.store') }}">
                            @csrf
                            <input type="hidden" name="historia_id" value="{{ $historia->id }}">
                            <input type="hidden" name="reaccion" value="-1">
                            <button class="vote-btn" id="negative-vote">▼</button>
                        </form>
                    </div>
                    <div class="action-item">
                        <span class="comment-icon">💬</span>
                        <span class="count">{{ $historia->comentarios_count }} comentarios</span>
                    </div>
                </div>
            </section>

            <section class="comments-section">
                <h2>Comentarios</h2>
                <form action="{{ route('comentarios.store', $historia) }}" method="POST">
                    @csrf
                    <textarea name="contenido" rows="4" placeholder="Escribe tu comentario..."
                        class="create-comment-input" required></textarea>
                    <button type="submit" class="create-comment-btn">Comentar</button>
                </form>
                @if($historia->comentarios->isEmpty())
                    <p class="comment-placeholder">Sé el primero en comentar esta historia.</p>
                @else
                    <ul class="comment-list">
                        @foreach($historia->comentarios as $comentario)
                            <li class="comment-list-item">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($comentario->user->username, 0, 1)) }}
                                </div>
                                <div class="meta-info">
                                    <span class="author">{{ $comentario->user->username }}</span>
                                    <span class="time">{{ $comentario->created_at->diffForHumans() }}</span>
                                </div>
                                <p>{{ $comentario->contenido }}</p>
                            </li>
                        @endforeach
                @endif
            </section>
        </div>
    </main>
    <footer>
        @include('partials.footer')
    </footer>
    <script>
        addEventListener('DOMContentLoaded', function()
    {
        const backLink = document.querySelector('.back-link');
        backLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.history.back();
        });
    })
    </script>
</body>

</html>