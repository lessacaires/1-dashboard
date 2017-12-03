<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Página para realizar login">
        <meta name="author" content="Wyliston Lessa Caires">
        <link rel="icon" href="images/login.ico">

        <title>Área Administrativa</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/signin.css" rel="stylesheet">

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
        <?php
        unset(
            $_SESSION['usuarioId'], 
            $_SESSION['usuarioNivelAcesso'], 
            $_SESSION['usuarioLogin'], 
            $_SESSION['usuarioSenha'], 
            $_SESSION['usuarioIP'], 
            $_SESSION['usuarioNome']
        );
        ?>
        <div class="container">
            <form class="form-signin" method="POST" action="proccess/valida-login.php">
                <h2 class="form-signin-heading text-center">Área para Usuários Cadastrados</h2>
                <label for="inputEmail" class="sr-only">Digite o seu Usuário</label>
                <input type="text" name="usuario" class="form-control" placeholder="Digite seu Usuário" required autofocus><br />
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="senha" class="form-control" placeholder="Digite sua Senha" required><br />
                <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
            </form>
            <p class="text-center text-danger">
                <?php
                if (isset($_SESSION["loginError"])):
                    echo $_SESSION["loginError"];
                    unset($_SESSION["loginError"]);
                endif;
                ?>
            </p>
        </div> <!-- /container -->


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
