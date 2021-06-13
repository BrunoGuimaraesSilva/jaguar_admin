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
//$dados = callAPI(`DELETE`, 'http://192.168.8.157:8080/api/cor/'.$id);
$dados = callAPI(`DELETE`, 'http://172.19.160.1:8080/api/cor/'.$id);
//verificar se conseguiu excluir
if ($dados["status"] == 200) {
    mensagemLocation('Sucesso','Cor deletado com sucesso!','success','listar/cor');
     
} else {
    mensagem('Erro','Erro ao deletar a cor desejada','error');
}
