<?php

	//criar uma conexao com um banco - PDO
	//constante
	define('SERVER','database.cxjpuvck2yfu.sa-east-1.rds.amazonaws.com');
	define('BANCO', 'alfa27');
	define('USUARIO', 'admin');
	define('SENHA', 'password');
	define('PORTA', '3306');

	try {
		//tentar realizar a conexão
		$pdo = new PDO("mysql:host=".SERVER.";dbname=".BANCO.";charset=utf8;",USUARIO,SENHA,);

	} catch (PDOException $erro) {
		echo '<p>Erro ao tentar conectar no banco de dados:</p>';
		//mostrar a mensagem de erro da conexao
		echo $erro->getMessage();
	}