<?php
if (!isset($_SESSION['jaguar']['id'])) exit;
?>
<div class="card">
    <div class="card-header">
        <h3 class="float-left">Listagem de Veículos</h3>

        <div class="float-right">
            <a href="cadastros/veiculos" class="btn btn-info">
                <i class="fas fa-file"></i> Novo
            </a>
            <a href="listar/veiculos" class="btn btn-info">
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
                    <td width="10%">Modelo</td>
                    <td width="10%">Marca</td>
                    <td width="10%">Cor</td>
                    <td width="10%">Tipo</td>
                    <td width="10%">Ano do Modelo</td>
                    <td width="10%">Ano de Fabricação</td>
                    <td width="10%">Valor</td>
                    <td width="10%">Foto</td>
                    <td width="10%">Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include "libs/api.php";

                $dados = callAPI('GET', '/api/veiculo')['data'];
                //$dados = callAPI('GET','/api/veiculo')['data'];


                $imagem = "{$dados->foto}p.jpg";
                $imagemg = "{$dados->foto}g.jpg";

                foreach ($dados as $key => $value) {

                    if ($value->id_tipo == 0) {
                        $tipo = "Seminovo";
                    } else {
                        $tipo  = "Novo";
                    }

                    $dataCor = callAPI('GET', '/api/cor/' . $value->id_cor)['data'];
                    $cor = $dataCor->cor;

                    $dataMarca = callAPI('GET', '/api/marca/' . $value->id_marca)['data'];
                    $marca = $dataMarca->marca;


                    $valor  = number_format($value->valor, 2, ',', '.');
                    $ano_modelo = new DateTime($value->ano_modelo);
                    $ano_fabricacao = new DateTime($value->ano_fabricacao);
                ?>
                    <tr>
                        <td><?= $value->id ?></td>
                        <td><?= $value->modelo ?></td>
                        <td><?= $marca ?></td>
                        <td><?= $cor ?></td>
                        <td><?= $tipo ?></td>
                        <td><?= $ano_modelo->format('Y') ?></td>
                        <td><?= $ano_fabricacao->format('Y') ?></td>
                        <td>R$ <?= $valor ?></td>
                        <td>
                            <a href="<?= $imagemg ?>" data-lightbox="foto" title="<?= $value->modelo ?>">
                                <img src="<?= $imagem ?>" alt="<?= $value->modelo ?>" width="100px">
                            </a>
                        </td>
                        <td>
                            <a href="cadastros/veiculos/<?= $value->id ?>" class="btn btn-success btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="javascript:excluir(<?= $value->id ?>)" class="btn btn-danger btn-sm">
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
            title: 'Deseja realmente excluir este veículo?',
            showCancelButton: true,
            confirmButtonText: `Sim`,
            cancelButtonText: `Não`,
        }).then((result) => {
            if (result.isConfirmed) {
                //enviar para excluir
                location.href = 'excluir/veiculos/' + id;
            }
        })
    }
</script>
<script src="js/dataTable.js"></script>