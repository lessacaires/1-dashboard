<?php
	session_start();
	include_once("../conexao.php");
	include_once("../seguranca.php");
	
if(isset($_POST["cadastra"])):
	$cad['nome'] 			= filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["empresa"]			= filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['cpf'] 			= filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['rg'] 				= filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['ctps'] 			= filter_input(INPUT_POST, 'ctps', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['carta'] 			= filter_input(INPUT_POST, 'carta', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["ficha_reg"]		= filter_input(INPUT_POST, 'ficha_reg', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["comp_res"]		= filter_input(INPUT_POST, 'comp_res', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["status"]			= filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["data_cad"]		= filter_input(INPUT_POST, 'data_cad', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["aso"]				= filter_input(INPUT_POST, 'aso', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["situacao"]		= filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["codigo"]			= filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);	
	
	$cad['carta'] = (isset($cad['carta']) && ('on' === $cad['carta'])) ? 1: 0;
	$cad['ficha_reg'] = (isset($cad['ficha_reg']) && ('on' === $cad['ficha_reg'])) ? 1: 0;
	$cad['comp_res'] = (isset($cad['comp_res']) && ('on' === $cad['comp_res'])) ? 1: 0;
	$cad['aso'] = (isset($cad['aso']) && ('on' === $cad['aso'])) ? 1: 0;
	
	$sqlCad = "INSERT INTO promotores(promo_nome, promo_empresa, promo_cpf, promo_rg, promo_ctps, promo_carta, promo_ficha_reg, promo_comp_res, promo_status, promo_data_cad, promo_aso, promo_situacao) VALUES ('".$cad['nome']."','".$cad['empresa']."','".$cad['cpf']."','".$cad['rg']."','".$cad['ctps']."','".$cad['carta']."','".$cad['ficha_reg']."','".$cad['comp_res']."','".$cad['status']."','".$cad['data_cad']."','".$cad['aso']."','".$cad['situacao']."')";

	$result = mysqli_query($con, $sqlCad);

	#echo "<pre>";
	#print_r($sqlCad);
	#echo "</pre>";
	#exit();
	
	if($result):
		$_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Cadastrado com sucesso!</p>";
		header("Location: ../principal.php?pag=listar-promotores");
	else:
		$_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro!</p>";
		header("Location: ../principal.php?pag=listar-promotores");
	endif;		
endif;
?>