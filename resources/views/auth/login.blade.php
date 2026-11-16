<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Oficina</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f3f6;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 35px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,.08);
        }

        h1 {
            color: #222;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitulo {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #ddd;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 7px;
            background: #b42318;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #8f1c13;
        }

        .erro {
            color: #b42318;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Oficina</h1>
        <p class="subtitulo">Sistema de Gestão</p>

        @if ($errors->any())
            <div class="erro">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label for="email">E-mail</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                placeholder="Digite seu e-mail"
                required
            >

            <label for="password">Senha</label>
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Digite sua senha"
                required
            >

            <button type="submit">Entrar</button>
        </form>

    </div>

</body>
</html>