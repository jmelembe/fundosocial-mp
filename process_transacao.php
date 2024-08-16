<?php
include("./conexao.php");

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $Jan = isset($_POST['Jan']) ? $_POST['Jan'] : null;
    $Fev = isset($_POST['Fev']) ? $_POST['Fev'] : null;
    $Mar = isset($_POST['Mar']) ? $_POST['Mar'] : null;
    $Abr = isset($_POST['Abr']) ? $_POST['Abr'] : null;
    $Mai = isset($_POST['Mai']) ? $_POST['Mai'] : null;
    $Jun = isset($_POST['Jun']) ? $_POST['Jun'] : null;
    $Jul = isset($_POST['Jul']) ? $_POST['Jul'] : null;
    $Ago = isset($_POST['Ago']) ? $_POST['Ago'] : null;
    $Sept = isset($_POST['Sept']) ? $_POST['Sept'] : null;
    $Oct = isset($_POST['Oct']) ? $_POST['Oct'] : null;
    $Nov = isset($_POST['Nov']) ? $_POST['Nov'] : null;
    $Dez = isset($_POST['Dez']) ? $_POST['Dez'] : null;

    // Utilize prepared statements para evitar SQL injection
    $sql = "INSERT INTO contribuicoes ( Jan, Fev, Mar, Abr, Mai, Jun, Jul, Ago, Sept, Oct, Nov, Dez) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    // Vincula parâmetros
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $Jan, $Fev, $Mar, $Abr, $Mai, $Jun, $Jul, $Ago, $Sept, $Oct, $Nov, $Dez);

    // Executa a instrução preparada
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: gestao_transacao.php?msg=Dados registrados com Sucesso!");
        exit();
    } else {
        echo "Falha na execução da instrução: " . mysqli_error($conn);
        echo "<br>";
        echo "ID: $id, Jan: $Jan, Fev: $Fev, Mar: $Mar, Abr: $Abr, Mai: $Mai, Jun: $Jun, Jul: $Jul, Ago: $Ago, Sept: $Sept, Oct: $Oct, Nov: $Nov, Dez: $Dez";
    }

    // Fecha a instrução preparada
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
