<?php

	//iniciar a sessao
	session_start();

	//apagar a sessao submarino
	unset( $_SESSION['jaguar'] );

	//redirecionar para a página inicial
	header("Location: index.php");