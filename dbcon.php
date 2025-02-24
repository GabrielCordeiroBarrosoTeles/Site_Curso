<?php
// Configurações do banco de dados
$host = "localhost";
$user = "root";
$password = ""; 
$dbname = "sitecurso";

// Conectar ao banco de dados usando MySQLi
$mysqli = new mysqli($host, $user, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}


?>
