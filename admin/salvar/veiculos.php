<?php
    if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;

    if ( $_POST ) {

        include "libs/docs.php";
        include "libs/imagem.php";
        include "libs/api.php";

    	foreach ($_POST as $key => $value) {
    		$$key = trim ( $value );
    	}
        
        

    	if (empty($modelo)) {
    	    mensagem("Erro ao salvar","Preencha o campo modelo","error");
        } else if (empty($id_marca)) {
    	    mensagem("Erro ao salvar","Preencha o campo da marca","error");
        } else if (empty($id_cor)) {
    	    mensagem("Erro ao salvar","Preencha o campo da cor","error");
        } else if (empty($anomodelo)) {
    	    mensagem("Erro ao salvar","Preencha o campo ano do modelo","error");
        } else if (empty($anofabricacao)) {
    	    mensagem("Erro ao salvar","Preencha o campo ano de fabricação","error");
        } else if (empty($valor)) {
    	    mensagem("Erro ao salvar","Preencha o campo valor","error");
        }

    	//echo formatarValor($valor);

    	/*$v = "1.456,98";
    	echo "<br>".formatarValor($v);

    	echo "<br>".formatarValor('1.672,91');*/

    	$valor = formatarValor($valor);

        //programação para copiar uma imagem
        //no insert envio da foto é obrigatório
        //no update só se for selecionada uma nova imagem

        

        //se o id estiver em branco e o imagem tbém - erro
        if ( ( empty ( $id ) ) and ( empty ( $_FILES['imagem']['name'] ) ) ) {
            mensagem("Erro ao enviar imagem","Selecione um arquivo JPG válido","error");
        } 

        //se existir imagem - copia para o servidor
        if ( !empty ( $_FILES['imagem']['name'] ) ) {
            //calculo para saber quantos mb tem o arquivo
            $tamanho = $_FILES['imagem']['size'];
            $t = 8 * 1024 * 1024; //byte - kbyte - megabyte

            $imagem = time();
            $usuario = $_SESSION['jaguar']['id_usuario'];

            //definir um nome para a imagem
            $imagem = "veiculo_{$imagem}_{$usuario}";

            //echo "<p>{$imagem}</p>"; exit;

            //validar se é jpg
            if ( $_FILES['imagem']['type'] != 'image/jpeg' ) {
                mensagem("Erro ao enviar imagem","O arquivo enviado não é um JPG válido, selecione um arquivo JPG","error");
            } else if ( $tamanho > $t ) {
                mensagem("Erro ao enviar imagem","O arquivo é muito grande e não pode ser enviado. Tente arquivos menores que 8 MB","error");
            } else if ( !copy ( $_FILES['imagem']['tmp_name'], '../imgveiculos/'.$_FILES['imagem']['name'] ) ) {
                mensagem("Erro ao enviar imagem","Não foi possível copiar o arquivo para o servidor","error");
            }

            //redimensionar a imagem
            $pastaFotos = '../imgveiculos/';
            $_FILES['imagem']['name'] = $imagem;
            $img = $pastaFotos.$imagem;

            //print_r($_FILES);exit;
            //echo($img);exit;
            //loadImg($pastaFotos.$_FILES['imagem']['name'], $imagem, $pastaFotos);
        } //fim da verificação da foto

        

        //se vai dar insert ou update
        if ( empty ( $id ) ) {

            $arraydados=array(
                "id_marca"=>$id_marca,
                "id_cor"=>$id_cor,
                "modelo"=>$modelo,
                "ano_modelo"=>$anomodelo,
                "ano_fabricacao"=>$anofabricacao,
                "valor"=>$valor,
                "id_usuario"=>$_SESSION['jaguar']['id_usuario'],
                "foto"=> $img,
                "id_tipo"=>$id_tipo
            );

            //$sql = "insert into produto values( NULL, :produto, :descricao, :valor, :promo, :imagem, :ativo, :categoria_id )";
            $dados = callAPI('POST','/api/veiculo', $arraydados);
            //$dados = callAPI('POST','/api/veiculo', $arraydados);
            
        } else if ( empty ( $imagem ) ) {

            $data = callAPI('GET','/api/veiculo/'.$id,)["data"];
            $imagem = $data->foto;

            //print_r($data);exit;

            $arraydados = array(
                "id_marca"=>$id_marca,
                "id_cor"=>$id_cor,
                "modelo"=>$modelo,
                "ano_modelo"=>$anomodelo.'-01-01',
                "ano_fabricacao"=>$anofabricacao.'-01-01',
                "valor"=>$valor,
                "id_usuario"=>$_SESSION['jaguar']['id_usuario'],
                "foto"=>$imagem,
                "id_tipo"=>$id_tipo
            );

            //print_r($arraydados);exit;

            $dados = callAPI('PUT','/api/veiculo/'.$id, $arraydados);
            //$sql = "update produto set produto = :produto, descricao = :descricao, valor = :valor, promo = :promo, ativo = :ativo, categoria_id = :categoria_id where id = :id limit 1";
         
        } else {

            $arraydados = array(
                "id_marca"=>$id_marca,
                "id_cor"=>$id_cor,
                "modelo"=>$modelo,
                "ano_modelo"=>$anomodelo,
                "ano_fabricacao"=>$anofabricacao,
                "valor"=>$valor,
                "id_usuario"=>$_SESSION['jaguar']['id_usuario'],
                "foto"=>$img,
                "id_tipo"=>$id_tipo
            );
            print_r($arraydados);exit;

            $dados = callAPI('PUT','/api/veiculo/'.$id, $arraydados);
            //print_r($dados);exit;
            //$sql = "update produto set produto = :produto, descricao = :descricao, valor = :valor, promo = :promo, imagem = :imagem, ativo = :ativo, categoria_id = :categoria_id where id = :id limit 1";
       
        }

        if ($dados["status"] == 200) {
            mensagemLocation('Sucesso', 'Registro cadastrado com sucesso!', 'success', 'listar/veiculos');
            exit;
        }
        mensagemLocation('Erro','Erro ao salvar','error','listar/veiculos');
        exit;
    }