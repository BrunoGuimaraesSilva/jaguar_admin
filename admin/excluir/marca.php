<?php

if (!isset($_SESSION['jaguar']['id'])) exit;

include "libs/docs.php";
include "libs/api.php";

//verificar se esta sendo enviado um ID
if (empty($id)) {
    mensagem('Erro', 'Requisição Inválida - ID inválido', 'error');
    exit;
}

//excluir a categoria
//$dados = callAPI(`DELETE`, '/api/marca/'.$id);
$dados = callAPI(`DELETE`, '/api/marca/'.$id);

//verificar se conseguiu excluir
if ($dados["status"] == 200) {
    mensagemLocation('Sucesso','Marca deletada com sucesso!','success','listar/marca');
     
} else {
    mensagem('Erro','Erro ao deletar a marca desejada','error');
}
