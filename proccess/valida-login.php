<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = md5($senha);

$dados = array(
    'usu_login' => $usuario,
    'usu_senha' => $senha
);

$usuario = select(dbConnect(), 'usuarios', "WHERE usu_login = :usu_login AND usu_senha = :usu_senha", $dados);

if (0 == count($usuario)):
    $_SESSION["loginError"] = "Usuário ou Senha invalido!";
    header('Location: ../index.php');
else:
    $usuario = $usuario[0];

    if ('1' != $usuario['usu_status']):
        $_SESSION["loginError"] = "Usuário inativo. Entre em contato com o administrador.";
        header('Location: ../index.php');
    else:
        if (!salvaDadosSessao($usuario)):
            $_SESSION["loginError"] = "Não foi possível criar a sessão. Dados inválidos.";
            header('Location: ../index.php');
        else:
            
            adicionaLog(DOCUMENT_ROOT . '/logs/logs.txt', $_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_LOGIN, 'usaurios', $cad['usu_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" iniciou uma sessão.");
            
            if ('1' == $_SESSION['usuarioNivelAcesso']):
                header('Location: ../principal.php');
            else:
                header('Location: ../principal.php?pag=promotores-presentes');
            endif;
        endif;
    endif;
endif;
