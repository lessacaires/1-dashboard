<!DOCTYPE html>
<?php 
session_start();
include_once("conexao.php");
include_once("seguranca.php");
date_default_timezone_set('America/Recife');

$sql = "SELECT * FROM usuarios where usu_id = '".$_SESSION['usuarioId']."'";
$return = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($return);

if (is_null($rows)):
	$_SESSION["loginError"] = "SELECT * FROM usuarios where usu_id = '".$_SESSION['usuarioId']."'";
	header("Location: index.php");
endif;
?>

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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<!-- Fixed navbar -->
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
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listas <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="principal.php?pag=listar-usuarios">Usuários</a></li>
			<li><a href="principal.php?pag=listar-promotores">Promotores</a></li>
		  </ul>
		</li>
	  </ul>
	  
	  <ul class="nav navbar-nav right">
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$_SESSION['usuarioNome'];?><span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="#" data-toggle="modal" data-target="#visualizaModal" data-codigo="<?= $rows['usu_id'];?>" data-nome="<?= $rows['usu_nome'];?>" data-email="<?= $rows['usu_email'];?>" data-login="<?= $rows['usu_login'];?>" data-senha="<?= $rows['usu_senha'];?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id'];?>" data-status="<?= $rows['usu_status'];?>" data-cad="<?= $rows['usu_data_cad'];?>"  data-update="<?= $rows['usu_update'];?>">Dados do Usuário</a></li>
			<li><a href="sair.php">Sair</a></li>
		  </ul>
		</li>
	  </ul>
	</div><!--/.nav-collapse -->
  </div>
</nav>