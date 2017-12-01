<?php
	session_start();
	include_once("../conexao.php");
	include_once("../seguranca.php");
	
if(isset($_POST["cadastra"])):
	$cad['nome'] 			= filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['email'] 			= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['usuario'] 		= filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['senha'] 			= filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad['nivel_acesso_id'] = filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["data_cad"]		= filter_input(INPUT_POST, 'data_cad', FILTER_SANITIZE_SPECIAL_CHARS);
	$cad["status"]			= filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

	$sql = "select usu_id from usuarios where usu_email = '".$cad['email']."' ";
	$emailSql = mysqli_query($con, $sql);
	$result = mysqli_fetch_array($emailSql);
	
	if (is_null($result)):
		$sql = "select usu_id from usuarios where usu_login = '".$cad['usuario']."' ";
		$loginSql = mysqli_query($con, $sql);
		$result = mysqli_fetch_array($loginSql);
		
		if (is_null($result)):
			$sqlCad = "INSERT INTO usuarios(usu_nome, usu_senha, usu_login, usu_email, usu_data_cad, usu_nivel_acesso_id, usu_status) VALUES ('".$cad['nome']."','".md5($cad['senha'])."','".$cad['usuario']."','".$cad['email']."','".$cad["data_cad"]."','".$cad['nivel_acesso_id']."','".$cad['status']."')";
			$result = mysqli_query($con, $sqlCad);
			
			if($result):
				$_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Cadastrado com sucesso!</p>";
				header("Location: ../principal.php?pag=listar-usuarios");
			else:
				$_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro!</p>";
				header("Location: ../principal.php?pag=listar-usuarios");
			endif;
		else:
			$_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Login já cadastrado!</p>";
			header("Location: ../principal.php?pag=listar-usuarios");
		endif;
	else:
		$_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Email já cadastrado!</p>";
		header("Location: ../principal.php?pag=listar-usuarios");
	endif;
	
			
endif;
?>