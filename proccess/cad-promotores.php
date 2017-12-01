<?php

session_start();
include_once("../lib/stdsql.php");
include_once("../seguranca.php");

if (isset($_POST["cadastra"])):
    $cad['promo_nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_rg'] = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_cpf'] = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['promo_ctps'] = filter_input(INPUT_POST, 'ctps', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_status"] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_obs"] = '';
    $cad["promo_data_cad"] = filter_input(INPUT_POST, 'data_cad', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["promo_update"] = '';
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

    if (insert($PDOCon, 'promotores', $cad)):
        $_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Cadastrado com sucesso!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    else:
        $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro!</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    endif;
endif;
?>
