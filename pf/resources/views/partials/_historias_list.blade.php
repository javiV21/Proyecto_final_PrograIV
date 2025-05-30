@if($historias->isEmpty())
    <p class="no-stories-message">No hay historias en esta categoría aún.</p>
@else
    @foreach($historias as $historia)
        <div class="story-card">
            <div>
                <div class="story-header">
                    <div class="author-info">
                        <div class="user-avatar">
                            {{ strtoupper(substr($historia->user->name, 0, 2)) }}
                        </div>
                        <div class="meta-container">
                            <p class="story-author">{{ $historia->user->name }}</p>
                            <p class="story-time">{{ $historia->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="story-category-tag">{{ $historia->categoria->nombre }}</div>
                </div>
                <h3 class="story-title">{{ $historia->titulo }}</h3>
                <p class="story-content">{{ Str::limit($historia->contenido, 150) }}</p>
            </div>
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
                <a href="{{ route('historias.show', $historia->id) }}" class="action-item" style="margin-left: auto; text-decoration: none; color: orange;">
                    Ver más
                </a>
            </div>
        </div>
    @endforeach
@endif