<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situação do aluno</title>
</head>
<body>

<h1>Cadastro e situação do aluno</h1>

<form method="POST" action="">
    <label>Nome do aluno:</label>
    <input type="text" name="nome" required>
    <br><br>

    <label>Idade:</label>
    <input type="number" name="idade" required>
    <br><br>

    <label>Nota 1:</label>
    <input type="number" name="nota1" min="0" max="10" step="0.01" required>
    <br><br>

    <label>Nota 2:</label>
    <input type="number" name="nota2" min="0" max="10" step="0.01" required>
    <br><br>

    <label>Nota 3:</label>
    <input type="number" name="nota3" min="0" max="10" step="0.01" required>
    <br><br>

    <label>Nota 4:</label>
    <input type="number" name="nota4" min="0" max="10" step="0.01" required>
    <br><br>

    <label>Nota 5:</label>
    <input type="number" name="nota5" min="0" max="10" step="0.01" required>
    <br><br>

    <button type="submit" name="enviar">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviar"])) {

    $nome = $_POST["nome"];
    $idade = $_POST["idade"];


    $nota1 = (float) $_POST["nota1"];
    $nota2 = (float) $_POST["nota2"];
    $nota3 = (float) $_POST["nota3"];
    $nota4 = (float) $_POST["nota4"];
    $nota5 = (float) $_POST["nota5"];

    $media = (($nota1 * 2) + ($nota2 * 3) + ($nota3 * 1) + ($nota4 * 1) + ($nota5 * 3)) / 10;

    if ($media >= 7) {
        $situacao = "APROVADO";
    } elseif ($media >= 5) {
        $situacao = "RECUPERAÇÃO";
    } else {
        $situacao = "REPROVADO";
    }

    echo "<h2>Resultado</h2>";
    echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>";
    echo "<p><strong>Idade:</strong> " . htmlspecialchars($idade) . "</p>";
    echo "<p><strong>Média:</strong> " . number_format($media, 2, ',', '.') . "</p>";
    echo "<p><strong>Situação:</strong> $situacao</p>";
}
?>

</body>
</html>