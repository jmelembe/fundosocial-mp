<!DOCTYPE html>
<html lang="en-pt">

<head>
    <meta charset="utf-8">
    <title>Sistema de Gestão do Fundo Social</title>
    <!-- Inclua os links para os arquivos CSS e JS do Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/estilo.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha384-rw6ycjb80r6I3OqFVM0Yziz/EO4tAHR0e2Hx5l5Py1t3KZJFl4anVgG2rOVjyIkV" crossorigin="anonymous">
</head>

<body>
    <div class="logo">
        <img src="/image/logofs1.jpg" alt="" />
    </div>
    <div class="container">
        <h1>Gestão de Membros</h1>
       
        <div class="topnav">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Pesquisar...">
        </div>
        <?php
        // Se houver uma mensagem na URL, exibe um alerta
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
                    <th>Nome</th>
                    <th>Genero</th>
                    <th>Contacto</th>
                    <th>Nivel Acesso</th>
                    <th>Data de Ingresso</th>
                    <th>Acções</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir membros (substitua com seu próprio código PHP) -->
                <?php
                // Conectar ao banco de dados
                include("./conexao.php");

                // Consulta SQL para selecionar todos os membros
                $sql = "SELECT * FROM usuarios";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['nome'] ?></td>
                        <td><?php echo $row['genero'] ?></td>
                        <td><?php echo $row['contacto'] ?></td>
                        <td><?php echo $row['nivel_acesso'] ?></td>
                        <td><?php echo $row['data_ingresso'] ?></td>
                        <td>
                            <a href="adicionar_transacao.php?id=<?php echo $row['id'] ?>" class="btn btn-info"><i class="fas fa-info"></i> Transação</a>
                            <a href="adicionar_treinos.php?id=<?php echo $row['id'] ?>" class="btn btn-info"><i class="fas fa-info"></i> Notas</a>
                            <a href="editar_membro.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fas fa-pen"></i> Editar</a>
                            <a href="apagar_membro.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Apagar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>

        <!-- Adicione o código do formulário de adição/atualização de membros aqui -->
    </div>
    <div class="container">
        <a href="dashboard.php" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i>Voltar</a>
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
