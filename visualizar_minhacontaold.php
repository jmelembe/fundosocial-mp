<!DOCTYPE html>
<html lang="en-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão do Fundo Soacial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./style/estilorel.css">
    
</head>

<body>
    <div class="logo">
        <img src="./image/logon.png" alt="">
    </div>

    <h1>Minha Conta</h1> <button class="btn"><a href="dashboard.html" class="fa fa-close"> </a> Voltar</button>

    <div class="topnav">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Pesquisar...">
    </div>

    <?php
    include("./conexao.php");
   
    // Consulta SQL para buscar dados na tabela
    $sql =  "SELECT m.id, c.id, m.username, c.Jan, c.Jan, c.Jan,c.Jan  FROM usuarios m INNER JOIN contribuicoes c ON m.id = c.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        echo  "<table border='2'>
                    <tr>
                        <th>ID</th> <br>
                        <th>Nome</th><br>
                        <th>Valor de Contribuicao</th><br><br>
                        <th> Valor a Receber-Membro</th>
                        <th> Valor a Receber-Terceiros</th>
                    </tr>";

        // Exibe os dados da tabela
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["Jan"] . "</td>
                        <td>" . $row["Jan"] . "</td>
                        <td>" . $row["Jan"] . "</td>
                    </tr>";
        }
       
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
