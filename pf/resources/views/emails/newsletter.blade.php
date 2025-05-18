@component('mail::message')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a PlotChat Newsletters</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #f7fff7;
            color: #292f36;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border-collapse: collapse;
        }
        .header {
            background-color: #292f36;
            padding: 2rem;
            color: #fff;
            text-align: left;
        }
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        .content {
            padding: 2rem;
            background-color: #fff;
            color: #292f36;
            line-height: 1.6;
        }
        .footer {
            background-color: #292f36;
            padding: 1rem;
            text-align: center;
            color: #6c757d;
            font-size: 0.8rem;
        }
        .button {
            display: inline-block;
            background-color: #ff6b35;
            color: #fff;
            padding: 0.8rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 1rem;
        }
        .button:hover {
            background-color: #e55d28;
        }
    </style>
</head>
<body>
    <table class="container">
        <tr>
            <td class="header">
                <h1>¡Bienvenido a PlotChat Newsletters!</h1>
            </td>
        </tr>
        <tr>
            <td class="content">
                <p>Hola,</p>
                <p>Gracias por suscribirte a las newsletters de PlotChat. Estamos emocionados de tenerte a bordo.</p>
                <p>A partir de ahora, recibirás directamente en tu correo electrónico:</p>
                <ul>
                    <li>Las últimas noticias y actualizaciones de PlotChat.</li>
                    <li>Información sobre nuevas funciones y mejoras.</li>
                    <li>Consejos y trucos para aprovechar al máximo nuestra plataforma.</li>
                    <li>Anuncios importantes de la comunidad.</li>
                </ul>
                <p>Mantente atento a tu bandeja de entrada para no perderte ninguna novedad.</p>
                <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en visitar nuestra <a href="#" style="color:#ff6b35; text-decoration: none;">sección de ayuda</a>.</p>
                <p>¡Gracias por ser parte de la comunidad PlotChat!</p>
                <br>
                <p>Saludos cordiales,</p>
                <p>El equipo de PlotChat</p>

                {{-- Aquí podrías incluir más contenido específico de la newsletter --}}
            </td>
        </tr>
        <tr>
            <td class="footer">
                © 2025 PlotChat. Todos los derechos reservados.
            </td>
        </tr>
    </table>
</body>
</html>
@endcomponent