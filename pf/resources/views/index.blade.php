<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Únete a nuestra comunidad</title>
    <style>
        :root {
            --error-color: #EF4444; /* Tailwind red-500 */
            --success-color: #22C55E; /* Tailwind green-500 */
            --border-radius: 8px; /* General border radius */
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .hero {
            background: linear-gradient(135deg, #ff4500 0%, #ff8b60 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 800;
        }
        
        p.subtitle {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
            opacity: 0.9;
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: white;
            color: #ff4500;
            box-shadow: 0 4px 15px rgba(255, 69, 0, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 69, 0, 0.4);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-secondary:hover {
            background-color: rgba(255,255,255,0.1);
            transform: translateY(-3px);
        }
        
        .features {
            padding: 60px 0;
            text-align: center;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ff4500;
        }
        
        .feature-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feature-desc {
            color: #666;
        }
        .feedback-message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95em;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1); /* Light green background */
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1)
            border: 1px solid var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85em;
            margin-top: -10px;
            margin-bottom: 6px;
            display: block;
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            p.subtitle {
                font-size: 1rem;
            }
            
            .hero {
                padding: 60px 20px;
            }
            
            .btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        @include('partials.navbar')
    </header>
            @if(session('status'))
                <p class="feedback-message success">
                    {{ session('status') }}
                </p>
            @endif
            @if(session('error'))
                <p class="feedback-message error">
                    {{ session('error') }}
                </p>
            @endif
    <section class="hero">
        <div class="container">
            <h1>Únete a nuestra comunidad</h1>
            <p class="subtitle">Descubre un espacio donde puedes compartir tus intereses, conectar con personas afines y encontrar contenido relevante.</p>
            <div class="cta-buttons">
                <a href="/signup" class="btn btn-primary">Regístrate ahora</a>
                <a href="/login" class="btn btn-secondary">Iniciar sesión</a>
            </div>
        </div>
    </section>
    
    <section class="features">
        <div class="container">
            <h2>¿Por qué unirte?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3 class="feature-title">Comunidad activa</h3>
                    <p class="feature-desc">Conéctate con miles de usuarios que comparten tus intereses y pasiones.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3 class="feature-title">Discusiones interesantes</h3>
                    <p class="feature-desc">Participa en conversaciones sobre los temas que más te interesan.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title">Privacidad protegida</h3>
                    <p class="feature-desc">Tu seguridad es nuestra prioridad, con controles avanzados de privacidad.</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('partials.footer')
    </footer>
</body>
</html>