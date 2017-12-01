<?php
	session_start();
	include_once("../conexao.php");
	include_once("../seguranca.php");
	
	$codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$sql = "select usu_senha from usuarios where usu_id = ".$codigo;
	$statusSql = mysqli_query($con, $sql);
	$result = mysqli_fetch_array($statusSql);
	
	$senhaBanco = $result['usu_senha'];
	
	
if(isset($_POST["edite"])):
	$edit['nome'] 			 = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$edit['email'] 			 = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
	$edit['usuario'] 		 = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
	$edit['senha'] 			 = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
	$edit['nivel_acesso_id'] = filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
	$edit["usu_update"]		 = filter_input(INPUT_POST, 'data_edit', FILTER_SANITIZE_SPECIAL_CHARS);
	$edit["status"]			 = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$edit['senha'] = ($senhaBanco == $edit['senha']) ? $edit['senha']: md5($edit['senha']);

	$sqlEdit = "UPDATE usuarios SET usu_nome='".$edit['nome']."', usu_senha='".$edit['senha']."', usu_login='".$edit['usuario']."', usu_email='".$edit['email']."', usu_update='".$edit["usu_update"]."', usu_nivel_acesso_id='".$edit['nivel_acesso_id']."', usu_status='".$edit['status']."' WHERE usu_id = '".$codigo."'";
	$result = mysqli_query($con, $sqlEdit);
	
	
	
	if($result):
		$_SESSION["editSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Atualizado com sucesso!</p>";
		header("Location: ../principal.php?pag=listar-usuarios");
	else:
		$_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao atualizar cadastro!</p>";
		header("Location: ../principal.php?pag=listar-usuarios");
	endif;
endif;
?>