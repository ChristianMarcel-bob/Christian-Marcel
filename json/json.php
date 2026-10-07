<?php

// 1. DECLARAR O CAMINHO DO ARQUIVO JSON
$caminho = __DIR__ . "/dados.json";

// 2. ABRIR/LER O ARQUIVO JSON
$json = file_get_contents($caminho);

//3. TRANSFORMAR JSON EM ARRAY PHP
$alunos = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}

//4. CRIAR UM ALUNO
$novoAluno = [

"nome" => "Christian",
"idade" => 37,
"curso" => "Desenvolvimento de sistemas"


];

// 5. ADICIONAR O ALUNO NO ARRAY
$alunos[] = $novoAluno;

// 6. TRANSFORMAR ARRAY PHP EM JSON
$jsonAtualizado = json_encode($alunos,
JSON_PRETTY_PRINT |
JSON_UNESCAPED_UNICODE
);

//7. SALVAR NO ARQUIVO
file_put_contents($caminho, $jsonAtualizado);


echo "DADOS REGISTRADOS EM dados.json";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form>
<form action="/api/cadastro" method="POST">
        
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
        </div>

        <br>

        <div>
            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" placeholder="Ex: 20" min="0" required>
        </div>

        <br>

        <div>
            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" placeholder="Digite o nome do curso" required>
        </div>

        <br>

        <button type="submit">Enviar Dados</button>


</form>







    
</body>
</html>