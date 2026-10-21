<?php

require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
//require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';


return[
'GET' =>[
'portfolio' => [new portfolioController(), 'index'],
//'helpdesk' => [new HelpdeskController(), 'index'],
//'jogos' => [],
//outras atividades...
],
'POST' => [
//'helpdesk' => []

]

];




?>