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
        $_SESSION['usuarioId'] 			= $usuario['usu_id'];
        $_SESSION['usuarioNivelAcesso'] = $usuario['usu_nivel_acesso_id'];
        $_SESSION['usuarioLogin'] 		= $usuario['usu_login'];
        $_SESSION['usuarioSenha'] 		= $usuario['usu_senha'];
        $_SESSION['usuarioIP'] 			= filter_input(INPUT_SERVER, 'REMOTE_ADDR');
        $_SESSION['usuarioNome'] 		= $usuario['usu_nome'];
        $_SESSION['usuarioNivelAcesso'] = $usuario['usu_nivel_acesso_id'];

        header('Location: ../principal.php');
    endif;
endif;
