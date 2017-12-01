<?php

session_start();

include_once("../lib/stdsql.php");
include_once("../seguranca.php");

if (isset($_POST["edite"])):
    $edit['usu_id'] = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_senha'] = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit['usu_nivel_acesso_id'] = filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit["usu_update"] = filter_input(INPUT_POST, 'data_edit', FILTER_SANITIZE_SPECIAL_CHARS);
    $edit["usu_status"] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    $usuario = select($PDOCon, 'usuarios', 'WHERE usu_id = :usu_id', array('usu_id' => $edit['usu_id']));

    $edit['usu_senha'] = ($usuario[0]['usu_senha'] == $edit['usu_senha']) ? $edit['usu_senha'] : md5($edit['usu_senha']);

    if (update($PDOCon, 'usuarios', $edit, 'usu_id = :usu_id')):
        $_SESSION["editSuccess"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Atualizado com sucesso!</p>";
        header("Location: ../principal.php?pag=listar-usuarios");
    else:
        $_SESSION["editError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Erro ao atualizar cadastro!</p>";
        header("Location: ../principal.php?pag=listar-usuarios");
    endif;
endif;
