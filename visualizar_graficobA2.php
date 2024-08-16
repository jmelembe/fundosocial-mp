<?php
session_start(); // Iniciar a sessão

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirecionar para a página de login se não estiver logado
    exit();
}
// Configurações de conexão com o banco de dados
include("./conexao.php");

// Consulta SQL para contar o número de membros
$sqlMembros = "SELECT COUNT(*) as quantidade_membros FROM usuarios";
$resultMembros = $conn->query($sqlMembros);

// Consulta SQL para contar o número de transacoes
$sqlTransacoes = "SELECT COUNT(*) as quantidade_transacoes FROM contribuicoes";
$resultTransacoes = $conn->query($sqlTransacoes);

// Consulta SQL para contar o número de pagamentos mensais
$sqlPagamentosMensais = "SELECT COUNT(*) as quantidade_pagamentos FROM contribuicoes";
$resultPagamentosMensais = $conn->query($sqlPagamentosMensais);

// Verifica se as consultas foram bem-sucedidas
if ($resultMembros && $resultTransacoes && $resultPagamentosMensais) {
    $rowMembros = $resultMembros->fetch_assoc();
    $quantidadeMembros = $rowMembros['quantidade_membros'];

    $rowTransacoes = $resultTransacoes->fetch_assoc();
    $quantidadeTransacoes = $rowTransacoes['quantidade_transacoes'];

    $rowPagamentosMensais = $resultPagamentosMensais->fetch_assoc();
    $quantidadePagamentosMensais = $rowPagamentosMensais['quantidade_pagamentos'];
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha384-rw6ycjb80r6I3OqFVM0Yziz/EO4tAHR0e2Hx5l5Py1t3KZJFl4anVgG2rOVjyIkV"
        crossorigin="anonymous">
</head>
<!-- ... Seu código HTML anterior ... -->

<body>
    <div class="logo">
        <img src="./image/logon.png" width="120px" alt="" />
    </div>
    <div class="container">

        <h1>Gráficos Barras</h1>
        <a href="visualizar_graficocA2.php" class="btn btn-secondary">Grafico Circular</a>
        <div class="row">
            <!-- Gráfico para membros -->
            <div class="col-md-4">
                <div id="doughnutChartMembros" style="width: 100%; height: 400px;"></div>
            </div>

            <!-- Gráfico para transacoes -->
            <div class="col-md-4">
                <div id="doughnutChartTransacoes" style="width: 100%; height: 400px;"></div>
            </div>

            <!-- Gráfico para pagamentos mensais -->
            <div class="col-md-4">
                <div id="doughnutChartPagamentosMensais" style="width: 100%; height: 400px;"></div>
            </div>
        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                // Função auxiliar para adicionar rótulos de porcentagem no topo dos setores
                function addPercentLabels(data) {
                    var numRows = data.getNumberOfRows();
                    var formatter = new google.visualization.NumberFormat({
                        suffix: '%',
                        fractionDigits: 0
                    });

                    for (var i = 0; i < numRows; i++) {
                        var value = data.getValue(i, 1);
                        var label = formatter.formatValue(value);
                        data.setFormattedValue(i, 1, label);
                    }
                }

                // Dados de exemplo para o gráfico de membros
                var dataMembros = google.visualization.arrayToDataTable([
                    ["Element", "Density", {
                        role: "style"
                    }],
                    ["Membros", <?php echo $quantidadeMembros; ?>, "rgba(11, 192, 192, 0.6)"],
                    ["Restante", 100 - <?php echo $quantidadeMembros; ?>, "rgba(255, 255, 255, 0.2)"]
                ]);

                addPercentLabels(dataMembros);

                // Dados de exemplo para o gráfico de transacoes
                var dataTransacoes = google.visualization.arrayToDataTable([
                    ["Element", "Density", {
                        role: "style"
                    }],
                    ["Transações", <?php echo $quantidadeTransacoes; ?>, "rgba(255, 99, 132, 0.6)"],
                    ["Restante", 100 - <?php echo $quantidadeTransacoes; ?>, "rgba(255, 255, 255, 0.2)"]
                ]);

                addPercentLabels(dataTransacoes);

                // Dados de exemplo para o gráfico de pagamentos mensais
                var dataPagamentosMensais = google.visualization.arrayToDataTable([
                    ["Element", "Density", {
                        role: "style"
                    }],
                    ["Pagamentos Mensais", <?php echo $quantidadePagamentosMensais; ?>, "rgba(54, 162, 235, 0.6)"],
                    ["Restante", 100 - <?php echo $quantidadePagamentosMensais; ?>, "rgba(255, 255, 255, 0.2)"]
                ]);

                addPercentLabels(dataPagamentosMensais);

                // Opções dos gráficos
                var options = {
                    width: 370,
                    height: 400,
                    bar: {
                        groupWidth: "65%"
                    },
                };

                // Configuração do gráfico de membros
                var chartMembros = new google.visualization.ColumnChart(document.getElementById("doughnutChartMembros"));
                chartMembros.draw(dataMembros, Object.assign({}, options, {
                    title: 'Dados dos Membros'
                }));

                // Configuração do gráfico de transacoes
                var chartTransacoes = new google.visualization.ColumnChart(document.getElementById("doughnutChartTransacoes"));
                chartTransacoes.draw(dataTransacoes, Object.assign({}, options, {
                    title: 'Dados das Transações'
                }));

                // Configuração do gráfico de pagamentos mensais
                var chartPagamentosMensais = new google.visualization.ColumnChart(document.getElementById("doughnutChartPagamentosMensais"));
                chartPagamentosMensais.draw(dataPagamentosMensais, Object.assign({}, options, {
                    title: 'Dados dos Pagamentos Mensais'
                }));
            }
        </script>

        <div class="container">
            <a href="dashboardA2.php" class="btn btn-warning"><i class="fas fa-sign-out-alt"></i> Voltar</a>
        </div>
    </div>
</body>

</html>
