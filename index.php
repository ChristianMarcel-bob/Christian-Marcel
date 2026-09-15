<?php
    $nome="";
    $idade=0;
    $resultado="";

    if ($_SERVER["REQUEST_METHOD"] =="POST"){
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];

        if ($idade >= 18) {
            $status = "Maior de idade";
        } else {
            $resultado = "Menor de idade";
        }
    } //O IF ESTÁ PERGUNTANDO SE O FORMULÁRIO TEM MÉTODO DE POST
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aula inicial teste</title>
    </head>
    <body>
        <h2>Atualizar cadastro</h2>
        <form method="POST">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= $nome?>">
            </div>
            <div>
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" value="<?= $idade ?>">
            </div>
            <button type="submit">Atualizar</button>
        </form>

        <?php if ($resultado != "18") { ?>
            <p><?= $resultado ?></p>
        <?php } ?>

    </body>
</html>




</body>
</html>
