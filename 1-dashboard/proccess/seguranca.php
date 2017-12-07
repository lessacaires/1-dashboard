<?php

if(!validaSessao((isset($_SESSION['usuarioId']) ? $_SESSION['usuarioId'] : null),
                 (isset($_SESSION['usuarioLogin']) ? $_SESSION['usuarioLogin'] : null))):
    
    apagaSessaoUsuario();
    
    $_SESSION["loginError"] = "Área restrita à usuários cadastrados!";
    header("Location: ../index.php");
endif;
