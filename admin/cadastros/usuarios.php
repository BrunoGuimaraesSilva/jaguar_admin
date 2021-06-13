<?php
if (!isset($_SESSION['jaguar']['id'])) exit;

include "libs/api.php";

$l = $nome = $sobrenome = $email = $data_nascimento = $login = $senha = NULL;
$r = " required data-parsley-required-message='Preencha a senha' ";
$f = " required data-parsley-required-message='Selecione uma Imagem JPG' ";

if (!empty($id)) {
    $dadosLogin = callAPI('GET', '/api/login/' . $id)['data'];
    //$dadosLogin = callAPI('GET','http://192.168.0.105:8080/api/login')['data'];
    $dadosUsuario = callAPI('GET', '/api/usuario/' . $dadosLogin->id_usuario)['data'];
    //$dadosUsuario = callAPI('GET','http://192.168.0.105:8080/api/usuario/'. $value->id)['data'];
    $id = $dadosLogin->id;
    $nome = $dadosUsuario->nome;
    $id_usuario = $dadosLogin->id_usuario;
    $sobrenome = $dadosUsuario->sobrenome;
    $email = $dadosUsuario->email;
    $data_nascimento = $dadosUsuario->data_nascimento;
    $login = $dadosLogin->login;

    $l = " readonly ";
    $r = $f = NULL;
}
?>
<div class="card">
    <div class="card-header">
        <h3 class="float-left">Cadastro de Usuários</h3>

        <div class="float-right">
            <a href="cadastros/usuarios" class="btn btn-info">
                <i class="fas fa-file"></i> Novo
            </a>
            <a href="listar/usuarios" class="btn btn-info">
                <i class="fas fa-search"></i> Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/usuarios" data-parsley-validate="" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
            <div class="row">
                <div class="col-12 col-md-2">
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" class="form-control" readonly value="<?= $id ?>">
                </div>
                <div class="col-12 col-md-8">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" required data-parsley-required-message="Preencha o nome" value="<?= $nome ?>">
                </div>
                <div class="col-12 col-md-8">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" id="sobrenome" class="form-control" required data-parsley-required-message="Preencha o sobrenome" value="<?= $sobrenome ?>">
                </div>
                <div class="col-12 col-md-8">
                    <label for="data_nascimento">Data de nascimento:</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" value="<?= $data_nascimento ?>">
                </div>
                <div class="col-12 col-md-8">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail" value="<?= $email ?>" data-parsley-type-message="Digite um e-mail válido">
                </div>
                <div class="col-12 col-md-4">
                    <label for="login">Login:</label>
                    <input type="text" name="login" id="login" class="form-control" required data-parsley-required-message="Preencha o login" value="<?= $login ?>" <?= $l ?>>
                </div>
                <div class="col-12 col-md-6">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" <?= $r ?>>
                </div>
                <div class="col-12 col-md-6">
                    <label for="redigite">Redigite a Senha:</label>
                    <input type="password" name="redigite" id="redigite" class="form-control" <?= $r ?> data-parsley-equalto="#senha">
                </div>
            </div>

            <button type="submit" class="btn btn-success float-right">
                <i class="fas fa-check"></i> Salvar / Alterar
            </button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#ativo").val("<?= $ativo ?>");
    $("#tipo_id").val("<?= $tipo_id ?>");
</script>