<?php
	session_start();
	include_once("../conexao.php");
	include_once("../seguranca.php");
	
$bloquear = filter_input(INPUT_POST, 'bloquear', FILTER_SANITIZE_SPECIAL_CHARS);

if(isset($bloquear)):
	$cad['obs']    = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['codigo'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$sqlObs = "UPDATE promotores SET promo_obs = '".$cad['obs']."', promo_bloqueado = '0' where promo_id = '" . $cad['codigo'] . "'";
	$result = mysqli_query($con, $sqlObs);
	
	if($result):
		$_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Promotor bloqueado com sucesso!</p>";
		header("Location: ../principal.php?pag=listar-promotores");
	else:
		$_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao bloquear!</p>";
		header("Location: ../principal.php?pag=listar-promotores");
	endif;
endif;