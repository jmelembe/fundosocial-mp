<?php
session_start();

// Configurações de conexão com o banco de dados
include("./conexao.php");

// Verifica se o usuário está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

// Consulta SQL para obter os pagamentos mensais agrupados por mês
$sqlPagamentosMensais = "SELECT MONTH(Jan) AS mes, SUM(valor) AS total_pagamentos FROM contribuicoes GROUP BY MONTH(data_pagamento)";
$resultPagamentosMensais = $conn->query($sqlPagamentosMensais);

// Verifica se a consulta foi bem-sucedida
if ($resultPagamentosMensais) {
    // Array para armazenar os dados dos pagamentos por mês
    $pagamentosPorMes = array_fill(1, 12, 0); // Inicializa um array com zeros para cada mês do ano

    // Preenche o array com os valores retornados da consulta
    while ($row = $resultPagamentosMensais->fetch_assoc()) {
        $mes = $row['mes'];
        $totalPagamentos = $row['total_pagamentos'];
        $pagamentosPorMes[$mes] = $totalPagamentos;
    }
} else {
    // Trate erros de consulta, se necessário
    echo "Erro na consulta: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en-pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Gestão do Fundo Social - Gráficos</title>
    <!-- Inclua os links para os arquivos CSS e JS do Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        h1 {
            color: blue;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
</head>

<body>
    <div class="logo">
        <img src="./image/logon.png" width="120px" alt="" />
    </div>
    <div class="container">

        <h1>Gráfico de Pagamentos Mensais</h1>

        <div id="barChartPagamentosMensais" style="width: 100%; height: 400px;"></div>

        <script type="text/javascript">
            google.charts.load('current', {
                packages: ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Mês');
                data.addColumn('number', 'Valor dos Pagamentos');

                data.addRows([
                    ['Jan', <?php echo $pagamentosPorMes[1]; ?>],
                    ['Fev', <?php echo $pagamentosPorMes[2]; ?>],
                    ['Mar', <?php echo $pagamentosPorMes[3]; ?>],
                    ['Abr', <?php echo $pagamentosPorMes[4]; ?>],
                    ['Mai', <?php echo $pagamentosPorMes[5]; ?>],
                    ['Jun', <?php echo $pagamentosPorMes[6]; ?>],
                    ['Jul', <?php echo $pagamentosPorMes[7]; ?>],
                    ['Ago', <?php echo $pagamentosPorMes[8]; ?>],
                    ['Set', <?php echo $pagamentosPorMes[9]; ?>],
                    ['Out', <?php echo $pagamentosPorMes[10]; ?>],
                    ['Nov', <?php echo $pagamentosPorMes[11]; ?>],
                    ['Dez', <?php echo $pagamentosPorMes[12]; ?>],
                ]);

                var options = {
                    title: 'Pagamentos Mensais',
                    legend: {
                        position: 'none'
                    },
                    chart: {
                        title: 'Pagamentos Mensais',
                    },
                    bars: 'vertical',
                    axes: {
                        x: {
                            0: {
                                side: 'bottom',
                                label: 'Mês'
                            }
                        },
                        y: {
                            0: {
                                side: 'left',
                                label: 'Valor'
                            }
                        }
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('barChartPagamentosMensais'));
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>

        <div class="container">
            <a href="dashboard.php" class="btn btn-warning"><i class="fas fa-sign-out-alt"></i> Voltar</a>
        </div>
    </div>
</body>

</html>
