<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

$bloquear = filter_input(INPUT_POST, 'bloquear', FILTER_SANITIZE_ENCODED);

if (isset($bloquear)):
    $cad['promo_obs'] = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_ENCODED);
    $cad['promo_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_ENCODED);
    $cad['promo_situacao'] = 0;
    
    $promotor = select(dbConnect(), 'promotores', 'WHERE promo_id = :promo_id', array('promo_id' => $cad['promo_id']));
    
    if (update(DOCUMENT_ROOT . '/logs/logs.txt', dbConnect(), 'promotores', $cad, "promo_id = :promo_id")):
        $promotor = $promotor[0];
    
        adicionaLog(DOCUMENT_ROOT . '/logs/logs.txt', $_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_BLOQUEIO, 'promotores', $cad['promo_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" bloqueou o promotor \"{$promotor['promo_nome']}\".");
        
        $_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Promotor bloqueado com sucesso!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    else:
        $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao bloquear!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    endif;
endif;
