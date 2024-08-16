<?php

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirecionar para a página de login se não estiver logado
    exit();
}

// Função para registrar atividade
function registrarAtividade($acao) {
    // Abrir ou criar arquivo de log
    $logFile = fopen("log.txt", "a");

    // Obter informações relevantes
    date_default_timezone_set('Africa/Maputo');
    $data = date('Y-m-d');
    $hora = date('H:i:s');
    $nomeUsuario = $_SESSION['username'];
    $pagina = $_SERVER['REQUEST_URI'];
    $enderecoIP = $_SERVER['REMOTE_ADDR']; // Obtém o endereço IP do cliente

    // Escrever no arquivo de log
    fwrite($logFile, "$data, $hora, $nomeUsuario, $acao,  $pagina, $enderecoIP\n");

    // Fechar o arquivo de log
    fclose($logFile);
}

// Registrar a atividade de login
registrarAtividade("login");

// Se o usuário clicar em Logout, registrar a atividade de logout
if (isset($_GET['logout'])) {
    // Registrar a atividade de logout
    registrarAtividade("logout");

    // Redirecionar para a página de login
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Justino Melembe" />
    <title>Sistema de Gestão do Fundo Social</title>
    <link rel="stylesheet" href="./style/estilo.css" />
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
      left: 120;
      }
    </style>
</head>

<body>
<div class="logo">
      <img src="./image/logofs1.jpg" alt="">
  </div><br>
    <div class="container">
        <h2>Relatório de Utilização do Sistema</h2>  <a href="dashboard.php" class="button">Voltar</a><br><br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Usuário</th>
                    <th>Acção</th>
                    <th>Página</th>
                    <th>Endereco</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ler e exibir o conteúdo do arquivo de log
                $logContent = file("log.txt");
                foreach ($logContent as $logLine) {
                    $logData = explode(", ", $logLine);
                    echo "<tr>";
                    foreach ($logData as $logItem) {
                        echo "<td>$logItem</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
