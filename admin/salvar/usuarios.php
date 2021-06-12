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

    if (false) {
        if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "../arquivos/" . $_FILES["foto"]["name"])) {
            mensagem("Erro", "Nao foi possivel copiar a foto", "error");
            exit;
        }

        $foto = time() . "_" . $_SESSION["submarino"]["id"];
        include "libs/imagem.php";
        loadImg("../arquivos/" . $_FILES["foto"]["name"], $foto, "../arquivos/");
    }

    if (empty($id)) {
        $arrayUsuario = array(
            "email" => $email,
            "nome" => $nome,
            "sobrenome" => $sobrenome,
            "data_nascimento" => $data_nascimento
        );

        $dataUsuario = callAPI('POST', 'http://192.168.8.157:8080/api/usuario', $arrayUsuario);

        if ($dataUsuario["status"] == 200) {

            $arrayLogin = array(
                "login" => $login,
                "senha" => $senha,
                "id_usuario" => $dataUsuario['data']->id_usuario
            );

            $dataLogin = callAPI('POST', 'http://192.168.8.157:8080/api/login', $arrayLogin);

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

        $dataUsuario = callAPI('PUT', 'http://192.168.8.157:8080/api/usuario/' . $id_usuario, $arrayUsuario);

        if ($dataUsuario["status"] == 200) {

            if($senha == ""){
                $dataLogin = callAPI('GET', 'http://192.168.8.157:8080/api/login/' . $id)['data'];
                $senha = $dataLogin->senha;
            }
            
            $arrayLogin = array(
                "login" => $login,
                "senha" => $senha,
                "id_usuario" => $dataUsuario['data']->id_usuario
            );

            $dataLogin = callAPI('PUT', 'http://192.168.8.157:8080/api/login/' . $id, $arrayLogin);

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
