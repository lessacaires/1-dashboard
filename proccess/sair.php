<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

session_start();
session_destroy();
adicionaLog($_SESSION['usuarioId'], LOG_LOGOUT, 'usaurios', $cad['usu_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" encerrou uma sessão.");
unset(
    $_SESSION['usuarioId'], 				
    $_SESSION['usuarioNivelAcesso'], 
    $_SESSION['usuarioLogin'],		
    $_SESSION['usuarioSenha'], 		
    $_SESSION['usuarioIP'], 			
    $_SESSION['usuarioNome'] 		
);
header("Location: ../index.php");

