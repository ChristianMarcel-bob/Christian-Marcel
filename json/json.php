<?php

// 1. CAMINHO DO ARQUIVO JSON
$caminho = __DIR__ . "/dados.json";

$mensagem = "";
$tipoMensagem = "";

// 2. CRIAR O ARQUIVO CASO ELE NÃO EXISTA
if (!file_exists($caminho)) {
    file_put_contents($caminho, "[]", LOCK_EX);
}

// 3. LER E VALIDAR O JSON
$json = file_get_contents($caminho);
$alunos = json_decode($json, true);

$jsonValido = json_last_error() === JSON_ERROR_NONE
    && is_array($alunos);

if (!$jsonValido) {
    $alunos = [];
    $mensagem = "Erro: o arquivo dados.json contém dados inválidos.";
    $tipoMensagem = "erro";
}

// 4. FUNÇÃO PARA SALVAR OS DADOS
function salvarAlunos($caminho, $alunos)
{
    $jsonAtualizado = json_encode(
        array_values($alunos),
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    if ($jsonAtualizado === false) {
        return false;
    }

    return file_put_contents(
        $caminho,
        $jsonAtualizado,
        LOCK_EX
    ) !== false;
}

// 5. PROCESSAR OS FORMULÁRIOS
if ($_SERVER["REQUEST_METHOD"] === "POST" && $jsonValido) {

    $acao = $_POST["acao"] ?? "";

    $nome = trim($_POST["nome"] ?? "");
    $idade = $_POST["idade"] ?? "";
    $curso = trim($_POST["curso"] ?? "");

    if ($acao === "cadastrar") {

        // VALIDAR OS DADOS
        if ($nome === "" || $curso === "" ||
            filter_var($idade, FILTER_VALIDATE_INT) === false ||
            (int)$idade < 0) {

            $mensagem = "Preencha os dados corretamente.";
            $tipoMensagem = "erro";

        } else {

            // CADASTRAR NOVO ALUNO
            $novoAluno = [
                "nome" => $nome,
                "idade" => (int)$idade,
                "curso" => $curso
            ];

            $alunos[] = $novoAluno;

            if (salvarAlunos($caminho, $alunos)) {
                $mensagem = "Aluno cadastrado com sucesso!";
                $tipoMensagem = "sucesso";
            } else {
                $mensagem = "Erro ao salvar o cadastro.";
                $tipoMensagem = "erro";
            }
        }

    } elseif ($acao === "atualizar") {

        // VALIDAR OS DADOS
        if ($nome === "" || $curso === "" ||
            filter_var($idade, FILTER_VALIDATE_INT) === false ||
            (int)$idade < 0) {

            $mensagem = "Preencha os dados corretamente.";
            $tipoMensagem = "erro";

        } else {

            $encontrado = false;

            // PROCURAR O ALUNO PELO NOME
            foreach ($alunos as $posicao => $aluno) {

                if (($aluno["nome"] ?? "") === $nome) {

                    $alunos[$posicao]["idade"] = (int)$idade;
                    $alunos[$posicao]["curso"] = $curso;

                    $encontrado = true;
                    break;
                }
            }

            if (!$encontrado) {

                $mensagem = "Aluno não encontrado.";
                $tipoMensagem = "erro";

            } elseif (salvarAlunos($caminho, $alunos)) {

                $mensagem = "Cadastro atualizado com sucesso!";
                $tipoMensagem = "sucesso";

            } else {

                $mensagem = "Erro ao salvar a atualização.";
                $tipoMensagem = "erro";
            }
        }

    } elseif ($acao === "deletar") {

        // PROCURAR O NOME PARA EXCLUSÃO
        if ($nome === "") {

            $mensagem = "Informe o nome do aluno.";
            $tipoMensagem = "erro";

        } else {

            $quantidadeAntes = count($alunos);

            // REMOVER O ALUNO PELO NOME
            $alunos = array_values(array_filter(
                $alunos,
                function ($aluno) use ($nome) {
                    return ($aluno["nome"] ?? "") !== $nome;
                }
            ));

            if (count($alunos) === $quantidadeAntes) {

                $mensagem = "Aluno não encontrado.";
                $tipoMensagem = "erro";

            } elseif (salvarAlunos($caminho, $alunos)) {

                $mensagem = "Aluno removido com sucesso!";
                $tipoMensagem = "sucesso";

            } else {

                $mensagem = "Erro ao salvar a exclusão.";
                $tipoMensagem = "erro";
            }
        }

    } else {

        $mensagem = "Ação inválida.";
        $tipoMensagem = "erro";
    }
}

// 6. FUNÇÃO PARA EXIBIR TEXTO COM SEGURANÇA
function escapar($texto)
{
    return htmlspecialchars(
        (string)$texto,
        ENT_QUOTES,
        "UTF-8"
    );
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Cadastro de Alunos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 30px auto;
            padding: 0 20px;
            background: #f4f4f4;
            color: #222;
        }

        h1, h2 {
            color: #243b53;
        }

        form, .aluno {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px #00000012;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 16px;
            background: #1769aa;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #104d80;
        }

        .mensagem {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .sucesso {
            background: #d4edda;
            color: #155724;
        }

        .erro {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>

    <h1>Sistema de Cadastro de Alunos</h1>

    <?php if ($mensagem !== ""): ?>
        <div class="mensagem <?= escapar($tipoMensagem) ?>">
            <?= escapar($mensagem) ?>
        </div>
    <?php endif; ?>

    <h2>Cadastrar aluno</h2>

    <form method="POST">

        <label for="nome-cadastro">Nome:</label>
        <input
            type="text"
            id="nome-cadastro"
            name="nome"
            placeholder="Digite o nome completo"
            required
        >

        <label for="idade-cadastro">Idade:</label>
        <input
            type="number"
            id="idade-cadastro"
            name="idade"
            placeholder="Ex.: 20"
            min="0"
            step="1"
            required
        >

        <label for="curso-cadastro">Curso:</label>
        <input
            type="text"
            id="curso-cadastro"
            name="curso"
            placeholder="Digite o nome do curso"
            required
        >

        <button type="submit" name="acao" value="cadastrar">
            Cadastrar
        </button>

    </form>

    <h2>Alunos cadastrados</h2>

    <?php if (count($alunos) === 0): ?>

        <p>Nenhum aluno cadastrado.</p>

    <?php else: ?>

        <?php foreach ($alunos as $aluno): ?>

            <div class="aluno">
                <h3><?= escapar($aluno["nome"] ?? "") ?></h3>

                <p>
                    Idade:
                    <?= escapar($aluno["idade"] ?? "") ?>
                </p>

                <p>
                    Curso:
                    <?= escapar($aluno["curso"] ?? "") ?>
                </p>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <h2>Atualizar cadastro</h2>

    <form method="POST">

        <label for="nome-atualizar">
            Nome do aluno cadastrado:
        </label>

        <input
            type="text"
            id="nome-atualizar"
            name="nome"
            placeholder="Digite o nome exato do aluno"
            required
        >

        <label for="idade-atualizar">Nova idade:</label>
        <input
            type="number"
            id="idade-atualizar"
            name="idade"
            min="0"
            step="1"
            required
        >

        <label for="curso-atualizar">Novo curso:</label>
        <input
            type="text"
            id="curso-atualizar"
            name="curso"
            required
        >

        <button type="submit" name="acao" value="atualizar">
            Atualizar cadastro
        </button>

    </form>

    <h2>Deletar cadastro</h2>

    <form method="POST">

        <label for="nome-deletar">Nome do aluno:</label>

        <input
            type="text"
            id="nome-deletar"
            name="nome"
            placeholder="Digite o nome exato do aluno"
            required
        >

        <button type="submit" name="acao" value="deletar">
            Deletar aluno
        </button>

    </form>

</body>
</html>