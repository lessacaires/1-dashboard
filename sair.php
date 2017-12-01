<?php
session_start();
session_destroy();
unset(
	$_SESSION['usuarioId'], 				
	$_SESSION['usuarioNivelAcesso'], 
	$_SESSION['usuarioLogin'],		
	$_SESSION['usuarioSenha'], 		
	$_SESSION['usuarioIP'], 			
	$_SESSION['usuarioNome'] 		
		);
header("Location: index.php");
?>