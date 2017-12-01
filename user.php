<?php
session_start();
include_once("seguranca.php");
echo 'Bem vindo '.$_SESSION['usuarioNome'].'<br />';
echo 'Seu IP: '.$_SESSION['usuarioIP'];
?>
<br />
<a href="sair.php">Sair</a>