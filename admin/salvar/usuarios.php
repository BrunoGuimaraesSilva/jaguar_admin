<?php
if (!isset($_SESSION['jaguar']['id'])) exit;

include "libs/docs.php";
include "libs/api.php";


if ($_POST) {

    foreach ($_POST as $key => $value) {
        $$key = trim($value);
    };

    if (empty($login)) {
        mensagem("Erro", "Preencha o login", "error");
        exit;
    } else if ($senha != $redigite) {
        mensagem("Erro", "As senhas nao sao iguais", "error");
        exit;
    }

    if (empty($id)) {
        $arrayUsuario = array(
            "email" => $email,
            "nome" => $nome,
            "sobrenome" => $sobrenome,
            "data_nascimento" => $data_nascimento
        );

        $dataUsuario = callAPI('POST', '/api/usuario', $arrayUsuario);

        if ($dataUsuario["status"] == 200) {

            $arrayLogin = array(
                "login" => $login,
                "senha" => $senha,
                "id_usuario" => $dataUsuario['data']->id_usuario
            );

            $dataLogin = callAPI('POST', '/api/login', $arrayLogin);

            if ($dataLogin["status"] == 200) {
                mensagemLocation('Sucesso', 'Registro cadastrado com sucesso!', 'success', 'listar/usuarios');
                exit;
            }
            mensagemLocation('Erro', 'Erro ao salvar', 'error', 'listar/usuarios');
            exit;
        }

    } else {

        $arrayUsuario = array(
            "email" => $email,
            "nome" => $nome,
            "sobrenome" => $sobrenome,
            "data_nascimento" => $data_nascimento
        );

        $dataUsuario = callAPI('PUT', '/api/usuario/' . $id_usuario, $arrayUsuario);

        if ($dataUsuario["status"] == 200) {

            if($senha == ""){
                $dataLogin = callAPI('GET', '/api/login/' . $id)['data'];
                $senha = $dataLogin->senha;
            }
            
            $arrayLogin = array(
                "login" => $login,
                "senha" => $senha,
                "id_usuario" => $dataUsuario['data']->id_usuario
            );

            $dataLogin = callAPI('PUT', '/api/login/' . $id, $arrayLogin);

            if ($dataLogin["status"] == 200) {
                mensagemLocation('Sucesso', 'Registro editado com sucesso!', 'success', 'listar/usuarios');
                exit;
            }
            mensagemLocation('Erro', 'Erro ao salvar', 'error', 'listar/usuarios');
            exit;
        }
    }
}

mensagem("Erro", "Requisicao invalida", "error");
