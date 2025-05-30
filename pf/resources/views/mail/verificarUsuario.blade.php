<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    h2 {
        text-align: center;
    }
    h1 {
        text-align: center;
        letter-spacing: 4px;
    }
    p {
        text-align: center;
    }
</style>
</head>
<body>
    <h2>Hola, {{ $user->name }}!</h2>
    <p>Tu código de verificación es:</p>
    <h1 style="letter-spacing:4px">{{ $token }}</h1>
    <p>Ingresa este código en la pantalla de verificación de nuestra aplicación. Tiene validez de 24 horas.</p>
    <p>Si no solicitaste este código, ignora este correo.</p>
</body>
</html>
