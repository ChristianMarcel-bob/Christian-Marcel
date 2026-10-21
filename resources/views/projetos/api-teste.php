<?php

// informar que a resposta será em JSON
header('Content-type: application/json; charset=utf-8');

// Descobrir o método utilizado na requisição

$metodo = $_SERVER['REQUEST_METHOD'];

// lista dos chamados de exemplo
$chamados = [

[
"id" => 1,
"titulo" => "Computador sem internet"

],
[

"id" => 2,
"titulo" => "Impressora atolada"

]

];


// Verificar o método de requisicao, e executar x acoes.
if ($metodo === 'GET') {

    http_response_code(200);


// Define o codigo de ststus HTTP dessa requisicao.

echo json_encode(200);

echo json_encode($chamados, JSON_UNESCAPED_UNICODE);

exit;

}

// se post:

if ($metodo === 'POST') {
// le o conteudo enviado no body da requisição
// ph: // input permite ler o corpo bruto da requisiçao

$conteudo = file_get_contents('php://input');

// Converte JSON em ARRAY PHP
$dados = "" ;

// Verifica se os dados são válidos

if($dados = json_decode($conteudo, true)) {
    !is_array($dados) || //o json nao foi convertido em um array
    !isset($dados['titulo']) || // o titulo nao foi informado ou e nulo
    !is_string($dados['titulo'] || //o titulo nao e um texto
    trim($dados['titulo'] === '') // O titulo esta vazio ou contém apenas espaços
    ) 

    {

http_response_code(400);
echo json_encode(["erro" => "Titulo obrigatorio"]);

    }

// simula a criacao de um chamado novo

$novoChamado = [

"id" => 3,
"titulo" => trim($dados['titulo'])

];
 
    http_response_code(201);

echo json_encode($novoChamado, JSON_UNESCAPED_UNICODE);

exit;



}

header('Allow:GET, POST');
http_response_code(405);
?>