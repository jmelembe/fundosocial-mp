<?php
session_start();
ob_start();
include_once 'conexao.php';

// Verifica se o usuário não está logado
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    $_SESSION['msg'] = "<p style='color:#ff0000'>Erro: Necessário fazer login para acessar a página!</p>";
    header("Location: index.html?msg=precisas+estar+logado!");
    exit(); // Certifique-se de parar a execução após o redirecionamento
}else{
    
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Justino Melembe" />
    <title>Sistema de Gestão do Fundo Social</title>
    <link rel="stylesheet" href="./style/estiloreg.css" />
    <!-- Certifique-se de ajustar o caminho do Font Awesome conforme necessário -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 2px solid rgb(140, 140, 140);
            padding: 8px;
            text-align: left;
        }

        /* Estilo para o campo de upload */
        form {
            margin-top: 20px;
            border: 2px solid rgb(140, 140, 140);
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="./image/logofs1.jpg" width="90px" alt="" />
    </div>
    <h2>Documentos Importantes</h2>

    <?php
    if (isset($_POST['submit'])) {
        // Formulário enviado
        $arquivo = $_FILES['file'];
        $arquivoNovo = explode('.', $arquivo['name']);

        if ($arquivoNovo[sizeof($arquivoNovo) - 1] !== 'pdf') {
            die('Formato não permitido, selecione PDF');
        } else {
            echo 'Upload feito com sucesso!';
            $caminho = 'uploads/';
            $caminhoCompleto = $caminho . $arquivo['name'];

            // Mover o arquivo para a pasta de uploads
            move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto);

            // Dar permissões adequadas ao arquivo
            chmod($caminhoCompleto, 0644);
        }
    }
    ?>

    <!-- Adiciona o formulário de upload -->
  
    <!-- Adiciona a tabela para exibir documentos -->
    <table>
        <thead>
            <tr>
                <th>Nome do Documento</th>
                <th>Acções</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Lógica para listar documentos e gerar links de download
            $caminho = 'uploads/';
            $documentos = scandir($caminho);

            foreach ($documentos as $documento) {
                // Exclui os diretórios '.' e '..'
                if ($documento != '.' && $documento != '..') {
                    echo "<tr>";
                    echo "<td>$documento</td>";
                    echo "<td><a href='uploads/$documento' target='_blank'>Visualizar</a> | <a href='?download=$documento'>Download</a></td>";
                    echo "</tr>";
                }
            }

            // Lógica para o download
            if (isset($_GET['download'])) {
                $documento = $_GET['download'];
                $caminho = 'uploads/' . $documento;

                if (file_exists($caminho)) {
                    // Configurações do cabeçalho para forçar o download
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($caminho) . '"');
                    header('Content-Length: ' . filesize($caminho));

                    // Envia o arquivo para o navegador
                    readfile($caminho);

                    exit;
                } else {
                    die('Arquivo não encontrado.');
                }
            }
            ?>
        </tbody>
    </table>

    <a href="dashboard__membro.php" class="btn info">Voltar</a>
</body>

</html>
