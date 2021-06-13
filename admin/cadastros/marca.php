<?php
    if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;

    include "libs/api.php";

    $marca = NULL;

    if ( ! empty ( $id ) ) {

        //$dados = callAPI('GET','http://192.168.8.157:8080/api/marca/'.$id)['data'];  
        $dados = callAPI('GET','http://172.19.160.1:8080/api/marca/'.$id)['data'];  
        $id = $dados->id;
        $marca = $dados->marca;
    }

?>
<div class="card">
    <div class="card-header">
        <h3 class="float-left">Cadastro de Marcas</h3>

        <div class="float-right">
        	<a href="cadastros/marca" class="btn btn-info">
        		<i class="fas fa-file"></i> Novo
        	</a>
        	<a href="listar/marca" class="btn btn-info">
        		<i class="fas fa-search"></i> Listar
        	</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/marca" data-parsley-validate="">
        	<div class="row">
        		<div>
        			<input type="hidden" name="id" id="id" class="form-control" readonly value="<?=$id?>">
        		</div>
        		<div class="col-12 col-md-2">
        			<label for="categoria">Marca:</label>
        			<input type="text" name="marca" id="marca" class="form-control" required data-parsley-required-message="Preencha a marca" value="<?=$marca?>">
        		</div>
        	</div>
        	<button type="submit" class="btn btn-success float-right">
        		<i class="fas fa-check"></i> Salvar / Alterar
        	</button>
        </form>
    </div>
</div>