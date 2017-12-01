<?php

session_start();

include_once("../lib/stdsql.php");
include_once("../seguranca.php");

if (isset($_POST["excluir"])):
    $del['usu_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($del['usu_id'] == $_SESSION['usuarioId']):
        $_SESSION["warning"] = "<p id=\"warning\" style='padding:10px' class='bg-warning text-warning'>Não é permitido excluir o usuário logado!</p>";
        header("Location: ../principal.php?pag=listar-usuarios");
    else:
        if (delete($PDOCon, 'usuarios', $del, 'usu_id = :usu_id')):
            $_SESSION["delSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Deletado com sucesso!</p>";
            header("Location: ../principal.php?pag=listar-usuarios");
        else:
            $_SESSION["delError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao deletar cadastro!</p>";
            header("Location: ../principal.php?pag=listar-usuarios");
        endif;
    endif;
endif;
?>
