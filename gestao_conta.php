<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão do Fundo Social</title>
    <!-- Inclua os links para os arquivos CSS e JS do Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/estilo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-7GBUmFqnC5hDb8F4pb5Zx8a9vw4CIzGALkv7XtPLfkON2dUxh83g8XqkFX2k1QOBkE5h+7RdZKbUj+LTH78Zwe9A==" crossorigin="anonymous" />
    <style>
        table {
            width: 300%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        input.editable {
            width: 60px;
            /* Ajuste o tamanho conforme necessário */
            text-align: center;
            margin-bottom: 5px;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="./image/logofs1.jpg" alt="">
    </div><br>
    <div class="container">
        <h2>Gestão da Conta</h2>

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
        <form method="post" action="" onsubmit="return confirm('Tem certeza de que deseja calcular e atualizar os dados?');">
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
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
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    session_start(); // Iniciar a sessão

                    include("./conexao.php");

                    $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dez");

                    // Verificar se os valores estão na sessão e, se não, inicializá-los
                    if (!isset($_SESSION['retiradas'])) {
                        $_SESSION['retiradas'] = array_fill_keys($meses, 0);
                    }

                    if (!isset($_SESSION['taxas'])) {
                        $_SESSION['taxas'] = array_fill_keys($meses, 0);
                    }

                    // Verificar se foram enviados dados do formulário e atualizar os valores de retiradas e taxas
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Verificar a senha antes de processar as atualizações
                        $senha_correta = "8650"; // Defina sua senha aqui
                        if (isset($_POST['senha']) && $_POST['senha'] === $senha_correta) {
                            foreach ($meses as $mes) {
                                $_SESSION['retiradas'][$mes] = isset($_POST['retiradas'][$mes]) ? intval($_POST['retiradas'][$mes]) : 0;
                                $_SESSION['taxas'][$mes] = isset($_POST['taxas'][$mes]) ? intval($_POST['taxas'][$mes]) : 0;
                            }
                            setcookie('retiradas', json_encode($_SESSION['retiradas']), time() + (86400 * 30), "/"); // 86400 = 1 dia
                            setcookie('taxas', json_encode($_SESSION['taxas']), time() + (86400 * 30), "/"); // 86400 = 1 dia
                        } else {
                            // Senha incorreta
                            echo '<div class="alert alert-danger" role="alert">Senha incorreta!</div>';
                        }
                    } elseif (isset($_COOKIE['retiradas']) && isset($_COOKIE['taxas'])) {
                        // Se os cookies existem, carregue os valores dos cookies
                        $_SESSION['retiradas'] = json_decode($_COOKIE['retiradas'], true);
                        $_SESSION['taxas'] = json_decode($_COOKIE['taxas'], true);
                    }

                    //consulta mysql

                    $sql =  "SELECT m.id, c.id, m.username, c.Jan, c.Fev, c.Mar, c.Abr, c.Mai, c.Jun, c.Jul, c.Ago, c.Sept, c.Oct, c.Nov, c.Dez FROM usuarios m INNER JOIN contribuicoes c ON m.id = c.id";
                    $result = $conn->query($sql);

                    if ($result) {
                        $data = $result->fetch_all(MYSQLI_ASSOC);
                        $totalSum = array_fill_keys($meses, 0);

                        foreach ($data as $row) {
                            foreach ($meses as $mes) {
                                $totalSum[$mes] += intval($row[$mes], 10);
                            }
                        }

                        echo '<tr><td>Contribuições</td>';
                        foreach ($meses as $mes) {
                            echo '<td>' . $totalSum[$mes] . '</td>';
                        }
                        echo '<td>' . array_sum($totalSum) . '</td></tr>';

                        echo '<tr><td>Retiradas</td>';
                        foreach ($meses as $mes) {
                            echo '<td><input class="editable" type="number" value="' . $_SESSION['retiradas'][$mes] . '" name="retiradas[' . $mes . ']" /></td>';
                        }
                        echo '<td>' . array_sum($_SESSION['retiradas']) . '</td></tr>';

                        echo '<tr><td>Taxas Bancárias</td>';
                        foreach ($meses as $mes) {
                            echo '<td><input class="editable" type="number" value="' . $_SESSION['taxas'][$mes] . '" name="taxas[' . $mes . ']" /></td>';
                        }
                        echo '<td>' . array_sum($_SESSION['taxas']) . '</td></tr>';

                        echo '<tr><td>Saldo</td>';
                        foreach ($meses as $mes) {
                            $saldo = $totalSum[$mes] + $_SESSION['retiradas'][$mes] + $_SESSION['taxas'][$mes]; // Calcula o saldo
                            echo '<td>' . $saldo . '</td>';
                        }
                        echo '<td>' . (array_sum($totalSum) + array_sum($_SESSION['retiradas']) + array_sum($_SESSION['taxas'])) . '</td></tr>';
                    } else {
                        // Tratar caso a consulta falhe
                        echo "Erro na consulta SQL: " . $conn->error;
                    }

                    // Fechar a conexão
                    $conn->close();
                    ?>

                </tbody>
            </table>

            <div class="container">
                <button class="btn btn-primary" type="submit">Calcular e Atualizar</button>
                <a href="dashboard.php" class="btn btn-danger">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>