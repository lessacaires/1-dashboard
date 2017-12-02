<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

$bloquear = filter_input(INPUT_POST, 'bloquear', FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($bloquear)):
    $cad['promo_obs']      = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_id']       = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_situacao'] = 0;

    if (update(dbConnect(), 'promotores', $cad, "promo_id = :promo_id")):
        $_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Promotor bloqueado com sucesso!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    else:
        $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao bloquear!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    endif;
endif;
