<?php

    require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
    //require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';

    // Listando em arrays as rotas que vamos criar.
    return [
        'GET' => [
            'portfolio' => [new PortfolioController(), 'index'],
        //    'helpdesk' => [new HelpdeskController(), 'index'],
            //outras atividades...
        ],
        //'POST' => [
        //    'helpdesk' => [new HelpdeskController(), 'salvar']
        //]
    ];

?>