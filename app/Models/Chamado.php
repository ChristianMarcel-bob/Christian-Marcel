<?php
class Chamado{
    // READ - ler todos os chamados

    public function lerChamados() {
    $arquivo = __DIR__ . "/../dados/chamados.json";

    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, "[]");
    }

    // Ler o arquivo
    $conteudo = file_get_contents($arquivo);

    // Converter o json para array php
    $chamados = json_decode($conteudo, true);

    return is_array($chamados) ? $chamados : [];
}

// Salvar os chamados no JSON
public function salvarChamados($chamados) {
    $arquivo = __DIR__ . "/../dados/chamados.json";

    return file_put_contents(
        $arquivo, 
        json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    ) !== false;
}

// CREATE - cadastrar chamados
public function cadastrarChamado($nome, $setor, $equipamento, $descricao, $prioridade) {
    if (trim($nome) === "" || trim($descricao) === "") {
        return false;
    }

    $chamados = $this->lerChamados();

    $novoChamado = [
        "nome" => trim($nome),
        "setor" => $setor,
        "equipamento" => $equipamento,
        "descricao" => trim($descricao),
        "prioridade" => $prioridade,
        "status" => "Aberto"
    ];

    $chamados[] = $novoChamado;
    return $this->salvarChamados($chamados);
}

// UPDATE - atualizar status do chamado
public function atualizarStatusChamado($posicao, $novoStatus) {
    $chamados = $this->lerChamados();

    $statusPermitidos = [
        "Aberto",
        "Em andamento",
        "Resolvido"
    ];

    if (!isset($chamados[$posicao])) {
        return false;
    }

    if (!in_array($novoStatus, $statusPermitidos, true)) {
        return false;
    }

    $chamados[$posicao]["status"] = $novoStatus;

    return $this->salvarChamados($chamados);
}

// DELETE - excluir chamados
public function excluirChamado($posicao) {
    $chamados = $this->lerChamados();

    if (!isset($chamados[$posicao])) {
        return false;
    }

    unset($chamados[$posicao]);

    $chamados = array_values($chamados);

    return $this->salvarChamados($chamados);
}

// RELATÓRIO - gerar relatório dos chamados
public function gerarRelatorio() {
    $chamados = $this->lerChamados();

    $relatorio = [
        "total" => count($chamados),
        "abertos" => 0,
        "andamento" => 0,
        "resolvidos" => 0
    ];

    foreach ($chamados as $chamado) {
        if ($chamado["status"] === "Aberto") {
            $relatorio["abertos"]++;
        } elseif ($chamado["status"] === "Em andamento") {
            $relatorio["andamento"]++;
        } elseif ($chamado["status"] === "Resolvido") {
            $relatorio["resolvidos"]++;
        }
    }

    return $relatorio;
}





}



?>