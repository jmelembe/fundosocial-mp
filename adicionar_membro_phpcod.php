<?php
include("./conexao.php");

if (isset($_POST["submitForm"])) {
    // Obter dados do formulário
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $email = $_POST["email"];
    $contacto = $_POST["contacto"];
    $nivel_acesso = $_POST["nivel_acesso"];
    $data_ingresso = date("data_ingresso");

    // Conectar ao banco de dados
    $conn = new mysqli("localhost", "root", "", "fundo");

    // Inserir dados na tabela "membros"
    $sql = "INSERT INTO usuarios (username, password, nome, genero, email, contacto, nivel_acesso,  data_ingresso) 
    VALUES ('$username', '$password', '$nome','$genero','$email','$contacto','$nivel_acesso','$data_ingresso')";
    //$stmt = $conn->prepare($sql);
    //$stmt->bind_param("sssss", $name, $genero, $categoria, $email, $contacto, $data_ingresso);
    // $stmt->execute();
    // $stmt->close();

    // $conn->close();
    if (mysqli_query($conn, $sql)) {
        echo "Usuario cadastrado com sucesso";
        header("Location: adicionar_membro.php");
    } else {
        echo "Erro" . mysqli_connect_error($conn);
    }
    mysqli_close($conn);
}
?>
