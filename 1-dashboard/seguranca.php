<?php
ob_start();

$sql = "select usu_status from usuarios where usu_status = '1' and usu_id = '".$_SESSION['usuarioId']."'";
$statusSql = mysqli_query($con, $sql);
$result = mysqli_fetch_array($statusSql);

if( is_null($result) ||
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