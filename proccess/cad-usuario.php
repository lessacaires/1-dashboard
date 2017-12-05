<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

if (isset($_POST["cadastra"])):
    $cad['usu_nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['usu_email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['usu_login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['usu_senha'] = md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
    $cad['usu_nivel_acesso_id'] = filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["usu_data_cad"] = filter_input(INPUT_POST, 'data_cad', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["usu_status"] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    /** Verifica se é um admin que está realizando a operação. */
    if (eAdmin($_SESSION['usuarioId'], $_SESSION['usuarioLogin'])):
        
        /** Verifica já existe o email informado. */
        $emailExistente = select(dbConnect(), 'usuarios', 'WHERE usu_email = :usu_email', array('usu_email' => $cad['usu_email']));
    
        if (0 == count($emailExistente)):
            
            /** Verifica já existe o login informado. */
            $loginExistente = select(dbConnect(), 'usuarios', 'WHERE usu_login = :usu_login', array('usu_login' => $cad['usu_login']));

            if (0 == count($loginExistente)):
                if (insert(dbConnect(), 'usuarios', $cad)):
                    
                    adicionaLog(DOCUMENT_ROOT . '/logs/logs.txt', $_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_INSERIR, 'usuarios', $cad['usu_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" adicionou o usuário \"{$cad['usu_login']}\".");
                    
                    $_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Cadastrado com sucesso!</p>";
                    header("Location: ../principal.php?pag=listar-usuarios");
                else:
                    $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro!</p>";
                    header("Location: ../principal.php?pag=listar-usuarios");
                endif;
            else:
                $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Login já cadastrado!</p>";
                header("Location: ../principal.php?pag=listar-usuarios");
            endif;
        else:
            $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Email já cadastrado!</p>";
            header("Location: ../principal.php?pag=listar-usuarios");
        endif;
    else:
        $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao deletar cadastro! Você não tem permissão para excluir usuários!</p>";
        header("Location: ../principal.php?pag=listar-usuarios");
    endif;
endif;
