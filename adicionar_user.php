<?php
include("./conexao.php");

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password-repeat"];
    $nivel_acesso = $_POST["nivel_acesso"];
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $email = $_POST["email"];
    $contacto = $_POST["contacto"];
    $data_ingresso = date("data_ingresso");

    // Verificar se todos os campos estão preenchidos
    if (
        empty($username) || empty($password) || empty($password_repeat) || empty($nivel_acesso)
        || empty($nome) || empty($genero) || empty($email) || empty($contacto) || empty($data_ingresso)
    ) {
        echo "Todos os campos são obrigatórios. Preencha corretamente.";
    } else {
        // Verificar se o usuário já está cadastrado
        $sql_check_user = "SELECT * FROM usuarios WHERE username = '$username'";
        $result_check_user = $conn->query($sql_check_user);

        if ($result_check_user->num_rows > 0) {
            echo "Usuário já cadastrado. Escolha outro nome de usuário.";
        } else {
            // Verificar se as senhas coincidem
            if ($password == $password_repeat) {
                // Hash da senha antes de salvar no banco de dados
                $hashed_password = md5($password);

                // Inserir novo usuário no banco de dados
                $sql_insert_user = "INSERT INTO usuarios (username, password, nivel_acesso, nome, genero, email, contacto, data_ingresso) VALUES
                 ('$username', '$hashed_password', '$nivel_acesso', '$nome', '$genero', '$email', '$contacto', '$data_ingresso')";

                if ($conn->query($sql_insert_user) === TRUE) {
                    // Redirecionar após 5 segundos
                    echo "Registrado com Sucesso! Redirecionando...";
                    header("refresh:5;url=dashboard.html");
                } else {
                    echo "Erro ao cadastrar o usuário: " . $conn->error;
                }
            } else {
                echo "As senhas não coincidem. Tente novamente.";
            }
        }
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
