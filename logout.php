<?php
session_start(); // Iniciar a sessão

// Registrar a atividade de logout
include("visualizar_actividades.php");
registrarAtividade("logout");

// Finalizar a sessão apenas para o usuário actual
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    session_unset();
    session_destroy();
}

// Redirecionar para a página de login
header("Location: index.html");
exit();
?>
