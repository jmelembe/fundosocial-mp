<!DOCTYPE html>
<html lang="en-pt">

<head>
    <meta charset="utf-8">
    <title>Sistema de Gestão de Academia</title>
    <!-- Inclua os links para os arquivos CSS e JS do Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/estilo.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
</head>

<body>
    <div class="logo">
        <img src="/image/logon.png" alt="" />
    </div>
    <div class="container">
        <h1>Gestão de Treinos</h1>
        <a href="adicionar_treinos.php" class="btn btn-primary">Adicionar Treinos</a>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Domingo</th>
                    <th>2@ Feira</th>
                    <th>3@ Feira</th>
                    <th>4@ Feira</th>
                    <th>5@ Feira</th>
                    <th>6@ Feira</th>
                    <th>Sábado</th>
                    <th>Data Inicio</th>
                    <th>Data Final</th>
                    <th>Acções</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir membros (substitua com seu próprio código PHP) -->
                <?php
                // Conectar ao banco de dados
                include("./conexao.php");

                // Consulta SQL para selecionar todos os membros
                $sql = "SELECT * FROM treinos";
              //  $sql = "SELECT t.id, m.nome, t.domingo, t.sfeira, t.tfeira, t.qafeira, t.qifeira, t.sefeira, t.sabado, t.data_inicio, t.data_final 
              //    FROM treinos t
            //        INNER JOIN membros m ON t.membro_id = m.id";
                $result = $conn->query($sql);

                //    $membros = recuperarMembros();

                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['domingo'] ?></td>
                        <td><?php echo $row['sfeira'] ?></td>
                        <td><?php echo $row['tfeira'] ?></td>
                        <td><?php echo $row['qafeira'] ?></td>
                        <td><?php echo $row['qifeira'] ?></td>
                        <td><?php echo $row['sefeira'] ?></td>
                        <td><?php echo $row['sabado'] ?></td>
                        <td><?php echo $row['data_inicio'] ?></td>
                        <td><?php echo $row['data_final'] ?></td>
                        <td>
                            <a href="editar_treinos.php?id= <?php echo $row['id'] ?>" class="btn btn-warning">Editar<i class="fas fa-pen"></i></a>
                            <a href="apagar_treinos.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Apagar<i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>

        <!-- Adicione o código do formulário de adição/atualização de membros aqui -->
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
<div class="container">
    <a href="dashboard.php" class="btn btn-primary">Voltar</a>
</div>

</html>