<?php
include("./conexao.php");

if (isset($_POST["submitForm"])) {
  //($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obter dados do formulário
  $id = $_POST["id"];
  $domingo = $_POST["domingo"];
  $sfeira = $_POST["sfeira"];
  $tfeira = $_POST["tfeira"];
  $qafeira = $_POST["qafeira"];
  $qifeira = $_POST["qifeira"];
  $sefeira = $_POST["sefeira"];
  $sabado = $_POST["sabado"];
  $data_inicio = $_POST["data_inicio"];
  $data_final = $_POST["data_final"];

  //$sql = "INSERT INTO treinos (id, domingo, sfeira, tfeira, qafeira, qifeira,sefeira, sabado, data_inicio, data_final) VALUES 
  // ($id, $domingo, $sfeira, $tfeira, $qafeira, $qifeira, $sefeira, $sabado, $data_inicio, $data_final)";

  $sql = "INSERT INTO treinos (id, domingo, sfeira, tfeira, qafeira, qifeira, sefeira, sabado, data_inicio, data_final) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  // Preparar a declaração
  $stmt = $conn->prepare($sql);

  // Vincular parâmetros
  $stmt->bind_param("ssssssssss", $id, $domingo, $sfeira, $tfeira, $qafeira, $qifeira, $sefeira, $sabado, $data_inicio, $data_final);

  // Executar a declaração
  $stmt->execute();

  // Fechar a declaração
  $stmt->close();
  if (mysqli_prepare($conn, $sql)) {
    echo "Treino cadastrado com sucesso!";
    header("Location:gestao_treinos.php");
  } else {
    echo "Erro" . mysqli_connect_error($conn);
  }
  mysqli_close($conn);
}
?>