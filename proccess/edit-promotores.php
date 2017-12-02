<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

if (isset($_POST["edite"])):
    $cad['promo_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_rg'] = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_cpf'] = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_ctps'] = filter_input(INPUT_POST, 'ctps', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_status"] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_obs"] = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_update"] = date('Y-m-d H:i:s');
    $cad["promo_aso"] = filter_input(INPUT_POST, 'aso', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_ficha_reg"] = filter_input(INPUT_POST, 'ficha_reg', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_comp_res"] = filter_input(INPUT_POST, 'comp_res', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_carta'] = filter_input(INPUT_POST, 'carta', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_situacao"] = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_empresa"] = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_SPECIAL_CHARS);
    
    /** Verificação dos checkboxes */
    $cad['promo_carta'] = (isset($cad['promo_carta']) && ('on' === $cad['promo_carta'])) ? 1 : 0;
    $cad['promo_ficha_reg'] = (isset($cad['promo_ficha_reg']) && ('on' === $cad['promo_ficha_reg'])) ? 1 : 0;
    $cad['promo_comp_res'] = (isset($cad['promo_comp_res']) && ('on' === $cad['promo_comp_res'])) ? 1 : 0;
    $cad['promo_aso'] = (isset($cad['promo_aso']) && ('on' === $cad['promo_aso'])) ? 1 : 0;

    if (update(dbConnect(), 'promotores', $cad, "promo_id = :promo_id")):
        $_SESSION["editSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Atualizado com sucesso!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    else:
        $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao atualizar cadastro!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    endif;
endif;
