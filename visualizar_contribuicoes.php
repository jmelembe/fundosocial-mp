<!DOCTYPE html>
<html lang="en-pt">

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
            background-color: #f1f1f1;
        }

        .header {
            background-color: #333;
            padding: 15px;
            text-align: center;
            color: white;
        }

        .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #ddd;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        }

        .btn {
            padding: 10px;
            background-color: #ea1414;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn a {
            color: white;
            text-decoration: none;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .topnav {
            background-color: greenyellow;
            overflow: hidden;
            position: sticky;
            top: 0;
            padding: 10px;
        }

        .topnav input {
            padding: 8px;
            margin: 5px;
            width: 200px;
        }

        table {
            width: 100%;
            border-collapse: ;
            margin-top: 0px;
            /* Ajuste aqui para a distância desejada */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>

</head>

<body>
    <div class="logo">
        <img src="./image/logofs1.jpg" alt=""><button class="btn"><a href="dashboard.php" class="fa fa-close"> </a>Voltar</button>
    </div>


    <h1>Relatório das Contribuições</h1>

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
                echo "<td>" . $row[$month] . "</td>";
                $total += $row[$month];
                $paidTotal += $row[$month];
            }

            $totalPaid += $paidTotal;

            // Exibe os totais da linha
            echo "<td>$paidTotal</td>";
            echo "<td>" . ($paidTotal - 1200) . "</td>";
            echo "</tr>";
        }

        // Exibe os totais no final da tabela
        echo "<tr>
                <td colspan='2'>Total</td>";
        foreach ($totals as $total) {
            echo "<td>$total</td>";
        }
        echo "<td>$totalPaid</td>";
        echo "<td>" . (count($totals) * 1200 - $totalPaid) . "</td></tr>";
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