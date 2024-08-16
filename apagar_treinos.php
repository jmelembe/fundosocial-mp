
<?php

include("./conexao.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Excluir membro
    $sql = "DELETE FROM treinos WHERE id=$id";
    $stmt = $conn->prepare($sql);
    //$stmt->bind_param("id",$id);
    $stmt->execute();
    $result = $stmt = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: gestao_treinos.php?msg= Registro apagado com Sucesso!");
    } else {
        echo "falha ao apagar" . mysqli_error($conn);
    }
    $stmt->close();
    $conn->close();
}
?>