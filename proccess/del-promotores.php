<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

if (isset($_POST["excluir"])):
    $del['promo_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);

    $promotor = select(dbConnect(), 'promotores', 'WHERE promo_id = :promo_id', array('promo_id' => $del['promo_id']));
    
    if (delete(dbConnect(), 'promotores', $del, 'promo_id = :promo_id')):
        $promotor = $promotor[0];
    
        adicionaLog($_SESSION['usuarioId'], LOG_EXCLUIR, 'promotores', $del['promo_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" excluiu o promotor \"{$promotor['promo_nome']}\".");
            
        $_SESSION["delSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Deletado com sucesso!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    else:
        $_SESSION["delError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao deletar cadastro!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    endif;
endif;
