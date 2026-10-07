<?php

// 1. DECLARAR O CAMINHO DO ARQUIVO JSON
$caminho = __DIR__ . "/dados.json";

// 2. ABRIR/LER O ARQUIVO JSON
$json = file_get_contents($caminho);

//3. TRANSFORMAR JSON EM ARRAY PHP
$alunos = json_decode($json, true);

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
    
</body>
</html>