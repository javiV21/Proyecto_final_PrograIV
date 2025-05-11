<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlotChat - Crear Publicación</title>
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #4ecdc4;
            --dark-color: #292f36;
            --light-color: #f7fff7;
            --border-color: #e0e0e0;
            --bg-color: #ffffff;
            --text-secondary: #6c757d;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s ease;
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .create-post-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: var(--bg-color);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            padding: 2rem;
            flex-grow: 1;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
        }

        .main-editor {
            border-right: 1px solid var(--border-color);
            padding-right: 2rem;
        }

        .post-type-selector {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .post-type-btn {
            padding: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .post-type-btn:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .post-type-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .community-selector {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 2rem;
            appearance: none;
            background: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") no-repeat right 1rem center;
            background-size: 1em;
        }

        .title-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .title-input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .char-counter {
            color: var(--text-secondary);
            font-size: 0.9em;
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .editor-toolbar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .toolbar-btn {
            padding: 0.5rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            background: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.3rem;
            position: relative;
        }

        .toolbar-btn:hover {
            background: var(--light-color);
            border-color: var(--primary-color);
        }

        .toolbar-btn::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark-color);
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.8rem;
            opacity: 0;
            pointer-events: none;
            transition: var(--transition);
            white-space: nowrap;
        }

        .toolbar-btn:hover::after {
            opacity: 1;
            margin-bottom: 5px;
        }

        .post-editor {
            width: 100%;
            min-height: 400px;
            padding: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            resize: vertical;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            transition: var(--transition);
        }

        .post-editor:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-draft,
        .btn-publish {
            padding: 0.8rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-draft {
            background: none;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
        }

        .btn-draft:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-publish {
            background: var(--primary-color);
            border: none;
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-publish:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-publish:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .preview-sidebar {
            padding: 1rem;
        }

        .preview-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .preview-content {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            min-height: 200px;
        }

        @media (max-width: 1200px) {
            .create-post-container {
                grid-template-columns: 1fr;
                margin: 1rem;
            }

            .main-editor {
                border-right: none;
                padding-right: 0;
            }

            .preview-sidebar {
                border-top: 1px solid var(--border-color);
                padding-top: 2rem;
            }
        }

        @media (max-width: 768px) {
            .create-post-container {
                padding: 1rem;
                margin: 0.5rem;
            }

            .post-type-selector {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-draft,
            .btn-publish {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <header>
        @include('partials.logNavbar')
    </header>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('historias.store') }}"" id="createPostForm">
        @csrf
        <div class="create-post-container">
            <div class="main-editor">
                <h1>Crear Nueva Publicación</h1>

                <div class="post-type-selector">
                    <button class="post-type-btn active">
                        <span>📝</span>
                        Texto
                    </button>
                </div>

                <select class="community-selector" name="categoria_id" id="categoria_id" required>
                    <option value="">Seleccionar Categoría</option>
                    @foreach($categorias as $cat)
                        <option
                        value="{{ $cat->id }}"
                        {{ old('categoria_id') == $cat->id ? 'selected' : '' }}
                        >
                        {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="titulo" class="title-input" placeholder="Escribe un título*" maxlength="300" value="{{ old('titulo') }}">
                <div class="char-counter"><span id="charCount">0</span>/100</div>

                <div class="editor-toolbar">
                    <button class="toolbar-btn" data-style="bold" data-tooltip="Negrita (Ctrl+B)">
                        <strong>B</strong>
                    </button>
                    <button class="toolbar-btn" data-style="italic" data-tooltip="Cursiva (Ctrl+I)">
                        <em>I</em>
                    </button>
                    <button class="toolbar-btn" data-style="strikethrough" data-tooltip="Tachado">
                        <s>S</s>
                    </button>
                    <button class="toolbar-btn" data-style="link" data-tooltip="Insertar enlace">
                        🔗
                    </button>
                    <button class="toolbar-btn" data-style="code" data-tooltip="Código">
                        {"<>"}
                    </button>
                    <button class="toolbar-btn" data-style="spoiler" data-tooltip="Spoiler">
                        ⚠️
                    </button>
                </div>

                <textarea class="post-editor" name="contenido" placeholder="Cuenta tu historia...">{{ old('contenido') }}</textarea>

                <div class="action-buttons">
                    <button class="btn-draft">
                        <span>💾</span>
                        Guardar borrador
                    </button>
                    <button class="btn-publish" id="publishBtn">
                        <span>🚀</span>
                        Publicar
                    </button>
                </div>
            </div>

            <div class="preview-sidebar">
                <h3 class="preview-title">Vista Previa</h3>
                <div class="preview-content" id="previewContent">
                </div>
            </div>
        </div>
    </form>

    <footer>
        @include('partials.footer')
    </footer>

    <script>
        // Contador de caracteres
        const titleInput = document.querySelector('.title-input');
        const charCount = document.getElementById('charCount');

        titleInput.addEventListener('input', () => {
            charCount.textContent = titleInput.value.length;
        });

        // Formateo de texto
        const toolbarButtons = document.querySelectorAll('.toolbar-btn');
        const postEditor = document.querySelector('.post-editor');
        const previewContent = document.getElementById('previewContent');

        const markdownToHTML = (text) => {
            return text
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/~~(.*?)~~/g, '<s>$1</s>')
                .replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2" target="_blank">$1</a>')
                .replace(/`(.*?)`/g, '<code>$1</code>')
                .replace(/>(.*?)</g, '<span class="spoiler">$1</span>');
        };

        postEditor.addEventListener('input', () => {
            previewContent.innerHTML = markdownToHTML(postEditor.value);
        });

        toolbarButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const style = button.dataset.style;
                const start = postEditor.selectionStart;
                const end = postEditor.selectionEnd;
                const selectedText = postEditor.value.slice(start, end);

                const formats = {
                    bold: ['**', '**'],
                    italic: ['*', '*'],
                    strikethrough: ['~~', '~~'],
                    link: ['[', '](url)'],
                    code: ['`', '`'],
                    spoiler: ['>!', '!<']
                };

                if (formats[style]) {
                    const [open, close] = formats[style];
                    const newText = open + selectedText + close;
                    postEditor.value = postEditor.value.slice(0, start) + newText + postEditor.value.slice(end);
                    postEditor.focus();
                    postEditor.selectionStart = start + open.length;
                    postEditor.selectionEnd = start + open.length + selectedText.length;
                }
            });
        });

        // Validación de publicación
        titleInput.addEventListener('input', () => {
            const publishBtn = document.querySelector('.btn-publish');
            publishBtn.disabled = titleInput.value.trim().length < 10;
        });

        // Atajos de teclado
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key === 'b') {
                e.preventDefault();
                document.querySelector('[data-style="bold"]').click();
            }
            if (e.ctrlKey && e.key === 'i') {
                e.preventDefault();
                document.querySelector('[data-style="italic"]').click();
            }
        });
    </script>
</body>

</html>