<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

if (isset($_POST["cadastra"])):
    $cad['promo_nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_ENCODED);
    $cad['promo_rg'] = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_ENCODED);
    $cad['promo_cpf'] = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_ENCODED);
    $cad['promo_ctps'] = filter_input(INPUT_POST, 'ctps', FILTER_SANITIZE_ENCODED);
    $cad["promo_status"] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_ENCODED);
    $cad["promo_obs"] = '';
    $cad["promo_data_cad"] = filter_input(INPUT_POST, 'data_cad', FILTER_SANITIZE_ENCODED);
    $cad["promo_aso"] = filter_input(INPUT_POST, 'aso', FILTER_SANITIZE_ENCODED);
    $cad["promo_ficha_reg"] = filter_input(INPUT_POST, 'ficha_reg', FILTER_SANITIZE_ENCODED);
    $cad["promo_comp_res"] = filter_input(INPUT_POST, 'comp_res', FILTER_SANITIZE_ENCODED);
    $cad['promo_carta'] = filter_input(INPUT_POST, 'carta', FILTER_SANITIZE_ENCODED);
    $cad["promo_situacao"] = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_ENCODED);
    $cad["promo_empresa"] = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_ENCODED);

    /** Verificação dos checkboxes */
    $cad['promo_carta'] = (isset($cad['promo_carta']) && ('on' === $cad['promo_carta'])) ? 1 : 0;
    $cad['promo_ficha_reg'] = (isset($cad['promo_ficha_reg']) && ('on' === $cad['promo_ficha_reg'])) ? 1 : 0;
    $cad['promo_comp_res'] = (isset($cad['promo_comp_res']) && ('on' === $cad['promo_comp_res'])) ? 1 : 0;
    $cad['promo_aso'] = (isset($cad['promo_aso']) && ('on' === $cad['promo_aso'])) ? 1 : 0;
    
    /**
     * Busca por um CPF de promotor para que o novo promotor inserido não possa 
     * ter o mesmo CPF de algum outro promotor já registrado.
     */
    $cpfExistente = select(dbConnect(), 'promotores', 'WHERE promo_cpf = :promo_cpf', array('promo_cpf' => $cad['promo_cpf']));
    
    if (0 === count($cpfExistente)):
        /**
         * Busca por um CTPS de promotor para que o novo promotor inserido não
         * possa ter o mesmo CTPS de algum outro promotor já registrado.
         */
        $ctpsExistente = select(dbConnect(), 'promotores', 'WHERE promo_ctps = :promo_ctps', array('promo_ctps' => $cad['promo_ctps']));
    
        if (0 === count($ctpsExistente)):
            if (insert(dbConnect(), 'promotores', $cad)):

                adicionaLog(DOCUMENT_ROOT . '/logs/logs.txt', $_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_INSERIR, 'promotores', $cad['promo_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" adicionou o promotor \"{$cad['promo_nome']}\".");

                $_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Cadastrado com sucesso!</p>";
                header("Location: ../principal.php?pag=listar-promotores");
            else:
                $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro!</p>";
                header("Location: ../principal.php?pag=listar-promotores");
            endif;
        else:
            $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao cadastrar. CTPS já registrado.</p>";
            header("Location: ../principal.php?pag=listar-promotores");
        endif;
    else:
        $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao cadastrar. CPF já registrado.</p>";
        header("Location: ../principal.php?pag=listar-promotores");
    endif;
endif;
