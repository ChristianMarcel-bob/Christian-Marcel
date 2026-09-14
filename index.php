<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula inicial teste</title>
</head>
<body>
    <?php

$nome = "Christian";
$idade = "37";
if ($idade >= 18) {
        $status = "Maior de idade";
    } 
    else {
        $status = "Menor de idade";
    }
?>

<h1>nome: <?= $nome ?></h1>;
<p> idade: <?= $idade ?> </p>;
<p> status: <?= $status ?> </p>;
    


</body>
</html>
