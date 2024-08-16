<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fundo";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
