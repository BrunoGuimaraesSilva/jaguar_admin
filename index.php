<?php
session_start(); //iniciando uma sessão

?>
<!DOCTYPE html>
<html>

<head>
	<title>Jaguar Motors</title>
	<meta charset="utf-8">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/all.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert.css">

  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/lightbox.js"></script>
  <script type="text/javascript" src="js/parsley.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container text-center">
    <a class="navbar-brand" href="index.php">
      <img src="images/logo3.png" alt="Jaguar">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav mr-auto">
        <!--<li class="nav-item">
          <a class="nav-link" href="index.php?pagina=veiculos">
          <strong>Veículos</strong>
        </a>
        </li>-->

          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <strong>Veículos</strong>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?pagina=veiculosnovos">Novos</a></li>
            <li><a class="dropdown-item" href="index.php?pagina=veiculosseminovos">Seminovos</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=vendasfinanc">
          <strong>Vendas e Financiamento</strong>
        </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=ofertas">
          <strong>Ofertas</strong>
        </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=sobre">
            <strong>Sobre a Jaguar</strong>
        </a>
        </li>
      </ul>

      <form class="form-inline my-2 my-lg-0" name="formBusca">
        <input class="form-control mr-sm-2" type="search" placeholder="Palavra-chave" aria-label="Search" name="busca">
        <button class="btn btn-dark my-2 my-sm-0 dropdown">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
  </div>  
</nav>

<main class="container">
	<?php
		//recebe o valor da pagina (GET)
		$pagina = $_GET["pagina"] ?? "home";

		//$paginas = home -> paginas/home.php
		$pagina = "paginas/{$pagina}.php";

		//verificar se a página
		if ( file_exists($pagina) ) {
			//incluir a minha página
			include $pagina;
		} else {
			include "paginas/erro.php";
		}


	?>
</main>

<footer class="bg-dark">
  <div class="container">
    <p class="text-center">Jaguar Motors - Concessionária</p>
    <p class="text-center">
      <strong>Retire seu Carro na Hora! - Fone (44) 3663-9823</strong>
    </p>
    <hr>
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
          <span>Copyright &copy; Jaguar Motors <?=date("Y")?></span>
      </div>
    </div>
    <br/>
    <div class="text-center">
      <img src="images/marcas.png"  alt="marcas">
    </div>  
    <br/>
    <p class="text-center" style="font-size: 12px;">Desenvolvido por: Bruno Gabriel da Silva e Bruno Guimarães da Silva</p>
  </div>
</footer>
</body>

</html>