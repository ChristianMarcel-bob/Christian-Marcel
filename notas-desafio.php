<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situacao do aluno</title>
</head>
<body>

<h1>Cadastro e situacao do aluno</h1>
<form method= "GET" action="">
    <label>Nome do aluno:</label>
    <imput type ="text" name="nome" required>
        <br><br>

        <label>Idade:</label>
        <input type="number" name="idade" required>
        <br><br>

        <label> Nota 1:</label>
        <input type= "number" name="nota 1" min="0" max="10" step= "0.01" required>
        <br><br>

        <label>Nota 2:</label>
        <input type= "number" name="nota 2" min="0" max="10" step= "0.01" required>
        <br><br>

        <label>Nota 3:</label>
        <input type= "number" name="nota 3" min="0" max="10" step ="0.01" required>
        <br><br>

        <label>Nota 4:</label>
        <input type="number" name="nota 4" min="0" max="10" step="0.01" reqired>
        <br><br>

        <label>Nota 5:</label>
        <input type="number" name="nota 5" min="0" max="10" step="0.01" required>
        <br><br>

        <button type="submit">Enviar</button>
</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "GET") {
$nome = $_GET["nome"];
$idade= $_GET["idade"];

$nota 1= $_GET["nota 1"];
$nota 2= $_GET["nota 2"];
$nota 3= $_GET["nota 3"];
$nota 4= $_GET["nota 4"];
$nota 5= $_GET["nota 5"];

$media = (
($nota 1 * 2) +
($nota 2 * 3) +
($nota 3 * 1) +
($nota 4 * 1) +
($nota 5 * 3) +

) / 10;

if ($media >= 7) {

    $situacao = "APROVADO";
}

elseif ($media >=5) {
    $situacao = "RECUPERACAO";
}

else {

    $situacao = "REPROVADO";

}

echo "<h2>Resultado</h2>";

echo "<p><strong>Nome:</strong> $nome</p>";
echo "<p><strong>Idade:</strong> $idade</p>";
echo "<p><strong>Média:</strong> . number_format ($media,2,',',') . </p>;
echo "<p><strong>Situacao:</strong> $situacao </p>;

}
?>


























</form>
    
</body>
</html>