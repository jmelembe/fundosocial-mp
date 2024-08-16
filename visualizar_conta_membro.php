<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão do Fundo Social</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./style/estiloreg.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        h1 {
            text-align: left;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #saldo-value {
            color: red;
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }

        .btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="./image/logofs1.jpg" alt="">
    </div>

    <h1>Relatório dos Detalhes da Conta</h1><br>

    <?php
    include("./conexao.php");

    $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dez");

    // Iniciar a sessão
    session_start();

    // Verificar se os valores estão nos cookies e, se não, inicializá-los
    if (!isset($_SESSION['retiradas'])) {
        if (isset($_COOKIE['retiradas'])) {
            $_SESSION['retiradas'] = json_decode($_COOKIE['retiradas'], true);
        } else {
            $_SESSION['retiradas'] = array_fill_keys($meses, 0);
        }
    }

    if (!isset($_SESSION['taxas'])) {
        if (isset($_COOKIE['taxas'])) {
            $_SESSION['taxas'] = json_decode($_COOKIE['taxas'], true);
        } else {
            $_SESSION['taxas'] = array_fill_keys($meses, 0);
        }
    }

    $sql =  "SELECT m.id, c.id, m.username, c.Jan, c.Fev, c.Mar, c.Abr, c.Mai, c.Jun, c.Jul, c.Ago, c.Sept, c.Oct, c.Nov, c.Dez FROM usuarios m INNER JOIN contribuicoes c ON m.id = c.id";
    $result = $conn->query($sql);

    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $totalSum = array("Jan" => 0, "Fev" => 0, "Mar" => 0, "Abr" => 0, "Mai" => 0, "Jun" => 0, "Jul" => 0, "Ago" => 0, "Sept" => 0, "Oct" => 0, "Nov" => 0, "Dez" => 0);

        foreach ($data as $row) {
            for ($i = 0; $i < 12; $i++) {
                $totalSum[$meses[$i]] += intval($row[$meses[$i]], 10);
            }
        }

        echo '<table border="1">';
        echo '<thead>';
        echo '<tr>';
        echo '<th></th>';
        for ($i = 0; $i < 12; $i++) {
            echo '<th>' . $meses[$i] . '</th>';
        }
        echo '<th>Total</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        echo '<tr><td>Contribuições</td>';
        for ($i = 0; $i < 12; $i++) {
            echo '<td>' . number_format($totalSum[$meses[$i]], 2, ',', '.') . '</td>';
        }
        echo '<td>' . number_format(array_sum($totalSum), 2, ',', '.') . '</td></tr>';

        echo '<tr><td>Retiradas</td>';
        for ($i = 0; $i < 12; $i++) {
            echo '<td>' . number_format($_SESSION['retiradas'][$meses[$i]], 2, ',', '.') . '</td>';
        }
        echo '<td>' . number_format(array_sum($_SESSION['retiradas']), 2, ',', '.') . '</td></tr>';

        echo '<tr><td>Taxas Bancárias</td>';
        for ($i = 0; $i < 12; $i++) {
            echo '<td>' . number_format($_SESSION['taxas'][$meses[$i]], 2, ',', '.') . '</td>';
        }
        echo '<td>' . number_format(array_sum($_SESSION['taxas']), 2, ',', '.') . '</td></tr>';

        echo '<tr><td>Saldo</td>';
        for ($i = 0; $i < 12; $i++) {
            $saldo = $totalSum[$meses[$i]] + $_SESSION['retiradas'][$meses[$i]] + $_SESSION['taxas'][$meses[$i]]; // Calcula o saldo
            echo '<td>' . number_format($saldo, 2, ',', '.') . '</td>';
        }
        echo '<td>' . number_format((array_sum($totalSum) + array_sum($_SESSION['retiradas']) + array_sum($_SESSION['taxas'])), 2, ',', '.') . '</td></tr>';

        echo '</tbody>';
        echo '</table>';

        // Adiciona espaçamento entre as tabelas
        echo '<br>';

        // Segunda Tabela para o Total do Saldo
        echo '<table border="2" id="saldo-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th> Saldo Bancário - BCI</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $totalSaldo = array_sum($totalSum) + array_sum($_SESSION['retiradas']) + array_sum($_SESSION['taxas']);

        // Aplica estilo para o texto piscante
        echo '<tr>';
        echo '<td id="saldo-value">' . number_format($totalSaldo, 2, ',', '.') . 'MZM</td>';
        echo '</tr>';

        echo '</tbody>';
        echo '</table>';
    } else {
        // Tratar caso a consulta falhe
        echo "Erro na consulta SQL: " . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
    ?>
    <a href="dashboard__membro.php" class="button">Voltar</a>
</body>

</html>
