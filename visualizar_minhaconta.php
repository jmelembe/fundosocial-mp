<?php
session_start(); // Iniciar a sessão

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirecionar para a página de login se não estiver logado
    exit();
}
?>
<?php
include("./conexao.php");

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
<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Justino Melembe" />
    <title>Sistema de Gestão do Fundo Social</title>
    <link rel="stylesheet" href="./style/estiloreg.css" />
    <link rel="stylesheet"  href="path/to/font-awesome/css/font-awesome.min.css" />
    <style>
      .button {
display: inline-block;
padding: 10px 25px;
font-size: 12px;
cursor: pointer;
text-align: center;
text-decoration: none;
outline: none;
color: #fff;
background-color: #ea1414;
border: none;
border-radius: 15px;
box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
background-color: #ea1414;
box-shadow: 0 5px #666;
transform: translateY(4px);
}
.button{
position:-ms-page;
top: 0;
right: 120;
}

    </style>
  </head>
  <body>
    <div class="logo">
      <img src="./image/logofs1.jpg" alt="">
  </div>
  <h2>Minha Conta</h2> 
   <form action="#" method="POST">
      <div class="input">
        <hr />
        <label for="nome"><b>Nome:</b></label>
        <input type="text" id="nome" name="nome" value="<?php echo $row['nome'] ?>" readonly/>
       
        <label for="pagamento"><b>Pagamento:</b></label>
        <input type="text" id="pagamento" name="pagamento" value="<?php echo number_format(ceil($row['pagamento']), 2) . ' MZN' ?>" readonly/>

        <label for="esperado"><b>Esperado:</b></label>
        <input type="text" id="esperado" name="esperado" value="<?php echo number_format(ceil($row['esperado']), 2) . ' MZN' ?>" readonly/>

        <label for="receber_membro"><b>Valor a Receber-Membro:</b></label>
        <input type="text" id="receber_membro" name="receber_membro" value="<?php echo number_format(ceil($row['pagamento'] * 16.666666), 2) . ' MZN' ?>" readonly/>

        <label for="receber_terceiros"><b>Valor a Receber-Dependentes:</b></label>
        <input type="text" id="receber_terceiros" name="receber_terceiros" value="<?php echo number_format(ceil($row['pagamento'] * 8.33333333), 2) . ' MZN' ?>" readonly/>
        <hr />
      </div>
    </form>
    <a href="dashboard__membro.php" class="button">Voltar</a>
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
</html>
