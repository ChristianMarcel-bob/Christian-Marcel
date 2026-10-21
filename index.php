<?php
// Carregando o arquivo de rotas e guardando o valor retornado por ele na variavel
$rotas = require __DIR__ . "/routes/web.php";

$rota = $_GET['roota'] ?? 'portfolio';

$metodo = $_SERVER['REQUEST_METHOD'];

if(!isset($rotas[$metodo][$rota])) {

http_response_code(404);
echo "Página não encontrada";
exit;



}

[$controller, $acao] = $rotas[$metodo][$rota];

$controller->$acao();

?>