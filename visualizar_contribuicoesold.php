<!DOCTYPE html>
<html lang="en-pt">

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

    <h1>Relatório das Contribuições</h1> <button class="btn"><a href="dashboard.php" class="fa fa-close"> </a></button>

    <div class="topnav">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Pesquisar...">
    </div>

    <?php
    include("./conexao.php");

    // Consulta SQL para buscar dados na tabela
    $sql =  "SELECT m.id, c.id, m.username, c.Jan, c.Fev, c.Mar,c.Abr,c.Mai, c.Jun , c.Jul, c.Ago, c.Sept,
     c.Oct, c.Nov, c.Dez FROM usuarios m INNER JOIN contribuicoes c ON m.id = c.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo  "<table border='2'>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Jan</th>
                        <th>Fev</th>
                        <th>Mar</th>
                        <th>Abr</th>
                        <th>Mai</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Ago</th>
                        <th>Set</th>
                        <th>Out</th>
                        <th>Nov</th>
                        <th>Dez</th>
                        <th>Pago</th>
                        <th>Esperado</th>
                    </tr>";

        $totals = array_fill_keys(['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Sept', 'Oct', 'Nov', 'Dez'], 0);
        $totalPaid = 0;

        // Exibe os dados da tabela
        while ($row = $result->fetch_assoc()) {
            $paidTotal = 0;

            echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["username"] . "</td>";

            // Exibe os valores de cada mês
            foreach ($totals as $month => &$total) {
                echo "<td>" . number_format($row[$month], 2, ',', '.') . "</td>";
                $total += $row[$month];
                $paidTotal += $row[$month];
            }
            

            $totalPaid += $paidTotal;

            // Exibe os totais da linha
            echo "<td>" . number_format($paidTotal, 2, ',', '.') . "</td>";
            echo "<td>" . number_format((1200 - $paidTotal), 2, ',', '.') . "</td>";
            echo "</tr>";
        }

        // Exibe os totais no final da tabela
        echo "<tr>
                <td colspan='2'>Total</td>";
        foreach ($totals as $total) {
            echo "<td>" . number_format($total, 2, ',', '.') . "</td>";
        }
        echo "<td>" . number_format($totalPaid, 2, ',', '.') . "</td>";
        echo "<td>" . number_format((count($totals) * 1200 - $totalPaid), 2, ',', '.') . "</td></tr>";
    } else {
        echo "Nenhum resultado encontrado.";
    }
    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>
    <script>
        // Função para filtrar a tabela
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Coluna do nome
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>
