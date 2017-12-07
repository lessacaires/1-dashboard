<?php
/** Abre a sessção */
session_start();
ob_start();

/** Inclusão do script das configurações do sistema. */
require('config/config.php');

/** Inclusão do script das constantes, MACROS e variáveis globais. */
require('config/variaveis.php');

/** Inclusão do script para trabalhar com SQL. */
require('lib/sql.php');

/** Inclusão do script para trabalhar com sessões. */
require('lib/sessao.php');

/** Inclusão do script com funções para manipulação do conteúdo. */
require('lib/conteudo.php');

/** Verifica se o usuário tem permissão para permanecer na página */
require('proccess/seguranca.php');

$usuario = select(dbConnect(), 'usuarios', 'WHERE usu_id = :usu_id AND usu_login = :usu_login', array(
    'usu_id' => $_SESSION['usuarioId'],
    'usu_login' => $_SESSION['usuarioLogin'],
));

if (0 === count($usuario)):
    $_SESSION['loginError'] = 'Usuário não existe';
    header("Location: index.php");
else:
    $usuario = $usuario[0];
endif;

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="images/login.ico">

        <title>Administrativo</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css?<?= time(); ?>" rel="stylesheet">

        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css?<?= time(); ?>" rel="stylesheet">

        <!--IE10 viewport hack for Surface/desktop Windows 8 bug--> 
        <link href="css/ie10-viewport-bug-workaround.css?<?= time(); ?>" rel="stylesheet">

        <!--Custom styles for this template--> 
        <link href="css/theme.css?<?= time(); ?>" rel="stylesheet">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!--Fixed navbar--> 
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar">texte</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="principal.php">Assaí</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="principal.php?pag=listar-usuarios">Usuários registrados</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Promotores <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="principal.php?pag=listar-promotores">Promotores registrados</a></li>
                                <li role="separator" class="divider"></li>
                                <li ><a href="#" id="inoutPromotores" data-backdrop="static" data-toggle="modal" data-target="#inoutPromotoresModal">Registrar Entrada/Saída</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="principal.php?pag=promotores-presentes">Promotores presentes</a></li>
                                <li><a href="principal.php?pag=historico">Histórico</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['usuarioNome']; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#visualizaModalUsuario" data-codigo="<?= $usuario['usu_id']; ?>" data-nome="<?= $usuario['usu_nome']; ?>" data-email="<?= $usuario['usu_email']; ?>" data-login="<?= $usuario['usu_login']; ?>" data-senha="<?= $usuario['usu_senha']; ?>" data-nivel-acesso="<?= $usuario['usu_nivel_acesso_id']; ?>" data-status="<?= $usuario['usu_status']; ?>" data-cad="<?= $usuario['usu_data_cad']; ?>"  data-update="<?= $usuario['usu_update']; ?>">Dados do Usuário</a></li>
                                <?php if (eAdmin($_SESSION['usuarioId'], $_SESSION['usuarioLogin'])): ?>
                                <li><a href="principal.php?pag=logs">Logs</a></li>
                                <?php endif; ?>
                                <li><a href="proccess/sair.php">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div> <!--/.nav-collapse -->
            </div>
        </nav>

