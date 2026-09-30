<?php

require "conexao.php";

// Criar a tabela jogos
$sql = "CREATE TABLE IF NOT EXISTS jogos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    genero VARCHAR(50),
    nota INT
)";

$pdo->exec($sql);

//verificar se o arquivo foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $nota = $_POST["nota"];


    $sql = "INSERT INTO jogos (nome, genero, nota)
            VALUES ('$nome', '$genero', $nota)";

    $pdo->exec($sql);

    echo "<p>Jogo cadastrado com sucesso!</p>";
}

// buscar todos

$buscar = "SELECT * FROM jogos";

//exec()  = executa algo quando vc nao precisa receber registros de volta.
// query() = executa uma consulta quando vc quer receber dados de volta.

$stmt = $pdo->query($buscar);

$jogos = $fetchALL(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Jogos</title>
</head>

<body>

    <h1>Cadastro de Jogos</h1>

    <form method="POST" action="">

        <label for="nome">Nome do jogo:</label>
        <input type="text" name="nome" id="nome" placeholder="Digite o nome do jogo">

        <br><br>

        <label for="genero">Gênero:</label>
        <input type="text" name="genero" id="genero" placeholder="Digite o genero" required>

        <br><br>

        <label for="nota">Nota:</label>
        <input type="number" name="nota" id="nota" min="0" max="10" placeholder="Digite a nota do jogo">

        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

    <h2>JOGOS CADASTRADOS</h2>
    
    <table>

        <tr>

            <th>ID</th>
            <th>Nome</th>
            <th>Genero</th>
            <th>Nota</th>


        </tr>

        <!--foreach() -> para cada item nesta lista faça alguma coisa com x variável -->
<?php foreach ($jogos as $jogo) { ?>

<tr>
    <td><?= $jogo["id"] ?></td>
    <td><?= $jogo["nome"] ?></td>
    <td><?= $jogo["genero"] ?></td>
    <td><?= $jogo["nota"] ?></td>
</tr>
<?php }  ?>


    </table>

</body>
</html>





</body>
</html>