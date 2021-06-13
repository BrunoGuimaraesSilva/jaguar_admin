<?php
    if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;

    $modelo = $anomodelo = $anofabricacao = $valor = $imagem = $id_marca = $id_cor =  $id_tipo = NULL;

	include "libs/api.php";
	include "libs/docs.php";

    //select para edição
    if ( !empty ( $id ) ) {

		$dados = callAPI('GET','/api/veiculo/'.$id)['data']; 

        //recuperar os dados
        $modelo = $dados->modelo;
       
        $valor = formatarValorBR($dados->valor);
        $imagem = $dados->foto;
        $id_marca = $dados->id_marca;
		$id_cor = $dados->id_cor;
		$id_tipo = $dados->id_tipo;
		$ano_modelo = new DateTime($dados->ano_modelo);
		$ano_fabricacao = new DateTime($dados->ano_fabricacao);
		$anomodelo = $ano_modelo->format('Y');
		$anofabricacao = $ano_fabricacao->format('Y');
    }

?>
<div class="card">
	<div class="card-header">
		<h3 class="float-left">Cadastro de Veículos</h3>
		<div class="float-right">
			<a href="cadastros/veiculos" class="btn btn-info">
        		<i class="fas fa-file"></i> Novo
        	</a>
        	<a href="listar/veiculos" class="btn btn-info">
        		<i class="fas fa-search"></i> Listar
        	</a>
		</div>
	</div>
	<div class="card-body">
		<form name="formCadastro" method="post" action="salvar/veiculos" data-parsley-validate="" enctype="multipart/form-data">
			<div class="row">
				<div>
					<input type="hidden" name="id" id="id"class="form-control" readonly value="<?=$id?>">
				</div>
				<div class="col-12 col-md-2">
					<label for="produto">Modelo:</label>
					<input type="text" name="modelo" id="modelo" class="form-control" required data-parsley-required-message="Digite o nome do modelo" value="<?=$modelo?>"  maxlength="200">
				</div>
				<div class="col-12 col-md-2">
					<label for="anomodelo">Ano do Modelo:</label>
					<input type = "year" name="anomodelo" id="anomodelo" class="form-control" required data-parsley-required-message="Digite o ano do modelo" rows="10" value="<?=$anomodelo?>"></input>
				</div>
				<div class="col-12 col-md-2">
					<label for="anofabricacao">Ano de Fabricação:</label>
					<input type="year" name="anofabricacao" id="anofabricacao" class="form-control" required data-parsley-required-message="Digite o ano de fabricação" rows="10" value="<?=$anofabricacao?>"></input>
				</div>
				<div class="col-12 col-md-2">
					<label for="valor">Valor do Veículo:</label>
					<input type="text" name="valor" id="valor" class="form-control valor" required 
					data-parsley-required-message="Digite o valor do veículo" inputmode="numeric" value="<?=$valor?>">
				</div>

				<div class="col-12 col-md-2">
					<label for="id_tipo">Selecione um Tipo:</label>
					<select name="id_tipo" id="id_tipo" class="form-control" required data-parsley-required-message="Selecione uma tipo">
						<option value=""></option>
						<option value="0">Seminovo</option>
						<option value="1">Novo</option>
					</select>
				</div>
				
				<div class="col-12 col-md-2">
					<label for="id_marca">Selecione uma Marca:</label>
					<select name="id_marca" id="id_marca" class="form-control" required data-parsley-required-message="Selecione uma marca">
						<option value=""></option>
						<?php
							$dados = callAPI('GET','/api/marca')['data'];
							//$dados = callAPI('GET','/api/marca')['data'];
				
							foreach ($dados as $key => $value) {
								echo "<option value='{$value->id}'>{$value->marca}</option>";
							}	
						?>
					</select>
				</div>
				<div class="col-12 col-md-2">
					<label for="id_cor">Selecione uma Cor:</label>
					<select name="id_cor" id="id_cor" class="form-control" required data-parsley-required-message="Selecione uma cor">
						<option value=""></option>
						<?php
							$dados = callAPI('GET','/api/cor')['data'];
							//$dados = callAPI('GET','/api/cor')['data'];

							foreach ($dados as $key => $value) {
								echo "<option value='{$value->id}'>{$value->cor}</option>";
							}	
						?>
					</select>
				</div>
				<div class="col-12 col-md-4">
					<?php

						$required = 'required data-parsley-required-message="Selecione um arquivo"';
						$link = NULL;

						//verificar se a imagem não esta em branco
						if ( !empty ( $imagem ) ) {
							//caminho para a imagem
							$img = "../imgveiculos/{$imagem}";
							
							//criar um link para abrir a imagem
							$link = "<a href='{$img}' data-lightbox='foto' class='badge badge-success'>Abrir imagem</a>";
							$required = NULL;

						}

					?>
					<label for="imagem">Imagem (JPG) <?=$link?>:</label>
					<input type="file" name="imagem" id="imagem" class="form-control" <?=$required?> accept="image/jpeg">
				</div>			
			</div>

			<button type="submit" class="btn btn-success float-right">
				<i class="fas fa-check"></i> Salvar / Alterar
			</button>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".valor").maskMoney({
			thousands: '.',
			decimal: ','
		});

		//selecionar a categoria
		$("#id_tipo").val(<?=$id_tipo?>);
		$("#id_marca").val(<?=$id_marca?>);
		$("#id_cor").val(<?=$id_cor?>);
	})
</script>


