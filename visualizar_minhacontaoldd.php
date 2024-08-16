<?php
include("./conexao.php");

session_start();

// Obtém o ID do usuário logado a partir da sessão
$idUsuarioLogado = isset($_SESSION['idUsuarioLogado']) ? $_SESSION['idUsuarioLogado'] : null;

if ($idUsuarioLogado) {
    // Adaptei a consulta para obter as somas dos valores dos meses apenas para o usuário logado
    $sql = "SELECT m.id, m.nome, 
            SUM(c.Jan + c.Fev + c.Mar + c.Abr + c.Mai + c.Jun + c.Jul + c.Ago + c.Sept + c.Oct + c.Nov + c.Dez) as pagamento,
            (1200 - SUM(c.Jan + c.Fev + c.Mar + c.Abr + c.Mai + c.Jun + c.Jul + c.Ago + c.Sept + c.Oct + c.Nov + c.Dez)) as esperado
            FROM usuarios m 
            INNER JOIN contribuicoes c ON m.id = c.usuario_id
            WHERE m.id = $idUsuarioLogado
            GROUP BY m.id, m.nome";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão do Fundo Social</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./style/estilorel.css">
    
</head> 
<body>
<div class="logo">
        <img src="./image/logofs1.jpg" alt="">
    </div>
    <h1>Sistema de Gestão do Fundo Social</h1>
    <h2>Minha Conta</h2> <button class="btn"><a href="dashboard__membro.html" class="fa fa-close"> </a></button>

    <div class="input">
        <form action="#" method="POST">
        <hr>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" size="60" name="nome" value="<?php echo $row['nome'] ?>" readonly/><br><br>
            <label for="pagamento">Pagamento:</label><br>
            <input type="text" id="pagamento" size="60" name="pagamento" value="<?php echo number_format(ceil($row['pagamento']), 2) . ' MZN' ?>" readonly/><br><br>
            <label for="esperado">Esperado:</label><br>
            <input type="text" id="esperado" size="60" name="esperado" value="<?php echo number_format(ceil($row['esperado']), 2) . ' MZN' ?>" readonly/><br><br>
            <label for="receber_membro">Valor a Receber-Membro:</label><br>
            <input type="text" id="receber_membro" size="60" name="receber_membro" value="<?php echo number_format(ceil($row['pagamento'] * 16.666666), 2) . ' MZN' ?>" readonly/><br><br>
            <label for="receber_terceiros">Valor a Receber-Terceiros:</label><br>
            <input type="text" id="receber_terceiros" size="60" name="receber_terceiros" value="<?php echo number_format(ceil($row['pagamento'] * 8.33333333), 2) . ' MZN' ?>" readonly/><br><br> 
            <hr>
        </form>
    </div>
 </body>
<?php
        } else {
            echo "Nenhum resultado encontrado para o usuário logado.";
        }
    } else {
        echo "Erro na consulta: " . mysqli_error($conn);
    }
} else {
    echo "ID do usuário logado não encontrado na sessão.";
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
