<?php
    if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;
?>
<div class="card">
    <div class="card-header">
        <h3 class="float-left">Listagem de Usuários</h3>

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
        <p>Resultados:</p>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td width="10%">ID</td>
                    <td width="10%">ID Usuário</td>
                    <td width="50%">Nome</td>
                    <td width="50%">Sobrenome</td>
                    <td width="50%">Email</td>
                    <td width="20%">Login</td>
                    <td width="20%">Ações</td>
                </tr>      
            </thead>
            <tbody>
                <?php
                    //selecionat todas as categorias
                    include "libs/api.php";
                    $dadosLogin = callAPI('GET','/api/login')['data'];
                    //$dadosLogin = callAPI('GET','http://192.168.0.105:8080/api/login')['data'];
                    
                    foreach ($dadosLogin as $key => $value) {
                    $dadosUsuario = callAPI('GET','/api/usuario/'. $value->id_usuario)['data'];
                    //$dadosUsuario = callAPI('GET','http://192.168.0.105:8080/api/usuario/'. $value->id)['data'];
                        ?>
                        <tr>
                            <td><?=$value->id?></td>
                            <td><?=$dadosUsuario->id_usuario?></td>
                            <td><?=$dadosUsuario->nome?></td>
                            <td><?=$dadosUsuario->sobrenome?></td>
                            <td><?=$dadosUsuario->email?></td>
                            <td><?=$value->login?></td>
                            <td>
                                <a href="cadastros/usuarios/<?=$value->id?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php

                    }

                ?>               
                
            </tbody>
        </table>
    </div>
</div>


<script src="js/dataTable.js"></script>