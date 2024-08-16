<!DOCTYPE html>
<html lang="PT-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Justino Melembe" />
  <title>Registo - Sistema de Gestão do Fundo Social</title>
  <link rel="stylesheet" href="./style/estilorel.css" />
</head>
<body background="./image/02.jpg">
  <div class="logo">
    <img src="./image/logofs1.jpg" alt="" />
  </div> <h1>Cadastro de Utilizadores</h1><div><a href="dashboard.php" class="btn btn-primary">Voltar</a></div>
    <div class="input">
      <hr>
      <label for="username"><b>Utilizador</b></label><br>
      <input type="text" placeholder="Nome do utilizador" name="username" id="username" required><br>

      <label for="password"><b>Password</b></label><br>
      <input type="password" placeholder="Password" name="password" id="password" required><br>

      <label for="password-repeat"><b>Password</b></label><br>
      <input type="password" placeholder=" Repita o Password" name="password-repeat" id="password-repeat" required><br>

      <label for="nivel_acesso"><b>Nível de Acesso</b></label><br>
      <select name="nivel_acesso" id="nivel_acesso" required><br>
        <option value="1">Utilzador</option>
        <option value="2">Supervisor</option>
        <option value="3">Administrador</option>
      </select><br>
      <label for="nome"><b>Nome Completo</b></label><br>
      <input type="text" placeholder="Nome Completo" name="nome" id="nome" required><br>

      <label for="genero"><b>Genero</b></label><br>
      <select name="genero" id="genero" required><br>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
      </select><br>

      <label for="email"><b>Email</b></label><br>
      <input type="text" placeholder="Email" name="email" id="email" required><br>

      <label for="contacto"><b>Contacto</b></label><br>
      <input type="text" placeholder="Contacto" name="contacto" id="contacto" required><br>

      <label for="date"><b>Data de Ingresso</b></label><br>
      <input type="date" id="data_ingresso" name="data_ingresso" placeholder="Data de Ingresso" required /><br>

      <hr>
      <p>Ao criar a conta estas a aceitar os nossos<a href="#">Termos & Politica de Privacidade</a>.Caso tenhas conta criada apenas <a href="index.html"> Apenas faca Login</a>.</p></p>
      <button type="submit" class="submit">Registar</button>
    </div>
  </form>
</body>
</html>