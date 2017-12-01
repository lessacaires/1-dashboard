<?php
ob_start();

$dados = array(
    'usu_id' => $_SESSION['usuarioId'],
    'usu_status' => 1
);

$usuario = select($PDOCon, 'usuarios', 'WHERE usu_id = :usu_id AND usu_status = :usu_status', $dados);

if( (0 === count($usuario)) ||
	(($_SESSION['usuarioId'] == "") ||
	($_SESSION['usuarioNome'] == "")||
	($_SESSION['usuarioLogin'] == "")||
	($_SESSION['usuarioSenha'] == "")||
	($_SESSION['usuarioNivelAcesso'] == ""))):
	unset(
			$_SESSION['usuarioId'],
			$_SESSION['usuarioNivelAcesso'],
			$_SESSION['usuarioLogin'],
			$_SESSION['usuarioSenha'],
			$_SESSION['usuarioIP'],
			$_SESSION['usuarioNome']
		);
		$_SESSION["loginError"] = "Área restrita à usuários cadastrados!";
	header("Location: index.php");
endif;
