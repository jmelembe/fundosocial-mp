<?php
include("./conexao.php");

$id = $_GET['id'];

if (isset($_POST['submit'])) {

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : ''; // Aplicando MD5 para a senha
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
    $nivel_acesso = isset($_POST['nivel_acesso']) ? $_POST['nivel_acesso'] : '';
    $data_ingresso = isset($_POST['data_ingresso']) ? $_POST['data_ingresso'] : '';
    
    // Correção na sintaxe da consulta SQL
    $sql = "UPDATE usuarios SET username='$username', password='$password', nome='$nome', genero='$genero', 
        email='$email', contacto='$contacto', nivel_acesso='$nivel_acesso', data_ingresso='$data_ingresso' WHERE id=$id";

    $result = mysqli_query($conn, $sql);
  
    if ($result) {
        header("Location: gestao_membros.php?msg=Dados atualizados com Sucesso!");
        exit();
    } else {
        echo "Failed" . mysqli_error($conn);
    }
}

// Recuperar dados do usuário
$sql = "SELECT * FROM usuarios WHERE id=$id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Gestão de Academia do Fundo Social</title />
    <link rel="stylesheet" href="./style/estiloreg.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
</head>

<body>
    <div class="logo">
        <img src="./image/logofs1.jpg" width="120px" alt="" />
    </div>
    <h1>Atualizar dados do Usuário</h1>
    <p><b>Atualize os Dados e Submeta o Formulário</b></p>

    <form action="#" method="POST">
        <div class="input">
            <hr>
            <label for="username"><b>Nome do Utilizador:</b></label><br>
            <input type="text" id="username" size="60" name="username" value="<?php echo $row['username'] ?>" required /><br>

            <label for="password"><b>Senha:</b></label><br>
            <input type="password" id="password" size="60" name="password" value="<?php echo $row['password'] ?>" required /><br>

            <label for="nome"><b>Nome Completo:</b></label><br>
            <input type="text" id="nome" size="60" name="nome" value="<?php echo $row['nome'] ?>" required /><br>

            <label for="genero"><b>Genero:</b></label><br>
            <input type="text" id="genero" size="60" name="genero" value="<?php echo $row['genero'] ?>" required /><br>

            <label for="contacto"><b>Contacto</b></label><br>
            <input type="number" id="contacto" size="80" name="contacto" value="<?php echo $row['contacto'] ?>" required /><br>

            <label for="email"><b>E-mail:</b></label><br>
            <input type="email" id="email" size="60" name="email" value="<?php echo $row['email'] ?>" required /><br>

            <label for="nivel_acesso"><b>Nível de Acesso</b></label><br>
            <input type="number" id="nivel_acesso" size="80" name="nivel_acesso" value="<?php echo $row['nivel_acesso'] ?>" required /><br>

            <label for="data_ingresso"><b>Data de Ingresso</b></label><br>
            <input type="date" id="data_ingresso" size="80" name="data_ingresso" value="<?php echo $row['data_ingresso'] ?>" required /><br>
            <hr>
        </div>

        <div class="button-group">
            <input type="submit" id="submit" class="submit" name="submit" />
            <a href="dashboard.php" class="btn btn-primary">Voltar</a>
        </div>
    </form>
</body>

</html>
