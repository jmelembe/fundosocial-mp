<?php
include("./conexao.php");

$id = $_GET['id'];
if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $domingo = $_POST['domingo'];
    $sfeira = $_POST['sfeira'];
    $tfeira = $_POST['tfeira'];
    $qafeira = $_POST['qafeira'];
    $qifeira = $_POST['qifeira'];
    $sefeira = $_POST['sefeira'];
    $sabado = $_POST['sefeira'];

    $sql = "UPDATE  treinos set domingo='$domingo', sfeira='$sfeira', tfeira='$tfeira',qafeira='$qafeira', 
    qifeira='$qifeira', sefeira='$sefeira', sabado='$sabado' where id=$id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: gestao_treinos.php?msg=Dados actualizados com Sucesso!");
    } else {
        echo "Failed" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Gestão do Fundo Social</title />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/estilo.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
</head>

<body>

    <div class="logo">
        <img src="/image/logon.png" alt="10" />
    </div>
    <h1>Registo de Notas </h1>
    <p>Faca anotacoes sobre o membros</p>

    <div class="container">
        <a href="dashboard.html" class="btn btn-primary">Sair</a>
    </div>

    <?php
    $sql = "SELECT*from treinos where id=$id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <form action="#" method="POST">
        <label for="id">ID:</label>
        <input type="number" id="id" size="60" name="id" value="<?php echo $row['id'] ?>" />

        <label for="domingo">Domingo:</label>
        <input type="text" id="domingo" size="60" name="domingo" value="<?php echo $row['domingo'] ?>" />

        <label for="sfeira">2@ Feira:</label>
        <input type="text" id="sfeira" size="60" name="sfeira" value="<?php echo $row['sfeira'] ?>" />

        <label for="tfeira">3@ Feira:</label>
        <input type="text" id="tfeira" size="60" name="tfeira" value="<?php echo $row['tfeira'] ?>" />

        <label for="qafeira">4@ Feira:</label>
        <input type="text" id="qafeira" size="60" name="qafeira" value="<?php echo $row['qafeira'] ?>" />

        <label for="qifeira">5@ Feira:</label>
        <input type="text" id="qifeira" size="60" name="qifeira" value="<?php echo $row['qifeira'] ?>" />

        <label for="sefeira">6@ Feira:</label>
        <input type="text" id="sefeira" size="60" name="sefeira" value="<?php echo $row['sefeira'] ?>" />

        <label for="sabado">Sabado:</label>
        <input type="text" id="sabado" size="60" name="sabado" value="<?php echo $row['sabado'] ?>" />

        <label for="data_inicio">Data de Inicio:</label>
        <input type="date" id="data_inicio" size="60" name="data_inicio" value="<?php echo $row['data_inicio'] ?>" />

        <label for="data_final">Data de Termino:</label>
        <input type="date" id="data_final" size="60" name="data_final" value="<?php echo $row['data_final'] ?>" />
        <div class="button-group">
            <input type="submit" class="submit" name="submit" />
        </div>
    </form>
   
</body>

</html>