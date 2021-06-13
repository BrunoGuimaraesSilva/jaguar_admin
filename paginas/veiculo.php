<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;

	//print_r ( $_GET );

	//recuperacao do id
	//trim retira espaços em branco
	$id = trim($_GET["id"] ?? NULL);

	$id = (int)$id;

	//var_dump($id);
	//recuperar o produto com o id
	//$sql    = "select * from produto where id = {$id} limit 1";
	//$result = mysqli_query($con, $sql);
	//$dados  = mysqli_fetch_array($result);

	//print_r ( $dados );

	//recuperar os dados do banco
	/*$id 	   = $dados["id"];
	$produto   = $dados["produto"];
	$valor     = $dados["valor"];
	$promo     = $dados["promo"];
	$descricao = $dados["descricao"];
	$imagem    = $dados["imagem"];*/

	include "libs/api.php";

	$dados = callAPI('GET','/api/veiculo/'.$id)['data'];
	$valor = "R$ " . number_format($dados->valor, 2, ",", ".");
	$imagem =  $dados->foto;

	$dataCor = callAPI('GET', '/api/cor/' . $dados->id_cor)['data'];
	$cor = $dataCor->cor;

	$dataMarca = callAPI('GET', '/api/marca/' . $dados->id_marca)['data'];
	$marca = $dataMarca->marca;
?>
<br/>
<div class="row">
	<div class="col-12 col-md-6">
		<a href="<?=$imagem?>g.jpg" data-lightbox="produto" title="<?=$dados->modelo?>">
			<img src="<?=$imagem?>m.jpg" alt="<?=$dados->modelo?>" class="w-100">
		</a>
	</div>	
	<div class="col-12 col-md-8">
		<button class="btn btn-info">Realizar uma Proposta</button>
	</div> 
</div>
<br/>
<h1><?=$dados->modelo?></h1>
<hr>
<h2>Detalhes:</h2>
<div class="row">
	<div class="col-12 col-md-6">
		<ul class="list-group">
			<li class="list-group-item">Marca: <?=$marca?></li>
			<li class="list-group-item">Cor: <?=$cor?></li>
			<li class="list-group-item">Modelo</li>
			<li class="list-group-item">A fourth item</li>
			<li class="list-group-item">And a fifth one</li>
		</ul>
	</div>	
	<div class="col-12 col-md-6">
		<p class="text-right">A partir de:</p>
		<h4 class="text-right"><?=$valor?><h4>
	</div>
</div>


