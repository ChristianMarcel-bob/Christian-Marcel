<?php
$nome = "";
$idade = "";
$resultado = "";
$classeResultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $idade = $_POST["idade"] ?? "";

    if ($nome !== "" && $idade !== "" && is_numeric($idade) && $idade >= 0) {
        $idade = (int) $idade;

        if ($idade >= 18) {
            $resultado = "Maior de idade";
            $classeResultado = "maior";
        } else {
            $resultado = "Menor de idade";
            $classeResultado = "menor";
        }
    } else {
        $resultado = "Preencha os campos corretamente.";
        $classeResultado = "erro";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verificador de Idade</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;

            background: linear-gradient(
                135deg,
                #0f172a,
                #312e81,
                #6d28d9
            );
        }

        .container {
            width: 100%;
            max-width: 430px;
            padding: 36px;
            background: #ffffff;
            border-radius: 22px;

            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);

            animation: aparecer 0.6s ease;
        }

        .icone {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 34px;
            background: #ede9fe;
            border-radius: 20px;
        }

        h1 {
            text-align: center;
            color: #1e1b4b;
            font-size: 27px;
            margin-bottom: 10px;
        }

        .descricao {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #334155;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 14px 15px;

            border: 1px solid #cbd5e1;
            border-radius: 11px;

            font-size: 15px;
            color: #0f172a;
            background: #f8fafc;

            transition: 0.25s;
        }

        input:focus {
            outline: none;
            border-color: #7c3aed;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.12);
        }

        button {
            width: 100%;
            padding: 15px;

            border: none;
            border-radius: 11px;

            color: #ffffff;
            font-size: 16px;
            font-weight: 700;

            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            cursor: pointer;

            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }

        button:active {
            transform: scale(0.98);
        }

        .resultado {
            margin-top: 24px;
            padding: 18px;
            border-radius: 12px;
            text-align: center;
            animation: aparecer 0.4s ease;
        }

        .resultado h2 {
            font-size: 17px;
            margin-bottom: 6px;
        }

        .resultado p {
            font-size: 14px;
            line-height: 1.5;
        }

        .maior {
            color: #166534;
            background: #dcfce7;
            border: 1px solid #86efac;
        }

        .menor {
            color: #9a3412;
            background: #ffedd5;
            border: 1px solid #fdba74;
        }

        .erro {
            color: #991b1b;
            background: #fee2e2;
            border: 1px solid #fca5a5;
        }

        .rodape {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }

        @keyframes aparecer {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 26px 22px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <main class="container">

        <div class="icone">🎂</div>

        <h1>Verificador de Idade</h1>

        <p class="descricao">
            Preencha seus dados abaixo para descobrir
            se você é maior ou menor de idade.
        </p>

        <form method="POST">

            <div class="campo">
                <label for="nome">Seu nome</label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Digite seu nome"
                    value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>"
                    required
                >
            </div>

            <div class="campo">
                <label for="idade">Sua idade</label>

                <input
                    type="number"
                    id="idade"
                    name="idade"
                    placeholder="Ex.: 20"
                    min="0"
                    max="130"
                    value="<?= htmlspecialchars((string)$idade, ENT_QUOTES, 'UTF-8') ?>"
                    required
                >
            </div>

            <button type="submit">Verificar minha idade →</button>

        </form>

        <?php if ($resultado !== ""): ?>

            <div class="resultado <?= htmlspecialchars($classeResultado, ENT_QUOTES, 'UTF-8') ?>">

                <?php if ($classeResultado === "maior"): ?>
                    <h2>✅ Olá, <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>!</h2>
                    <p>Você tem <?= $idade ?> anos e é maior de idade.</p>

                <?php elseif ($classeResultado === "menor"): ?>
                    <h2>🎈 Olá, <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>!</h2>
                    <p>Você tem <?= $idade ?> anos e é menor de idade.</p>

                <?php else: ?>
                    <h2>⚠️ Atenção</h2>
                    <p><?= htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>

            </div>

        <?php endif; ?>

        <div class="rodape">
            Projeto de aprendizado em PHP
        </div>

    </main>

</body>
</html>




