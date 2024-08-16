<!DOCTYPE html>
<html lang="PT-BR">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sistema de Gestão do Fundo Social</title />
	<link rel="stylesheet" href="./style/estiloreg.css" />
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />

	<head>

	<body style="background-image: url('image/11.jpg')">
		<div class="logo">
		<img src="./image/logofs1.jpg" width="90px" alt="" />
		</div>
		<h1>Adicionar Membros</h1>
		<p>Preencha os campos para adicionar o membro</p>

		<form method="post" action="adicionar_membro_phpcod.php">
			<div class="input">
				<hr>
				<label for="nome"><b>Usuario:</b></label>
				<input type="text" id="nome" size="60" name="nome" placeholder="Usuario" require />

				<label for="nome"><b>Senha:</b></label>
				<input type="password" id="nome" size="60" name="nome" placeholder="Senha" require />

				<label for="nome"><b>Nome Completo:</b></label>
				<input type="text" id="nome" size="60" name="nome" placeholder="Nome Completo" require />

				<label for="genero"><b>Genero:</b></label>
				 <select>
                    <option value="0">Selecione o Genero:</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
				</select>

				<label for="email"><b>E-mail:</b></label>
				<input type="email" id="email" size="71" name="email" placeholder="email" require />

				<label for="number"><b>Contacto:</b></label>
				<input type="number" id="contacto" size="80" name="contacto" placeholder="Contacto" require />

				<label for="nivel_acesso"><b>Nivel de Acesso:</b></label>
					<select>
						<option value="0">Selecione o Nivel:</option>
						<option value="1">Utilizador </option>
						<option value="2">Administrador</option>
					</select>
				<label for="date"><b>Data de Ingresso</b></label>
				<input type="date" id="data_ingresso" size="80" name="data_ingresso" placeholder="Data" require /> <br><br>
				<hr>
			</div>
			<div class="button-group">
			<input type="submit" class="submitForm" name="submitForm" />
		    <a href="dashboard.php" class="btn btn-primary">Voltar</a>
	      </div>
		</form>
	</body>
</html>