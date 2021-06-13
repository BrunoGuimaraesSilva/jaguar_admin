<?php
    if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;

    include "libs/api.php";
    include "libs/docs.php";

    //verificar se esta sendo enviado um ID
    if ( empty ( $id ) ) {
        mensagem('Erro','Requisição Inválida - ID inválido','error');
    	exit;
    }

    //excluir o veiculo
    //$dados = callAPI(`DELETE`, '/api/veiculo/'.$id);
    $dados = callAPI(`DELETE`, '/api/veiculo/'.$id);

    //verificar se conseguiu excluir
    if ($dados["status"] == 200) {
        mensagemLocation('Sucesso','Veículo deletado com sucesso!','success','listar/veiculos');
        
    } else {
        mensagem('Erro','Erro ao deletar o veículo desejado','error');
    }

    mensagem('Erro','Erro ao excluir veículo','error');
          
          
          
        