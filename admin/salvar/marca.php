<?php

use function PHPSTORM_META\map;

if (!isset($_SESSION['jaguar']['id'])) exit;

if ($_POST) {

    //incluir o docs e a api
    include "libs/docs.php";
    include "libs/api.php";

    //recuperar o id e o nome da categoria
    $id  = trim($_POST['id'] ?? NULL);
    $marca = trim($_POST['marca'] ?? NULL);

    //verificar se este registro já está salvo no banco
    $dados = callAPI('GET', 'http://192.168.8.157:8080/api/marca')['data'];

    //se vier preenchido já existe uma marca com memso nome
    $array = array_map(function ($obj) {
        return $obj->marca;
    }, $dados);

    foreach ($array as $key => $value) {

        if ($value == $marca) {
            mensagem('Erro', 'Já existe uma marca cadastrada com esse nome', 'error');
            exit;
        }
    }

    $data = NULL;
    //se o id estiver em branco - insert
    if (empty($id)) {
        $data = callAPI('POST', 'http://192.168.8.157:8080/api/marca', array("marca" => $marca));
        //$data = callAPI('POST', 'http://192.168.0.105:8080/api/marca', array("marca" => $marca));
    } else {
        $data = callAPI('PUT', 'http://192.168.8.157:8080/api/marca/' . $id, array("marca" => $marca));
        //$data = callAPI('PUT', 'http://192.168.5.105:8080/api/marca/' . $id, array("marca" => $marca));
    }

    //verificar se deu certo
    if ($data["status"] == 200) {
        mensagemLocation('Sucesso', 'Registro cadastrado com sucesso!', 'success', 'listar/marca');
    } else {
        mensagem('Erro', 'Já existe uma marca cadastrada com esse nome', 'error');
    }

    mensagem('Erro', 'Erro ao salvar registro', 'error');
    exit;
}

mensagem('Erro', 'Requisição Inválida', 'error');
