<?php

require "conexao.php";

echo "Meu sistema está conectado!";

$sql = "CREATE TABLE IF NOT EXISTS teste (

id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100),
idade INT)";

$pdo->exec($sql);
echo "<br>Tabela criada com sucesso!";

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <br>
    <a href="idade.php">Verificador de idade</a><br>
    <a href="notas.php">Verificador de notas</a><br>
    <a href="login-basico.php">login basico</a>
</body>

</html>