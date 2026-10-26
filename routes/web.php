<?php

require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
//require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';
require_once __DIR__ . '/../app/Http/Controllers/JogosController.php';
require_once __DIR__ . '/../app/Http/Controllers/LoginController.php';
require_once __DIR__ . '/../app/Http/Controllers/NotasController.php';


return [
    'GET' => [
        'portfolio' => [new PortfolioController(), 'index'],
        //'helpdesk' => [new HelpdeskController(), 'index'],
        'jogos' => [new JogosController(), 'index'],
        'login' => [new LoginController(), 'index'],

    ],

];
