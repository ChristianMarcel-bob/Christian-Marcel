<?php

// DADOS PARA CONEXÃO MYSQL
$host = "localhost";
$banco = "christian315";
$usuario = "christian315";
$senha = "315!@#";

// PDO= php data objects - É uma ferramenta do php para conversar com o banco de dados 
try {

    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Conectado com sucesso!";
} catch (PDOException $erro) {

    echo "Erro ao conectar:" . $erro->getMessage();
}
