<?php
include("./conexao.php");

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
// Inicializa a variável $id
$id = null;

// Verifica se 'id' está presente na URL
if (isset($_GET['id'])) {
    // Se 'id' está presente, atribui o valor a $id
    $id = $_GET['id'];
}
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $domingo = $_POST['domingo'];
    $sfeira = $_POST['sfeira'];
    $tfeira = $_POST['tfeira'];
    $qafeira = $_POST['qafeira'];
    $qifeira = $_POST['qifeira'];
    $sefeira = $_POST['sefeira'];
    $sabado = $_POST['sabado'];

    // Utilize a função mysqli_real_escape_string para evitar SQL injection
    $domingo = mysqli_real_escape_string($conn, $domingo);
    $sfeira = mysqli_real_escape_string($conn, $sfeira);
    $tfeira = mysqli_real_escape_string($conn, $tfeira);
    $qafeira = mysqli_real_escape_string($conn, $qafeira);
    $qifeira = mysqli_real_escape_string($conn, $qifeira);
    $sefeira = mysqli_real_escape_string($conn, $sefeira);
    $sabado = mysqli_real_escape_string($conn, $sabado);

    // Verifica se 'id' está definido em POST, se não estiver, define como nulo
    $id = isset($_POST['id']) ? $_POST['id'] : null;


    // Utilize prepared statements para evitar SQL injection
    $sql = "INSERT INTO treinos (id, domingo, sfeira, tfeira, qafeira, qifeira, sefeira, sabado ) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    // Vincula parâmetros
    mysqli_stmt_bind_param($stmt, "sssssss", $id, $domingo, $sfeira, $tfeira, $qafeira, $qifeira, $sefeira, $sabado);

    // Executa a instrução preparada
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: gestao_membros.php?msg=Dados registrados com Sucesso!");
        exit();
    } else {
        echo "Falha na execução da instrução: " . mysqli_error($conn);
        echo "<br>";
        echo "ID: $id, domingo: $domingo, sfeira: $sfeira, tfeira: $tfeira, qafeira: $qafeira, qifeira: $qifeira, sefeira: $sefeira, sabado: $sabado";
    }

    // Fecha a instrução preparada
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en-pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Gestão do Fundo Social</title>
    <link rel="stylesheet" href="./style/estiloreg.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
</head>

<body style="background-image: url('image/11.jpg')">
    <div class="logo">
        <img src="./image/logon.png" alt="" />
    </div>
    <h2>Notas sobre o membro</h2>
    <form method="post" action="process_treino.php">
        <div class="input">
        <hr>
        <label for="id">ID:</label>
        <input type="text" name="id" value="<?php echo $id; ?>"><br>

        <label for="domingo">Domingo:</label>
        <input type="text" name="domingo"><br>

        <label for="sfeira">2@ Feira:</label>
        <input type="text" name="sfeira"><br>

        <label for="tfeira">3@ Feira:</label>
        <input type="text" name="tfeira"><br>

        <label for="qafeira">4@ Feira:</label>
        <input type="text" name="qafeira"><br>

        <label for="qifeira">5@ Feira:</label>
        <input type="text" name="qifeira"><br>

        <label for="sefeira">6@ Feira:</label>
        <input type="text" name="sefeira"><br>

        <label for="sabado">Sabado:</label>
        <input type="text" name="sabado"><br>

        <label for="data_inicio">Data de Inicio:</label>
        <input type="date" name="data_inicio" required>

        <label for="data_final">Data de Termino:</label>
        <input type="date" name="data_final" required><br>
        <hr>

        <button type="submit" name="submitForm">Registrar Nota</button>
        </div>
    </form>
</body>
<div class="container">
    <a href="dashboard.php" class="btn btn-primary">Sair</a>
</div>

</html>