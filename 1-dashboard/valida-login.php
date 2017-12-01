<?php 
	session_start();
	include_once("conexao.php");
	
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
	$senha = md5($senha);
	
	$query = "SELECT * FROM usuarios WHERE usu_login = '".$usuario."' AND usu_senha = '".$senha."' AND usu_status = '1' LIMIT 1";
	$return = mysqli_query($con, $query);
	$result = mysqli_fetch_array($return);	
	if(empty($result)):
		$_SESSION["loginError"] = "Usuário ou Senha invalido!";
		header('Location: index.php');
	else:	
		$_SESSION['usuarioId'] 			= $result['usu_id'];
		$_SESSION['usuarioNivelAcesso'] = $result['usu_nivel_acesso_id'];
		$_SESSION['usuarioLogin'] 		= $result['usu_login'];
		$_SESSION['usuarioSenha'] 		= $result['usu_senha'];
		$_SESSION['usuarioIP'] 			= $_SERVER['REMOTE_ADDR'];
		$_SESSION['usuarioNome'] 		= $result['usu_nome'];
		$_SESSION['usuarioNivelAcesso'] = $result['usu_nivel_acesso_id'];
		
		header('Location: principal.php');
	endif;
?>