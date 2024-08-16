<!DOCTYPE html>
<html lang="en-pt">

<head>
    <meta charset="utf-8">
    <title>Sistema de Gestão do Fundo Social</title>
    <!-- Inclua os links para os arquivos CSS e JS do Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/estilo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-7GBUmFqnC5hDb8F4pb5Zx8a9vw4CIzGALkv7XtPLfkON2dUxh83g8XqkFX2k1QOBkE5h+7RdZKbUj+LTH78Zwe9A=="
        crossorigin="anonymous" />
</head>

<body>
    <div class="logo">
        <img src="/image/logofs1.jpg" alt="" />
    </div>
    <div class="container">
        <h1>Gestão de Transações</h1>
        <div class="topnav">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Pesquisar...">
        </div>
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="close btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        ?>

<div class="logo">
        <img src="/image/logofs1.jpg" alt="" />
    </div>
        <table class="table table-striped">
            <thead>
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
                    <th>Sept</th>
                    <th>Out</th>
                    <th>Nov</th>
                    <th>Dez</th>
                    <th>Acções</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir membros (substitua com seu próprio código PHP) -->
                <?php
                include("./conexao.php");

                //$sql = "SELECT * FROM contribuicoes";
                $sql =  "SELECT m.id, c.id, m.username, c.Jan, c.Fev, c.Mar,c.Abr,c.Mai, c.Jun , c.Jul, c.Ago, c.Sept,
                         c.Oct, c.Nov, c.Dez FROM usuarios m INNER JOIN contribuicoes c ON m.id = c.id";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo isset($row['id']) ? htmlspecialchars($row['id']) : ""; ?></td>
                        <td><?php echo isset($row['username']) ? htmlspecialchars($row['username']) : ""; ?></td>
                        <td><?php echo isset($row['Jan']) ? intval($row['Jan']) : ""; ?></td>
                        <td><?php echo isset($row['Fev']) ? intval($row['Fev']) : ""; ?></td>
                        <td><?php echo isset($row['Mar']) ? intval($row['Mar']) : ""; ?></td>
                        <td><?php echo isset($row['Abr']) ? intval($row['Abr']) : ""; ?></td>
                        <td><?php echo isset($row['Mai']) ? intval($row['Mai']) : ""; ?></td>
                        <td><?php echo isset($row['Jun']) ? intval($row['Jun']) : ""; ?></td>
                        <td><?php echo isset($row['Jul']) ? intval($row['Jul']) : ""; ?></td>
                        <td><?php echo isset($row['Ago']) ? intval($row['Ago']) : ""; ?></td>
                        <td><?php echo isset($row['Sept']) ? intval($row['Sept']) : ""; ?></td>
                        <td><?php echo isset($row['Oct']) ? intval($row['Oct']) : ""; ?></td>
                        <td><?php echo isset($row['Nov']) ? intval($row['Nov']) : ""; ?></td>
                        <td><?php echo isset($row['Dez']) ? intval($row['Dez']) : ""; ?></td>

                        <td>
                            <a href="editar_transacaoA2.php?id=<?php echo isset($row['id']) ? htmlspecialchars($row['id']) : ""; ?>" class="btn btn-warning">
                                Editar <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <a href="dashboardA2.php" class="btn btn-primary">Voltar</a>
    </div>
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
