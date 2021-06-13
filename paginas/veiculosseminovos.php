<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;
?>
<br/>
<h1>Veículos Seminovos:</h1>
<br/>
<div class="row">
	<?php

		include "libs/api.php";

		$dados = callAPI('GET','/api/veiculo')['data'];
		
		foreach ($dados as $key => $value) {

			if ($value->id_tipo = 0) {
				$valor = "R$ " . number_format($value->valor, 2, ",", ".");
				$imagem = $value->foto;

				echo "<div class='col-12 col-md-4 text-center'>
					<img src='{$imagem}m.jpeg' alt='{$value->modelo}' class='w-100'>
					<h2>{$value->modelo}</h2>
					<p>{$valor}</p>
					<p>
						<a href='index.php?pagina=veiculo&id={$value->id}' class='btn btn-info btn-lg w-100'>
							Mais Detalhes
						</a>
					</p>
				</div>";
			}
		}
	?>
</div>