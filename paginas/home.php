<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;

?>
<br/>	
<div class="container-fluid">
      <!-- slider -->
      <div id="mainSlider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
          <li data-target="#mainSlider" data-slide-to="1"></li>
          <li data-target="#mainSlider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../images/k5.jpg" class="d-block w-100" alt="">

            <!-- tirar classe d-none -->

            <div class="carousel-caption d-md-block">
              <h2></h5>
              <p></p>
              <a href="#" class="main-btn">Saiba mais</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../images/fordgt.jpg" class="d-block w-100" alt="Engenharia de software">
            <div class="carousel-caption d-md-block">
              <h2></h5>
              <p></p>
              <a href="#" class="main-btn">Saiba mais</a>
            </div>
          </div>
          <div class="carousel-item ">
            <img style="max-height: 607px" src="../images/tesla.jpg" class="d-block w-100" alt="Manutenção em software">
            <div class="carousel-caption d-md-block">
              <h2></h5>
              <p></p>
              <a href="#" class="main-btn">Saiba mais</a>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
<br/>
	<h1 class="text-center">Veículos Novos:</h1>
  <div class="row">
  <br/>
  <?php
    include "libs/api.php";
    //$dados = callAPI('GET','http://192.168.8.157:8080/api/cor')['data'];
    $dados = callAPI('GET','http://192.168.0.105:8080/api/veiculo')['data'];

    foreach ($dados as $key => $value) {
      $valor = "R$ " . number_format($value->valor, 2, ",", ".");

      if ($value->id_tipo == 1) {
        echo "<div class='col-12 col-md-3 text-center'>
          <img src='veiculos{$imagem}p.jpg' alt='{$produto}' class='w-100'>
          <h2>{$value->modelo}</h2>
          <p>{$valor}</p>
          <p>
            <a href='index.php?pagina=veiculo&id={$value->id}'>
              Mais Detalhes
            </a>
          </p>
        </div>";
      }
    }

  ?>
  </div>

	<!--<div class="row">
		
		 PHP //selecionar 6 produtos - rand -> sorteio - limit limitar o nr de resultado
			$sql = "select * from produto order by rand() limit 4";
			//executar o sql
			$result = mysqli_query($con, $sql);

			//separar os dados por linha
			while ( $dados = mysqli_fetch_array( $result ) ) {
				//separar
				$id = $dados["id"];
				$produto = $dados["produto"];
				$imagem = $dados["imagem"];
				$valor = $dados["valor"];
				$promo = $dados["promo"];

				//se tiver promo - valor = valor da promo
				//senao valor = valor do produto

				//se a promo esta vazio - valor = valor do produto
				if ( empty ( $promo ) ) {
					//1499.99 -> 1.499,99
					$valor = "R$ " . number_format($valor, 2, ",", ".");
					$de = "";
				} else {
					//valor normal
					$de = "R$ " . number_format($valor, 2, ",", ".");
					//valor promocional
					$valor = "R$ " . number_format($promo, 2, ",", ".");
				}

				echo "<div class='col-12 col-md-4 text-center'>
					<img src='produtos/{$imagem}p.jpg' alt='{$produto}' class='w-100'>
					<h2>{$produto}</h2>
					<p class='de'>{$de}</p>
					<p class='valor'>{$valor}</p>
					<p>
						<a href='index.php?pagina=produto&id={$id}' class='btn btn-success btn-lg w-100'>
						Detalhes
						</a>
					</p>
				</div>";

			}-->
		
	</div>
</div>		
<br/>	
<div>
	<h1 class="text-center">Veículos Seminovos:</h1>
</div>
<div class="row">
<br/>
<?php
  //$dados = callAPI('GET','http://192.168.8.157:8080/api/cor')['data'];
  $dados = callAPI('GET','http://192.168.0.105:8080/api/veiculo')['data'];

  foreach ($dados as $key => $value) {
    $valor = "R$ " . number_format($value->valor, 2, ",", ".");

    if ($value->id_tipo == 0) {
      echo "<div class='col-12 col-md-3 text-center'>
        <img src='veiculos{$imagem}p.jpg' alt='{$produto}' class='w-100'>
        <h2>{$value->modelo}</h2>
        <p>{$valor}</p>
        <p>
          <a href='index.php?pagina=veiculo&id={$value->id}'>
            Mais Detalhes
          </a>
        </p>
      </div>";
    }  
  }

?>
</div>