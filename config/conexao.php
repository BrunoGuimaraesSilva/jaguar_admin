<?php
	
	//servidor do banco de dados
	$servidor = "database.cxjpuvck2yfu.sa-east-1.rds.amazonaws.com";
	//usuario de conexao com o banco
	$usuario  = "admin";
	//senha de conexao com o banco
	$senha    = "password";
	//nome do banco de dados
	$banco    = "alfa_burnes";
	$porta    = "3306";

	//$con - conexao(servidor, usuario, senha, banco)
	$con = mysqli_connect($servidor,$usuario,$senha,$banco,$porta) or die ("Erro ao conectar no banco. Erro: ".mysqli_connect_error());
	//configurando os caracteres da conexao
	mysqli_set_charset($con,"utf8");
	