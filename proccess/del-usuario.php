<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

if (isset($_POST["excluir"])):
    $del['usu_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
    
    /** Verifica se é um admin que está realizando a operação. */
    if (eAdmin($_SESSION['usuarioId'], $_SESSION['usuarioLogin'])):
        if ($del['usu_id'] == $_SESSION['usuarioId']):
            $_SESSION["warning"] = "<p id=\"warning\" style='padding:10px' class='bg-warning text-warning'>Não é permitido excluir o usuário logado!</p>";
            header("Location: ../principal.php?pag=listar-usuarios");
        else:
            
            $usuario = select(dbConnect(), 'usuarios', 'WHERE usu_id = :usu_id', array('usu_id' => $car['usu_id']));
            
            if (delete(dbConnect(), 'usuarios', $del, 'usu_id = :usu_id')):
                $usuario = $usuario[0];
            
                adicionaLog($_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_EXCLUIR, 'usuarios', $del['usu_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" excluiu o usuário \"{$usuario['usu_login']}\".");
                
                $_SESSION["delSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Deletado com sucesso!</p>";
                header("Location: ../principal.php?pag=listar-usuarios");
            else:
                $_SESSION["delError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao deletar cadastro!</p>";
                header("Location: ../principal.php?pag=listar-usuarios");
            endif;
        endif;
    else:
        $_SESSION["delError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao deletar cadastro! Você não tem permissão para excluir usuários!</p>";
        header("Location: ../principal.php?pag=listar-usuarios");
    endif;
endif;
