<?php
session_start(); // Iniciar a sessão

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirecionar para a página de login se não estiver logado
    exit();
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Gestão do Fundo Social</title>
    <meta name="author" content="Justino Melembe" />
    <meta name="keywords" content="fundo social-trac, trac-fundo social, fundo social">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="./style/index.css" />
    <script src="./javascript/javascriptsidebar.js"></script>
    <script src="./javascript/javascriptslide.js"></script>
    <style>
      .footer {
          text-align: center;
          position: fixed;
          bottom: 0;
          width: 100%;
          background-color:none;
          padding: 10px;
          
      }
  </style>
  </head>
  <body>
    <div id="mySidebar" class="sidebar">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
        >&times;</a
      >
      <a href="registo.php">Cadastrar</a>
      <a href="visualizar_minhaconta.php">Minha Conta</a>
      <a href="visualizar_conta.php">Detalhes da Conta</a>
      <a href="visualizar_contribuicoes.php">Contribuições</a>
      <a href="gestao_membros.php">Gestão de Membros</a>
      <a href="gestao_transacao.php">Gestão de Transações</a>
      <a href="gestao_conta.php">Gestão da Conta</a>
      <a href="visualizar_actividades.php">Actividades</a>
      <a href="docs_fs.php">Documentos</a>
      <a href="visualizar_graficob_admin.php">Gráfico de Barras</a>
      <a href="visualizar_graficoc_admin.php">Gráfico Circular</a>
      <a href="contact.html">Contacte-nos</a>
      <a href="logout.php">Sair</a>
    </div>

    <div id="main">
      <button class="openbtn" onclick="openNav()">&#9776; MENU</button>
      <!-- Slideshow container -->
      <div class="slideshow-container"><br>
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img
            src="./image/aa.png"
            style="width: 80%"
            height="200%"
            position="center"
            alt=""
          />
          <div class="text">Caption One</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img
            src="./image/ba.png"
            style="width: 80%"
            height="70%"
            position="center"
            alt=""
          />
          <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img
            src="./image/ca.png"
            style="width: 80%"
            height="200%"
            position="center"
            alt=""
          />
          <div class="text">Caption Three</div>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
      <br />

      <!-- The dots/circles -->
      <div style="text-align: center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div>
    </div>
   
  </body>
  <div class="footer">
    <p class="copyright">Maputo Toll Plaza Properity. Designed by jmelembe &copy; 2024. </p>
  </div>
</html>
