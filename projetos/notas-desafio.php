<?php
$nome = $idade = $media = $situacao = $classe = $erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $idade = $_POST["idade"] ?? "";
    $notas = [];

    for ($i = 1; $i <= 5; $i++) {
        $notas[] = $_POST["nota$i"] ?? "";
    }

    if ($nome === "" || !ctype_digit((string)$idade) ||
        (int)$idade > 130 || (int)$idade < 0) {
        $erro = "Informe um nome e uma idade válida.";
    } else {
        foreach ($notas as $n) {
            if ($n === "" || !is_numeric($n) || $n < 0 || $n > 10) {
                $erro = "Todas as notas devem estar entre 0 e 10.";
                break;
            }
        }
    }

    if ($erro === "") {
        $pesos = [2, 3, 1, 1, 3];
        $soma = 0;

        foreach ($notas as $i => $n) {
            $soma += (float)$n * $pesos[$i];
        }

        $media = $soma / 10;

        if ($media >= 7) {
            $situacao = "APROVADO";
            $classe = "aprovado";
        } elseif ($media >= 5) {
            $situacao = "RECUPERAÇÃO";
            $classe = "recuperacao";
        } else {
            $situacao = "REPROVADO";
            $classe = "reprovado";
        }
    }
}

function e($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EducaPro | Notas</title>

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Arial,sans-serif;min-height:100vh;padding:25px 15px;background:linear-gradient(135deg,#eef2ff,#dbeafe);color:#1e293b}
main{max-width:650px;margin:auto}
header{text-align:center;margin:15px 0 25px}
header h1{color:#4f46e5;font-size:30px}
header p{color:#64748b;margin-top:7px}
.card{background:white;padding:25px;border-radius:18px;margin-bottom:20px;box-shadow:0 10px 30px #1e293b12}
h2{font-size:20px;margin-bottom:20px}
.grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
label{display:block;font-size:13px;font-weight:bold;margin-bottom:7px}
input{width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:9px;font-size:14px;outline:none}
input:focus{border-color:#6366f1;box-shadow:0 0 0 3px #6366f120}
.subtitulo{margin:25px 0 15px;color:#4f46e5;font-weight:bold}
button{width:100%;padding:14px;margin-top:24px;border:0;border-radius:9px;background:linear-gradient(135deg,#6366f1,#7c3aed);color:white;font-weight:bold;font-size:15px;cursor:pointer}
button:hover{filter:brightness(1.08)}
.msg{padding:12px;border-radius:9px;margin-bottom:18px;background:#fee2e2;color:#991b1b}
.resultado{text-align:center;padding:22px;border-radius:12px}
.resultado strong{display:block;font-size:38px;margin:12px}
.aprovado{background:#dcfce7;color:#166534}
.recuperacao{background:#fef3c7;color:#92400e}
.reprovado{background:#fee2e2;color:#991b1b}
footer{text-align:center;color:#64748b;font-size:12px;margin:25px 0}
@media(max-width:450px){.grid{grid-template-columns:1fr}.card{padding:20px}}
</style>
</head>

<body>
<main>
    <header>
        <h1>📚 EducaPro</h1>
        <p>Cadastro e desempenho escolar</p>
    </header>

    <section class="card">
        <h2>📝 Dados do aluno</h2>

        <?php if ($erro): ?>
            <p class="msg"><?= e($erro) ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="grid">
                <div>
                    <label for="nome">Nome do aluno</label>
                    <input id="nome" name="nome" value="<?= e($nome) ?>" required>
                </div>
                <div>
                    <label for="idade">Idade</label>
                    <input id="idade" name="idade" type="number" min="0" max="130"
                           value="<?= e($idade) ?>" required>
                </div>
            </div>

            <p class="subtitulo">📊 Notas das avaliações</p>

            <div class="grid">
                <?php for ($i=1; $i<=5; $i++): ?>
                    <div>
                        <label for="nota<?= $i ?>">
                            Nota <?= $i ?> (peso <?= [2,3,1,1,3][$i-1] ?>)
                        </label>
                        <input id="nota<?= $i ?>" name="nota<?= $i ?>"
                               type="number" min="0" max="10" step="0.01"
                               value="<?= e($notas[$i-1] ?? "") ?>" required>
                    </div>
                <?php endfor; ?>
            </div>

            <button name="enviar">Calcular média →</button>
        </form>
    </section>

    <?php if ($situacao): ?>
        <section class="card">
            <h2>📋 Resultado</h2>
            <p><b>Aluno:</b> <?= e($nome) ?></p>
            <p style="margin:10px 0 20px"><b>Idade:</b> <?= e($idade) ?> anos</p>

            <div class="resultado <?= e($classe) ?>">
                Média final
                <strong><?= number_format($media,2,",",".") ?></strong>
                <?= e($situacao) ?>
            </div>
        </section>
    <?php endif; ?>

    <footer>EducaPro © <?= date("Y") ?> · PHP</footer>
</main>
</body>
</html>