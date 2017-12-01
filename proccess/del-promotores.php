<?php

session_start();

include_once("../lib/stdsql.php");
include_once("../seguranca.php");

if (isset($_POST["excluir"])):
    $del['promo_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);

    if (delete($PDOCon, 'promotores', $del, 'promo_id = :promo_id')):
        $_SESSION["delSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Deletado com sucesso!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    else:
        $_SESSION["delError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao deletar cadastro!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    endif;
endif;
?>
