<?php
    if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;
?>
<div class="card">
    <div class="card-header">
        <h3 class="float-left">Listagem de Cores</h3>

        <div class="float-right">
        	<a href="cadastros/cor" class="btn btn-info">
        		<i class="fas fa-file"></i> Novo
        	</a>
        	<a href="listar/cor" class="btn btn-info">
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
                    <td width="80%">Nome da Cor</td>
                    <td width="10%">Opções</td>
                </tr>      
            </thead>
            <tbody>
                <?php
                    include "libs/api.php";
                    $dados = callAPI('GET','http://192.168.8.157:8080/api/cor')['data'];
                    //$dados = callAPI('GET','http://192.168.0.105:8080/api/cor')['data'];

                    foreach ($dados as $key => $value) {
                        
                        ?>
                        <tr>
                            <td><?=$value->id?></td>
                            <td><?=$value->cor?></td>
                            <td>
                                <a href="cadastros/cor/<?=$value->id?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="javascript:excluir(<?=$value->id?>)" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
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

<script type="text/javascript">
    function excluir(id) {

        Swal.fire({
          title: 'Deseja realmente excluir este registro?',
          showCancelButton: true,
          confirmButtonText: `Sim`,
          cancelButtonText: `Não`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            //enviar para excluir
            location.href='excluir/cor/'+id;
          } 
        })
    }
</script>
<script src="js/dataTable.js"></script>