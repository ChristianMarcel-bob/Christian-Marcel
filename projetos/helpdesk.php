<?php
require_once "helpdesk-func.php";

$mensagem = "";

// Identificar a operacao solicitada

if ($_SERVER["REQUEST_METHOD"] === "POST") {

// o operador ?? é chamado de operador de coalescencia nula
// ele significa:
    //"utilize o valor da esquerda, se ele existir e nao for nulo. Caso contrario, utilize o valor da direita"

    $acao = $_POST["acao"] ?? "";

    // if(isset($_POST["acao"])) {
        // $acao = $_POST["acao"];
        // } else {

            $acao = "";
            //
        }

        if($acao === "cadastrar") {
$sucesso = cadastrarChamados(
$_POST["nome"] ?? "",
$_POST["setor"] ?? "",
$_POST["equipamento"] ?? "",
$_POST["descrição"] ?? "",
$_POST["prioridade"] ?? ""

);
        

$mensagem = $sucesso ? "chamado cadastrado com sucesso!" : "Erro ao cadastrar. Verifique aos dados.";
        }

        if ($acao === "atualizar") {

$sucesso = atualizarChamado((int) ($_POST["posicao]" ?? -1), $_POST["status] ?? "");
        }

        if ($acao === "excluir") {

$sucesso = excluirChamado((int) ($_POST["posicao"] ?? -1);

$mensagem = $sucesso ? "Chamado excluido!" : "Não foi possivel excluir.";
        }

        $chamados = lerChamados();
        $relatorio = gerarRelatorio();

        // Evite exibir HTML enviado pelo usuario

        function escapar($valor) {

return htmlspecialchars((string) $valor, ENT_QUOTS, "UTF-8");
        }
?>

        








    


        



    


