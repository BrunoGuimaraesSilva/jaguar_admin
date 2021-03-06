<?php
	session_start();

	if ( ! isset ( $_SESSION['jaguar']['id'] ) ) exit;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Itens</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/sb-admin-2.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">

	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="js/sweetalert2.js"></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

	//print_r( $_GET );
	include "libs/docs.php";
	include "libs/conectar.php";

	if ( $_POST ) {
		
		//recuperar os dados digitados
		foreach ($_POST as $key => $value) {
			$$key = trim ( $value );
		}

		//recuperar o status da venda
		$sql = "select status from venda where id = :venda_id limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":venda_id", $venda_id);
		$consulta->execute();

		//recuperar os dados - status
		$dados = $consulta->fetch(PDO::FETCH_OBJ);
		//$status = $dados->status;

		if ( ( $dados->status == "P") or ( $dados->status == "C" ) ) {
			mensagem("Erro","Esta venda está paga ou cancelada não sendo possível adicionar mais produtos!","error");
			exit;
		}

		if ( empty ( $produto_id ) ) {
			mensagem("Erro","Selecione um produto","error");
			exit;
		} else if ( $quantidade <= 0 ) {
			mensagem("Erro","A quantidade deve ser maior que 0","error");
			exit;
		}

		//print_r ( $_POST );

		//verificar se já existe no banco
		$sql = "select produto_id from venda_produto
		where produto_id = :produto_id AND 
		venda_id = :venda_id limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(':produto_id', $produto_id);
		$consulta->bindParam(':venda_id', $venda_id);
		$consulta->execute();

		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//formatar o valor - funcao no docs.php
		$valor = formatarValor( $valor );

		if ( empty ( $dados->produto_id ) ){
			//se não existir - inserir
			$sql = "insert into venda_produto values(:venda_id, :produto_id, :valor, :quantidade)";

		} else {
			//se existir - atualizar
			$sql = "update venda_produto set valor = :valor, quantidade = :quantidade where venda_id = :venda_id AND produto_id = :produto_id limit 1";

		}

		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(':venda_id', $venda_id);
		$consulta->bindParam(':produto_id', $produto_id);
		$consulta->bindParam(':valor', $valor);
		$consulta->bindParam(':quantidade', $quantidade);

		//verificar se executou certo - resetar o form
		if ( $consulta->execute() ) {
			echo "<script>top.$('#formItens')[0].reset();</script>";
		}
		

	}

	//recuperar o venda_id
	$venda_id = $_GET["venda_id"] ?? $_POST["venda_id"] ?? NULL;

	//validar a venda_id
	if ( empty ( $venda_id ) ) {
		?>
		<p class="alert alert-danger">Venda inválida</p>
		<?php
		exit;
	}

	//sql para mostrar os produtos
	$sql = "select p.id, p.produto, vp.valor, 
	vp.quantidade, ( vp.valor * vp.quantidade ) total, v.status 
	from venda_produto vp 
	inner join produto p on ( p.id = vp.produto_id )
	inner join venda v on ( v.id = vp.venda_id )
	where vp.venda_id = :venda_id ";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(':venda_id', $venda_id);
	$consulta->execute();
?>
<table class="table table-hover table-striped table-bordered">
	<thead>
		<th width="5%">ID</th>
		<th width="45%">Produto</th>
		<th width="15%">Valor</th>
		<th width="10%">Qtde</th>
		<th width="15%">Total</th>
		<th width="10%">Excluir</th>
	</thead>
	<tbody>
		<?php
			$geral = 0;

			while ( $d = $consulta->fetch(PDO::FETCH_OBJ) ) {

				$disabled = NULL;
				if ( ( $d->status == "C") or ( $d->status == "P" ) ) {
					$disabled = "disabled";
				}
				

				//seprar a variaveis
				$valor = number_format($d->valor,2,
					",",
					".");
				$total = number_format($d->total,2,
					",",
					".");

				//soma do total geral
				$geral = $d->total + $geral;
				
				?>
				<tr>
					<td><?=$d->id?></td>
					<td><?=$d->produto?></td>
					<td class="text-right">R$ <?=$valor?></td>
					<td><?=$d->quantidade?></td>
					<td class="text-right">R$ <?=$total?></td>
					<td>
						<button class="btn btn-danger"onclick="excluir(<?=$venda_id?>,<?=$d->id?>)"
						<?=$disabled?> >
						 	<i class="fas fa-trash"></i>
						 </button>
					</td>
				</tr>
				<?php

			}

			$geral = number_format($geral,2,
				",",
				".");
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">TOTAL:</td>
			<td colspan="2">R$ <?=$geral?></td>
		</tr>
	</tfoot>
</table>
<script type="text/javascript">
	//passar o venda_id e o id do produto
    function excluir(venda_id, produto_id) {

        Swal.fire({
          title: 'Deseja realmente excluir este registro?',
          showCancelButton: true,
          confirmButtonText: `Sim`,
          cancelButtonText: `Não`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            //enviar para excluir
            location.href='excluirItem.php?venda_id='+venda_id+'&produto_id='+produto_id;
            //excluirItem.php?venda_id=1&produto_id=2
          } 
        })
    }
</script>