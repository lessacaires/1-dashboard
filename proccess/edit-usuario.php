<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

if (isset($_POST["edite"])):
    $edit['usu_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_senha'] = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_nivel_acesso_id'] = filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit["usu_update"] = filter_input(INPUT_POST, 'data_edit', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit["usu_status"] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    /**
     * Faz a verificação da senha. Como no formulário permanece a senha em MD5,
     * então faz-se uma verificação se a mesma passada é igual ao MD5 do usuário
     * que se quer editar os dados.
     */
    $usuario = select(dbConnect(), 'usuarios', 'WHERE usu_id = :usu_id', array('usu_id' => $edit['usu_id']));
    $edit['usu_senha'] = ($usuario[0]['usu_senha'] == $edit['usu_senha']) ? $edit['usu_senha'] : md5($edit['usu_senha']);

    /**
     * Busca por um email de usuário que não seja do próprio usuário 
     * responsável pela operação.
     */
    $emailExistente = select(dbConnect(), 'usuarios', 'WHERE usu_id <> :usu_id AND usu_email = :usu_email', array('usu_id' => $edit['usu_id'], 'usu_email' => $edit['usu_email']));

    if (eAdmin($_SESSION['usuarioId'], $_SESSION['usuarioLogin']) || ($edit['usu_id'] === $_SESSION['usuarioId'])):
        if (0 == count($emailExistente)):
            /**
             * Busca por um login de usuário que não seja do próprio usuário
             * responsável pela operação.
             */
            $loginExistente = select(dbConnect(), 'usuarios', 'WHERE usu_id <> :usu_id AND usu_login = :usu_login', array('usu_id' => $edit['usu_id'], 'usu_login' => $edit['usu_login']));

            if (0 == count($loginExistente)):
                if (update(dbConnect(), 'usuarios', $edit, 'usu_id = :usu_id')):

                    adicionaLog($_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_ATUALIZAR, 'promotores', $edit['usu_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" atualizou os dados so usuário \"{$edit['usu_login']}\".");

                    $_SESSION["editSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Atualizado com sucesso!</p>";
                    header("Location: ../principal.php?pag=listar-usuarios");
                else:
                    $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao atualizar cadastro!</p>";
                    header("Location: ../principal.php?pag=listar-usuarios");
                endif;
            else:
                $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Login já cadastrado!</p>";
                header("Location: ../principal.php?pag=listar-usuarios");
            endif;
        else:
            $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Email já cadastrado!</p>";
            header("Location: ../principal.php?pag=listar-usuarios");
        endif;
    else:
        $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Voce precisa ser o dono da conta ou um administrador para editar os dados!</p>";
        header("Location: ../principal.php?pag=listar-usuarios");
    endif;
endif;
