<?php
// htdocs/config.php
session_start();

// URL base do projeto (se estiver acessando em http://localhost/, deixe como '/')
define('BASE_URL', '/');

// Conexão com pdo
session_start();

// Caminho base do projeto, ex: "/" ou "/meusite/"
define('BASE_URL', '/');

// Dados de conexão
$host = 'sql312.infinityfree.com';
$db   = 'if0_38701439_fatecmeets';
$user = 'if0_38701439';
$pass = 'Ye20N4PfvZ';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
