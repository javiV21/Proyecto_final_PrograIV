<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu cuenta</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-bg: #f8f9fa;
            --dark-text: #343a40;
            --border-color: #ced4da;
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.15);
            --error-color: #EF4444;
            /* Tailwind red-500 */
            --success-color: #22C55E;
            /* Tailwind green-500 */
            --border-radius: 8px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            box-sizing: border-box;
            padding: 20px;
            /* Add some padding for smaller screens */
        }

        .verify-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px var(--shadow-light);
            width: 100%;
            max-width: 400px;
            /* Max width for larger screens */
            text-align: center;
            /* Center content */
            box-sizing: border-box;
        }

        h1 {
            font-size: 2em;
            color: var(--primary-color);
            margin-bottom: 25px;
            font-weight: 700;
        }

        p.alert {
            background-color: #e2f0e6;
            color: var(--success-color);
            border: 1px solid var(--success-color);
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.95em;
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
            background-color: rgba(34, 197, 94, 0.1);
            /* Light green background */
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1) border: 1px solid var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85em;
            margin-top: -10px;
            margin-bottom: 6px;
            display: block;
        }

        p.text-danger {
            color: var(--danger-color);
            font-size: 0.85em;
            margin-top: -10px;
            /* Adjust spacing for error messages */
            margin-bottom: 15px;
            text-align: left;
            /* Align error text to the left */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: var(--dark-text);
            text-align: left;
            /* Align label to the left */
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid var(--border-color);
            font-size: 1.1em;
            text-align: center;
            /* Center the input text */
            letter-spacing: 3px;
            /* Add some spacing for the code */
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: var(--success-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 700;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #218838;
            /* Darker shade of success */
            box-shadow: 0 4px 10px var(--shadow-medium);
        }

        button.mt-3 {
            margin-top: 15px;
            /* Spacing for resend button */
            background-color: var(--primary-color);
        }

        button.mt-3:hover {
            background-color: #0056b3;
            /* Darker shade of primary */
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .verify-container {
                padding: 25px 20px;
                border-radius: 8px;
            }

            h1 {
                font-size: 1.8em;
                margin-bottom: 20px;
            }

            input[type="text"] {
                padding: 10px;
                font-size: 1em;
            }

            button {
                padding: 10px;
                font-size: 1em;
            }
        }
    </style>
</head>

<body>
    <div class="verify-container">
        <h1>Verifica tu cuenta</h1>

        @if(session('status'))
            <p class="alert alert-success">{{ session('status') }}</p>
        @endif
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

        <form method="POST" action="{{ route('verify.submit') }}">
            @csrf

            <label for="token">Código de 6 dígitos</label>
            <input id="token" name="token" type="text" maxlength="6" value="{{ old('token') }}" required autofocus>
            @error('token')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <button type="submit">Verificar</button>
        </form>

        <form method="POST" action="{{ route('verify.resend') }}">
            @csrf
            <button type="submit" class="mt-3">Reenviar código</button>
        </form>
    </div>
</body>

</html>