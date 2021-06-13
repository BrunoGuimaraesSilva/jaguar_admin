<?php

use function PHPSTORM_META\map;

if (!isset($_SESSION['jaguar']['id'])) exit;

if ($_POST) {

    //incluir o docs e a api
    include "libs/docs.php";
    include "libs/api.php";

    //recuperar o id e o nome da categoria
    $id  = trim($_POST['id'] ?? NULL);
    $cor = trim($_POST['cor'] ?? NULL);

    //verificar se este registro já está salvo no banco
    //$dados = callAPI('GET','http://192.168.8.157:8080/api/cor')['data'];    
    $dados = callAPI('GET','http://172.19.160.1:8080/api/cor')['data'];    
    
    //se vier preenchido já existe uma cor com memso nome
    $array = array_map(function($obj) {
        return $obj->cor;
    }, $dados);

    foreach ($array as $key => $value) {

        if ($value == $cor) {
            mensagem('Erro','Já existe uma cor cadastrada com esse nome','error');
            exit;
        }
    }
   
    $data = NULL;
    //se o id estiver em branco - insert
    if (empty($id)) {
        //$data = callAPI('POST','http://192.168.8.157:8080/api/cor',array("cor"=>$cor));
        $data = callAPI('POST','http://172.19.160.1:8080/api/cor',array("cor"=>$cor));
    } else {
        //$data = callAPI('PUT','http://192.168.8.157:8080/api/cor/'.$id,array("cor"=>$cor));
        $data = callAPI('PUT','http://172.19.160.1:8080/api/cor/'.$id,array("cor"=>$cor));
    }

    //verificar se deu certo
    if ($data["status"] == 200) {
        mensagemLocation('Sucesso','Registro cadastrado com sucesso!','success','listar/cor');
         
    } else {
        mensagem('Erro','Já existe uma cor cadastrada com esse nome','error');
    }

    mensagem('Erro','Erro ao salvar registro','error');
    exit;
}

mensagem('Erro','Requisição Inválida','error');
        
        
        
    