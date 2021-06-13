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
            <img src="" class="d-block w-100" alt="">
            <div class="carousel-caption d-md-block">
              <h2></h5>
              <p></p>
              <a href="#" class="main-btn">Saiba mais</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="" class="d-block w-100" alt="">
            <div class="carousel-caption d-md-block">
              <h2></h5>
              <p></p>
              <a href="#" class="main-btn">Saiba mais</a>
            </div>
          </div>
          <div class="carousel-item ">
            <img style="max-height: 607px" src="" class="d-block w-100" alt="">
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
      $dados = callAPI('GET','/api/veiculo')['data'];

      foreach ($dados as $key => $value) {
        $valor = "R$ " . number_format($value->valor, 2, ",", ".");
        $imagem = $value->foto;

        if ($value->id_tipo == 1) {
          echo "<div class='col-12 col-md-3 text-center'>
            <br/>
            <img src='{$imagem}.jpeg' alt='{$value->modelo}' class='w-100'>
            <h2>{$value->modelo}</h2>
            <p>{$valor}</p>
            <p>
              <a class='btn btn-info' href='index.php?pagina=veiculo&id={$value->id}'>
                Mais Detalhes
              </a>
            </p>
          </div>";
        }
      }
    ?>		
  <br/>
  </div>
  <br/>  	
  <h1 class="text-center">Veículos Seminovos:</h1>
  <div class="row">
    <br/>
    <?php
      $dados = callAPI('GET','/api/veiculo')['data'];

      foreach ($dados as $key => $value) {
        $valor = "R$ " . number_format($value->valor, 2, ",", ".");
        $imagem = $value->foto;

        if ($value->id_tipo == 0) {
          echo "<div class='col-12 col-md-3 text-center'>
            <img src='{$imagem}.jpeg' alt='{$value->modelo}' class='w-100'>
            <h2>{$value->modelo}</h2>
            <p>{$valor}</p>
            <p>
              <a class='btn btn-info' href='index.php?pagina=veiculo&id={$value->id}'>
                Mais Detalhes
              </a>
            </p>
          </div>";
        }  
      }

    ?>
  </div>
</div>