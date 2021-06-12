<?php
    if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;

    include "libs/api.php";

    $cor = NULL;

    if ( ! empty ( $id ) ) {

        $dados = callAPI('GET','http://192.168.0.105:8080/api/cor/'.$id)['data'];  
        
        $id = $dados->id;
        $cor = $dados->cor;

    }

?>
<div class="card">
    <div class="card-header">
        <h3 class="float-left">Cadastro de Cores</h3>

        <div class="float-right">
        	<a href="cadastros/cor" class="btn btn-info">
        		<i class="fas fa-file"></i> Novo
        	</a>
        	<a href="listar/cor" class="btn btn-info">
        		<i class="fas fa-search"></i> Listar
        	</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/cor" data-parsley-validate="">
        	<div class="row">
        		<div>
        			<input type="hidden" name="id" id="id" class="form-control" readonly value="<?=$id?>">
        		</div>
        		<div class="col-12 col-md-2">
        			<label for="categoria">Cor:</label>
        			<input type="text" name="cor" id="cor" class="form-control" required data-parsley-required-message="Preencha a cor" value="<?=$cor?>">
        		</div>
        	</div>

        	<button type="submit" class="btn btn-success float-right">
        		<i class="fas fa-check"></i> Salvar / Alterar
        	</button>
        </form>
    </div>
</div>