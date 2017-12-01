<?php
	session_start();
	include_once("../conexao.php");
	include_once("../seguranca.php");

if(isset($_POST["excluir"])):
	$del['codigo'] 			= filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
	$del['nome'] 			= filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$del['email'] 			= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
	$del['usuario'] 		= filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
	$del['senha'] 			= filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
	$del['nivel_acesso_id'] = filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
	$del["usu_data"]		= filter_input(INPUT_POST, 'data_cad', FILTER_SANITIZE_SPECIAL_CHARS);
	$del["status"]			= filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
	
	if($del['codigo'] == $_SESSION['usuarioId']):
			$_SESSION["warning"] = "<p id=\"warning\" style='padding:10px' class='bg-warning text-warning'>Não é permitido excluir o usuário logado!</p>";
			header("Location: ../principal.php?pag=listar-usuarios");
	else:
	$sqldel = "DELETE FROM usuarios WHERE usu_id = '".$del['codigo']."'";
	$result = mysqli_query($con, $sqldel);
	
		if($result):
			$_SESSION["delSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Deletado com sucesso!</p>";
			header("Location: ../principal.php?pag=listar-usuarios");
		else:
			$_SESSION["delError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao deletar cadastro!</p>";
			header("Location: ../principal.php?pag=listar-usuarios");
		endif;
	endif;
endif;
?>