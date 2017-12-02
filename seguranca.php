<?php

if(usuarioEstaAtivo($_SESSION['usuarioId'], 1) ||
    (($_SESSION['usuarioId'] == "") ||
    ($_SESSION['usuarioNome'] == "")||
    ($_SESSION['usuarioLogin'] == "")||
    ($_SESSION['usuarioSenha'] == "")||
    ($_SESSION['usuarioNivelAcesso'] == ""))):
    
    unset(
        $_SESSION['usuarioId'],
        $_SESSION['usuarioNivelAcesso'],
        $_SESSION['usuarioLogin'],
        $_SESSION['usuarioSenha'],
        $_SESSION['usuarioIP'],
        $_SESSION['usuarioNome']
    );

    $_SESSION["loginError"] = "Área restrita à usuários cadastrados!";
    header("Location: index.php");
endif;
