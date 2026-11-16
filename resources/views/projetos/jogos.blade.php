<?php
require __DIR__ . "/../../../config/conexao.php";

$pdo->exec("CREATE TABLE IF NOT EXISTS jogos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    nota INT NOT NULL
)");

$senhaCorreta = "cgdm";
$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $genero = trim($_POST["genero"] ?? "");
    $nota = $_POST["nota"] ?? "";
    $senha = $_POST["senha"] ?? "";

    if ($nome === "" || $genero === "" || $nota === "" || $senha === "") {
        $mensagem = "Preencha todos os campos.";
        $tipoMensagem = "erro";
    } elseif (!ctype_digit((string)$nota) || (int)$nota < 0 || (int)$nota > 10) {
        $mensagem = "A nota deve ser um número inteiro de 0 a 10.";
        $tipoMensagem = "erro";
    } elseif (!hash_equals($senhaCorreta, $senha)) {
        $mensagem = "Senha incorreta!";
        $tipoMensagem = "erro";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO jogos (nome, genero, nota) VALUES (?, ?, ?)"
        );
        $stmt->execute([$nome, $genero, (int)$nota]);

        $mensagem = "Jogo cadastrado com sucesso!";
        $tipoMensagem = "sucesso";
    }
}

$stmt = $pdo->query("SELECT * FROM jogos ORDER BY id DESC");
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalJogos = count($jogos);
$somaNotas = 0;

foreach ($jogos as $jogo) {
    $somaNotas += (int)$jogo["nota"];
}

$media = $totalJogos > 0
    ? number_format($somaNotas / $totalJogos, 1, ",", ".")
    : "0,0";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault | Minha coleção</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            padding: 35px 18px;
            color: #f1f5f9;
            background:
                radial-gradient(circle at top left, #29205c, transparent 40%),
                radial-gradient(circle at bottom right, #10394e, transparent 35%),
                #0b1020;
        }

        .container {
            max-width: 1050px;
            margin: 0 auto;
        }

        header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 30px;
        }

        .logo {
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            border-radius: 17px;
            font-size: 28px;
            background: linear-gradient(135deg, #8b5cf6, #4f46e5);
        }

        h1 {
            font-size: 30px;
        }

        h1 span {
            color: #38bdf8;
        }

        .subtitulo {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 14px;
        }

        .estatisticas {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .estatistica,
        .painel {
            background: rgba(19, 26, 46, 0.95);
            border: 1px solid #27324b;
            border-radius: 18px;
            padding: 25px;
        }

        .estatistica p {
            color: #94a3b8;
            font-size: 14px;
        }

        .estatistica h2 {
            font-size: 30px;
            margin-top: 10px;
        }

        .painel {
            margin-bottom: 24px;
        }

        .titulo-painel {
            margin-bottom: 22px;
        }

        .titulo-painel h2 {
            font-size: 21px;
        }

        .titulo-painel p {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 6px;
        }

        .mensagem {
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .sucesso {
            color: #86efac;
            background: #123324;
            border: 1px solid #276749;
        }

        .erro {
            color: #fca5a5;
            background: #3b1d27;
            border: 1px solid #7f303d;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .campo label {
            display: block;
            margin-bottom: 9px;
            font-size: 14px;
            font-weight: 600;
        }

        .campo input {
            width: 100%;
            padding: 13px 14px;
            border-radius: 10px;
            border: 1px solid #34415e;
            background: #0d1426;
            color: white;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .campo input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px #8b5cf633;
        }

        .campo input::placeholder {
            color: #64748b;
        }

        button {
            width: 100%;
            padding: 15px;
            margin-top: 23px;
            border: none;
            border-radius: 10px;
            color: white;
            background: linear-gradient(135deg, #8b5cf6, #4f46e5);
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px #6366f155;
        }

        .tabela-wrapper {
            overflow-x: auto;
            border: 1px solid #27324b;
            border-radius: 12px;
        }

        table {
            width: 100%;
            min-width: 470px;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 15px;
            background: #1b2540;
            color: #a5b4fc;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            padding: 16px 15px;
            border-top: 1px solid #27324b;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #8b5cf610;
        }

        .genero {
            color: #7dd3fc;
            background: #0c3348;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 12px;
        }

        .nota {
            display: inline-block;
            padding: 6px 10px;
            color: #fde68a;
            background: #443615;
            border-radius: 7px;
            font-weight: bold;
        }

        .vazio {
            padding: 25px;
            text-align: center;
            color: #94a3b8;
        }

        footer {
            text-align: center;
            color: #64748b;
            font-size: 12px;
            padding: 10px;
        }

        @media (max-width: 600px) {
            body {
                padding: 22px 12px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .estatisticas {
                gap: 10px;
            }

            .estatistica,
            .painel {
                padding: 18px;
            }

            h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>
    <main class="container">

        <header>
            <div class="logo">🎮</div>
            <div>
                <h1>Game<span>Vault</span></h1>
                <p class="subtitulo">Sua coleção de jogos em um só lugar.</p>
            </div>
        </header>

        <section class="estatisticas">
            <div class="estatistica">
                <p>Jogos cadastrados</p>
                <h2><?= $totalJogos ?></h2>
            </div>

            <div class="estatistica">
                <p>Média das notas</p>
                <h2><?= $media ?> <span style="font-size:15px">/ 10</span></h2>
            </div>
        </section>

        <section class="painel">
            <div class="titulo-painel">
                <h2>✨ Adicionar novo jogo</h2>
                <p>Preencha os dados para adicionar à sua coleção.</p>
            </div>

            <?php if ($mensagem !== ""): ?>
                <div class="mensagem <?= $tipoMensagem ?>">
                    <?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-grid">
                    <div class="campo">
                        <label for="nome">Nome do jogo</label>
                        <input type="text" id="nome" name="nome"
                               maxlength="100" placeholder="Ex.: God of War" required>
                    </div>

                    <div class="campo">
                        <label for="genero">Gênero</label>
                        <input type="text" id="genero" name="genero"
                               maxlength="50" placeholder="Ex.: Aventura" required>
                    </div>

                    <div class="campo">
                        <label for="nota">Nota de 0 a 10</label>
                        <input type="number" id="nota" name="nota"
                               min="0" max="10" step="1" placeholder="Ex.: 9" required>
                    </div>

                    <div class="campo">
                        <label for="senha">Senha de cadastro</label>
                        <input type="password" id="senha" name="senha"
                               placeholder="Digite a senha" required>
                    </div>
                </div>

                <button type="submit">＋ Cadastrar jogo</button>
            </form>
        </section>

        <section class="painel">
            <div class="titulo-painel">
                <h2>🕹️ Minha coleção</h2>
                <p>Todos os jogos cadastrados no sistema.</p>
            </div>

            <div class="tabela-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Gênero</th>
                            <th>Nota</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($totalJogos > 0): ?>
                            <?php foreach ($jogos as $jogo): ?>
                                <tr>
                                    <td>#<?= (int)$jogo["id"] ?></td>
                                    <td>
                                        <?= htmlspecialchars($jogo["nome"], ENT_QUOTES, "UTF-8") ?>
                                    </td>
                                    <td>
                                        <span class="genero">
                                            <?= htmlspecialchars($jogo["genero"], ENT_QUOTES, "UTF-8") ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="nota">
                                            <?= (int)$jogo["nota"] ?>/10
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <div class="vazio">
                                        🎮 Sua coleção está vazia.<br><br>
                                        Cadastre seu primeiro jogo!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <footer>
            GameVault © <?= date("Y") ?> · Desenvolvido com PHP e MySQL
        </footer>

    </main>
</body>
</html>


