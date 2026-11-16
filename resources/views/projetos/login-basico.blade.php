<?php

$usuarioCorreto = "admin";
$senhaCorreta = "1234";

$mensagem = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $senha = $_POST["senha"] ?? "";

    if ($usuario === $usuarioCorreto && $senha === $senhaCorreta) {
        $mensagem = "Login realizado com sucesso!";
        $status = "sucesso";
    } else {
        $mensagem = "Usuário ou senha incorretos.";
        $status = "erro";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login de Usuário</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a, #312e81, #6d28d9);
        }

        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 35px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 50px #00000040;
        }

        .icone {
            width: 65px;
            height: 65px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            font-size: 30px;
            background: #ede9fe;
        }

        h1 {
            margin-bottom: 8px;
            text-align: center;
            color: #1e1b4b;
            font-size: 28px;
        }

        .descricao {
            margin-bottom: 28px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #f8fafc;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #7c3aed;
            background: #ffffff;
            box-shadow: 0 0 0 3px #7c3aed20;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: #ffffff;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px #4f46e540;
        }

        .mensagem {
            margin-top: 20px;
            padding: 12px;
            border-radius: 9px;
            text-align: center;
            font-size: 13px;
        }

        .sucesso {
            color: #166534;
            background: #dcfce7;
        }

        .erro {
            color: #991b1b;
            background: #fee2e2;
        }

        .rodape {
            margin-top: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 420px) {
            .login-container {
                padding: 27px 22px;
            }
        }
    </style>
</head>

<body>

    <main class="login-container">

        <div class="icone">🔐</div>

        <h1 id="titulo">Bem-vindo!</h1>

        <p class="descricao">
            Entre com seus dados para continuar.
        </p>

        <form method="POST" action="">

            <div class="campo">
                <label for="usuario">Usuário</label>
                <input
                    type="text"
                    id="usuario"
                    name="usuario"
                    placeholder="Digite seu usuário"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="campo">
                <label for="senha">Senha</label>
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit">Entrar →</button>

        </form>

        <?php if ($mensagem != ""): ?>
            <p class="mensagem <?= $status ?>">
                <?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>

        <div class="rodape">
            Sistema de Login · PHP
        </div>

    </main>

</body>
</html>