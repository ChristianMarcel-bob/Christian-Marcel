<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula inicial teste</title>
</head>
<body>
    <?php
    $nome = "Christian";
    $idade = 37;


    $nome="";
    $idade=0;
    $resultado="";
    if ($_SERVER["REQUEST_METHOD"] =="POST"){
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];


    if ($idade >= 18) {
        $status = "Maior de idade";
    } else {
        $status = "Menor de idade";
    }



 } //O IF ESTÁ PERGUNTANDO SE O FORMULÁRIO TEM MÉTODO DE POST



    ?>
  
    <h1>Nome: <?= $nome ?></h1>
    <p>Idade: <?= $idade ?></p>
    <p>Status: <?= $status ?></p>

 
    <h2>atualizar cadastro</h2>
    <form method="POST">

        <div>
            <label for="nome">christian marcel:</label>
            <input type="text" id="nome" name="nome" value="<?= $nome?>">

            </div>
        
        <div>
            <label for="idade">alterar idade:</label>
            <input type="number" id="idade" name="idade" value="<?= $idade ?>">
        </div>
          
        <button type="submit">Atualizar</button>

    </form>


    <?php if ($resultado != "") { ?>
        


    <?php } ?>

</body>
</html>




</body>
</html>
