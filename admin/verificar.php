<?php
	//iniciar a sessao
	session_start();

	if ( $_POST ) {

		//recuperar os dados do formulário
		$login = trim ( $_POST['login'] ?? NULL );
		$senha = trim ( $_POST['senha'] ?? NULL );

		//echo $senha;

		//verificar se os campos foram preenchidos
		if ( empty ( $login ) ) {
			echo "<script>alert('Digite um login');history.back();</script>";
			exit;
		} else if ( empty ( $senha ) ) {
			echo "<script>alert('Digite uma senha');history.back();</script>";
			exit;
		}

		include "libs/api.php";
		$dados = callAPI('GET', 'http://192.168.0.105:8080/api/login');
		$dados2 = callAPI('GET', 'http://192.168.0.105:8080/api/usuario');
		//incluir o arquivo de conexao com o banco
		//include "libs/conectar.php";

		//comando sql para selecione o login
		//$sql = "select * from usuario where login = :login limit 1";
		//preparar o sql para execução
		//$consulta = $pdo->prepare($sql);
		//passar o parametro
		//$consulta->bindParam(':login', $login);
		//executo o sql
		//$consulta->execute();
		//recuperar os resultados do sql
		//$dados = $consulta->fetch(PDO::FETCH_OBJ);
		//print_r (json_encode($dados2["data"]));exit;
		$dados=array("id"=>1,"login"=>"bruno","senha"=>"1234","id_usuario"=>1);
		$dados2=array("id_usuario"=>1,"nome"=>"Bruno Gabriel","sobrenome"=>"Silva","email"=>"bruno.gabriel@gmail.com","data_nascimento"=>"2002-06-26");
		

		//print_r($dados["senha"]);
		
		
		if ( $login != $dados["login"] ) {
			echo "<script>alert('Usuário inexistente');history.back();</script>";
			exit;
		} else if ( $senha != $dados["senha"] ) {
			echo "<script>alert('Usuário ou senha incorretos');history.back();</script>";
			exit;
		}

		//abrir uma variavel na sessao e gravar os dados

		
		$_SESSION["jaguar"] = array("id"=>$dados["id"], "login"=>$dados["login"], "nome"=>$dados2["nome"]); 
		//redirecionar para uma tela home
		header("Location: paginas/home");

		exit;
		

	} 

	echo "<script>alert('Requisição inválida, preencha os dados do formulário');history.back();</script>";

		