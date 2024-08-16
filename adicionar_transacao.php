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
    $Jan = $_POST['Jan'];
    $Fev = $_POST['Fev'];
    $Mar = $_POST['Mar'];
    $Abr = $_POST['Abr'];
    $Mai = $_POST['Mai'];
    $Jun = $_POST['Jun'];
    $Jul = $_POST['Jul'];
    $Ago = $_POST['Ago'];
    $Sept = $_POST['Sept'];
    $Oct = $_POST['Oct'];
    $Nov = $_POST['Nov'];
    $Dez = $_POST['Dez'];

    // Utilize a função mysqli_real_escape_string para evitar SQL injection
    $Jan = mysqli_real_escape_string($conn, $Jan);
    $Fev = mysqli_real_escape_string($conn, $Fev);
    $Mar = mysqli_real_escape_string($conn, $Mar);
    $Abr = mysqli_real_escape_string($conn, $Abr);
    $Mai = mysqli_real_escape_string($conn, $Mai);
    $Jun = mysqli_real_escape_string($conn, $Jun);
    $Jul = mysqli_real_escape_string($conn, $Jul);
    $Ago = mysqli_real_escape_string($conn, $Ago);
    $Sept = mysqli_real_escape_string($conn, $Sept);
    $Oct = mysqli_real_escape_string($conn, $Oct);
    $Nov = mysqli_real_escape_string($conn, $Nov);
    $Dez = mysqli_real_escape_string($conn, $Dez);

    // Verifica se 'id' está definido em POST, se não estiver, define como nulo
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    // Utilize prepared statements para evitar SQL injection
    $sql = "INSERT INTO contribuicoes (id, Jan, Fev, Mar, Abr, Mai, Jun, Jul, Ago, Sept, Oct, Nov, Dez) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Vincula parâmetros
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $id, $Jan, $Fev, $Mar, $Abr, $Mai, $Jun, $Jul, $Ago, $Sept, $Oct, $Nov, $Dez);

    // Executa a instrução preparada
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: gestao_transacao.php?msg=Dados registrados com Sucesso!");
        exit();
    } else {
        echo "Falha na execução da instrução: " . mysqli_error($conn);
        echo "<br>";
        echo "ID: $id, $Jan, $Fev, $Mar, $Abr, $Mai, $Jun, $Jul, $Ago, $Jul, $Ago, $Sept, $Oct, $Nov, $Dez";
    }

    // Fecha a instrução preparada
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Gestão do Fundo Social</title>
    <link rel="stylesheet" href="./style/estilorel.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
</head>

<body style="background-image: url('image/11.jpg')">
    <div class="logo">
        <img src="./image/logofs1.jpg" width="90px" alt="" />
    </div>
    <h2>Adicionar Transacao</h2>
    <form method="post" action="process_transacao.php">
        <div class="input">
            <hr>

            <!-- Campo de entrada para 'id' adicionado com valor preenchido -->
            <label for="id"><b>ID:</b></label><br>
            <input type="text" name="id" value="<?php echo $id; ?>"><br>

            <label for="Mes"><b>Mes a Pagar:</b></label><br>
            <select name="Mes">
                <option value="0">Select o Mes:</option><br>
                <option value="Jan">Janeiro</option>
                <option value="Fev">Fevereiro</option>
                <option value="Mar">Marco</option>
                <option value="Abr">Abril</option>
                <option value="Mai">Maio</option>
                <option value="Jun">Junho</option>
                <option value="Jul">Julho</option>
                <option value="Ago">Agosto</option>
                <option value="Sept">Setembro</option>
                <option value="Oct">Outubro</option>
                <option value="Nov">Novembro</option>
                <option value="Dez">Dezembro</option><br>
            </select><br>
            <label for="valor"><b>Valor:</b></label><br>
            <input type="number" name="valor"><br>

            <label for="data"><b>Data:</b></label><br>
            <input type="date" name="data"><br>
            <hr>

            <button type="submit" name="submit">Registrar Transacao</button>
        </div>
    </form>
    <div class="container">
        <a href="dashboard.php" class="btn btn-primary">Sair</a>
    </div>
</body>

</html>
