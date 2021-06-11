<?php
//iniciar a sessao
session_start();

if ($_POST) {

	//recuperar os dados do formulário
	$login = trim($_POST['login'] ?? NULL);
	$senha = trim($_POST['senha'] ?? NULL);

	//echo $senha;

	//verificar se os campos foram preenchidos
	if (empty($login)) {
		echo "<script>alert('Digite um login');history.back();</script>";
		exit;
	} else if (empty($senha)) {
		echo "<script>alert('Digite uma senha');history.back();</script>";
		exit;
	}

	include "libs/api.php";

	$dados = callAPI('GET', 'http://192.168.8.157:8080/api/login')['data'][0];

	if ($dados->login == $login && $dados->senha == $senha) {
		$id = $dados->id;
		$dadosUsuario = callAPI('GET', 'http://192.168.8.157:8080/api/usuario/' . $id);
		if (!$dadosUsuario['status'] == 200) {
			echo "<script>alert('Usuário incorreto');history.back();</script>";
			exit;
		}
	} else {
		echo "<script>alert('Usuário ou senha incorreta');history.back();</script>";
		exit;
	}


	$_SESSION["jaguar"] = array("id" => $dados->id, "login" => $dados->login, "nome" => $dadosUsuario["data"]->nome);
	//redirecionar para uma tela home
	header("Location: paginas/home");

	exit;
}

echo "<script>alert('Requisição inválida, preencha os dados do formulário');history.back();</script>";
