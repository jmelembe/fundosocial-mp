<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados
    include("./conexao.php");

    // Recupere as credenciais do formulário
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    // Consulta SQL para verificar as credenciais usando uma consulta preparada para prevenir SQL injection
    $sql = "SELECT id, nivel_acesso FROM usuarios WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Credenciais corretas, usuário autenticado
        $row = $result->fetch_assoc();

        // Inicia uma nova sessão para este usuário
        session_regenerate_id(); // Gera um novo ID de sessão

        // Armazena os dados do usuário na sessão
        $_SESSION['idUsuarioLogado'] = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['nivel_acesso'] = $row['nivel_acesso'];

        // Redireciona para a página apropriada
        if ($_SESSION['nivel_acesso'] == 1) {
            header("Location: dashboard__membro.php");

        } elseif ($_SESSION['nivel_acesso'] == 2) {
            header("Location: dashboardA2.php");

        } elseif ($_SESSION['nivel_acesso'] == 3) {
            header("Location: dashboard.php");
        
        } else {
            echo "Nível de acesso desconhecido.";
        }
        exit(); // Importante para evitar a execução de código desnecessário após o redirecionamento
    } else {
        // Credenciais incorretas, redireciona de volta para a página de login
       // echo "Login falhou. Verifique suas credenciais.";
       header("Location: teste.php");
        echo "<meta http-equiv='refresh' content='5;url=index.html'>";
        header("Refresh: 5;url=index.html");
        exit(); // Certifique-se de sair para interromper a execução do script após o redirecionamento.
    }

    // Fechar a consulta preparada
    $stmt->close();

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
