<?php

session_start();

include_once("../lib/stdsql.php");
include_once("../seguranca.php");

if (isset($_POST["cadastra"])):
    $cad['usu_nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['usu_email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['usu_login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['usu_senha'] = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad['usu_nivel_acesso_id'] = filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["usu_data_cad"] = filter_input(INPUT_POST, 'data_cad', FILTER_SANITIZE_SPECIAL_CHARS);
    $cad["usu_status"] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    $emailExistente = select($PDOCon, 'usuarios', 'WHERE usu_email = :usu_email', array('usu_email' => $cad['usu_email']));

    if (0 == count($emailExistente)):
        $loginExistente = select($PDOCon, 'usuarios', 'WHERE usu_login = :usu_login', array('usu_login' => $cad['usu_login']));

        if (0 == count($loginExistente)):
            if (insert($PDOCon, 'usuarios', $cad)):
                $_SESSION["cadSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Cadastrado com sucesso!</p>";
                header("Location: ../principal.php?pag=listar-usuarios");
            else:
                $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro!</p>";
                header("Location: ../principal.php?pag=listar-usuarios");
            endif;
        else:
            $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Login já cadastrado!</p>";
            header("Location: ../principal.php?pag=listar-usuarios");
        endif;
    else:
        $_SESSION["cadError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao realizar cadastro! Email já cadastrado!</p>";
        header("Location: ../principal.php?pag=listar-usuarios");
    endif;


endif;
?>
