<?php
include("./conexao.php");

$id = $_GET['id'];
if (isset($_POST['submit'])) {
   //Capturar os dados do Formulario
	$id = $_POST['id'];
	$Jan = $_POST['Jan'];
	$Fev = $_POST['Fev'];
	$Mar = $_POST['Mar'];
	$Abr = $_POST['Abr'];
	$Mai = $_POST['Mai'];
	$Jun = $_POST['Jun'];
	$Jul = $_POST['Jul'];
	$Ago = $_POST['Ago'];
	$Sept = $_POST['Sept'];
	$Oct = $_POST['Oct'];
	$Nov = $_POST['Nov'];
	$Dez = $_POST['Dez'];

	$sql = "UPDATE  contribuicoes set id='$id', Jan='$Jan',Fev='$Fev',Mar='$Mar' ,Abr='$Abr' ,Mai='$Mai' ,
	 Jun='$Jun' ,Jul='$Jul' ,Ago='$Ago' ,Sept='$Sept',Oct='$Oct' ,Nov='$Nov' ,Dez='$Dez' where id=$id";

	// $sql="UPDATE criar set $nome,$apelido,$email,$genero where Id=$Id";
	//$sql="INSERT into criar Values(Null,'$nome','$apelido','$email','$genero')";
	// $sql="INSERT INTO 'criar'('Id','nome','apelido','email','genero')VALUES (NULL,'$nome','$apelido','$email','$genero')";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		header("Location: gestao_transacao.php?msg=Dados registrados com Sucesso!");
	} else {
		echo "Failed" . mysqli_error($conn);
	}
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sistema de Gestão do Fundo Social</title />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style/estilorel.css" />
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
</head>

<body>
	<div class="logo">
		<img src="/image/logofs1.jpg" alt="" />
	</div>

	<h1>Actualizar Transacao</h1>
	<p>Actualize os Dados e Submeta o Formulario</p>

	<?php
	$sql = "SELECT*from contribuicoes where id=$id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	?>

	<div class="logo">
		<img src="./image/logofs1.jpg" alt="" />
	</div>

	<form action="#" method="POST">
      <hr>
		<label for="id">ID:</label>
		<input type="number" id="id" size="10" name="id" value="<?php echo $row['id'] ?>" readonly/><br>
  
		<label for="Jan">Janeiro:</label>
		<input type="text" id="Jan" size="10" name="Jan" value="<?php echo $row['Jan'] ?>" /><br>

		<label for="Fev">Fevereiro:</label>
		<input type="text" id="Fev" size="10" name="Fev" value="<?php echo $row['Fev'] ?>" /><br>

		<label for="Mar">Marco:</label>
		<input type="text" id="Mar" size="10" name="Mar" value="<?php echo $row['Mar'] ?>" /><br>

		<label for="Abr">Abril:</label>
		<input type="text" id="Abr" size="10" name="Abr" value="<?php echo $row['Abr'] ?>" /><br>

		<label for="Mai">Maio:</label>
		<input type="text" id="Mai"size="10"  name="Mai" value="<?php echo $row['Mai'] ?>" /><br>

		<label for="Jun">Junho:</label>
		<input type="text" id="Jun" size="10" name="Jun" value="<?php echo $row['Jun'] ?>" /><br>

		<label for="Jul">Julho:</label>
		<input type="text" id="Jul" size="10" name="Jul" value="<?php echo $row['Jul'] ?>" /><br>

		<label for="Ago">Agosto:</label>
		<input type="text" id="Ago" size="10" name="Ago" value="<?php echo $row['Ago'] ?>" /><br>

		<label for="Sept">Setembro:</label>
		<input type="text" id="Sept" size="10" name="Sept" value="<?php echo $row['Sept'] ?>" /><br>

		<label for="Oct">Outubto:</label>
		<input type="text" id="Oct" size="10" name="Oct" value="<?php echo $row['Oct'] ?>" /><br>

		<label for="Nov">Novembro:</label>
		<input type="text" id="Nov" size="10" name="Nov" value="<?php echo $row['Nov'] ?>" /><br>

		<label for="Dez">Dezembro:</label>
		<input type="text" id="Dez" size="10" name="Dez" value="<?php echo $row['Dez'] ?>" /><br>
        <hr>

		<div class="button-group">
			<button type="submit" name="submit" class="submit">Registrar Transação</button>
		</div>
	</form>

</body>

</html>