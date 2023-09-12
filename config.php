<?php
require './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
// Define as constantes para as informações de conexão com o banco de dados
define("HOST", $_ENV['DB_HOST']);
define("USER", $_ENV['DB_USER']);
define("PASS", $_ENV['DB_PASSWORD']);
define("BASE", $_ENV['DB_DATABASE']);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new MySQLi(HOST, USER, PASS, BASE);
$conn->set_charset("utf8");
