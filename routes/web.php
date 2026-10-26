<?php

require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
//require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';


return[
'GET' =>[
'portfolio' => [new PortfolioController(), 'index'],
//'helpdesk' => [new HelpdeskController(), 'index'],
'jogos' => [new jogosController(), 'index'],
//outras atividades...
],
//'POST' => [
//'helpdesk' => []

//]

];




?>