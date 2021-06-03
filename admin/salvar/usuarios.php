<?php
if (!isset($_SESSION['submarino']['id'])) exit;

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

    if (!empty($_FILES["foto"]["name"])) {
        if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "../arquivos/" . $_FILES["foto"]["name"])) {
            mensagem("Erro", "Nao foi possivel copiar a foto", "error");
            exit;
        }

        $foto = time() . "_" . $_SESSION["submarino"]["id"];
        include "libs/imagem.php";
        loadImg("../arquivos/" . $_FILES["foto"]["name"], $foto, "../arquivos/");
    }

    if (empty($id)) {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $sql =
            "INSERT INTO usuario 
                VALUES(NULL, :nome, :email, :login, :senha, :foto, :tipo_id, :ativo)
            ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":login", $login);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":foto", $foto);
        $consulta->bindParam(":tipo_id", $tipo_id);
        $consulta->bindParam(":ativo", $ativo);
    } else {

        $s = NULL;
        $f = NULL;

        if (!empty($senha)) {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $s = ", senha = :senha";
        };

        if (!empty($foto)) {
            $f = ", foto = :foto,";
        };

        $sql =
            "UPDATE usuario SET
                nome = :nome, 
                email = :email, 
                tipo_id = :tipo_id, 
                ativo = :ativo 
                $s
                $f
            WHERE id = :id 
        ";
        
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":tipo_id", $tipo_id);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":id", $id);

        if (!empty($s)) {
            $consulta->bindParam(":senha", $senha);
        }

        if (!empty($f)) {
            $consulta->bindParam(":foto", $foto);
        }
    }

    if ($consulta->execute()) {
        mensagem("Salvo", "Registro salvo com sucesso", "ok");
        exit;
    }
    mensagem("Erro", "Erro ao salvar    ", "error");
    exit;
}

mensagem("Erro", "Requisicao invalida", "error");
