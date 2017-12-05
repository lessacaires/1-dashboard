<?php
/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

$consulta = filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_SPECIAL_CHARS);
$usuarios = select(dbConnect(), 'usuarios', "WHERE CONCAT_WS( ' ', usu_nome, usu_login, usu_email, usu_cpf) LIKE '%{$consulta}%'");

if (0 < count($usuarios)):
    foreach ($usuarios as $rows):
        ?>
        <tr>
            <td><?= $rows["usu_id"]; ?></td>
            <td><?= $rows["usu_nome"]; ?></td>
            <td><?= $rows["usu_email"]; ?></td>
            <td><?= $rows["usu_login"]; ?></td>
            <td><?= date("d/m/Y H:i:s", strtotime($rows["usu_data_cad"])); ?></td>
            <td><?= date("d/m/Y H:i:s", strtotime($rows["usu_update"])); ?></td>
            <td><?= ($rows["usu_nivel_acesso_id"] == 1 ? "admin" : "usuário"); ?></td>
            <td><?= ($rows["usu_status"] == 1 ? "<span type=\"button\" class=\"btn btn-sm  btn-success\">ativo</span>" : "<span type=\"button\" class=\"btn btn-sm  btn-danger\">inativo</span>"); ?></td>
            <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#visualizaModalUsuario" data-codigo="<?= $rows['usu_id']; ?>" data-nome="<?= $rows['usu_nome']; ?>" data-email="<?= $rows['usu_email']; ?>" data-login="<?= $rows['usu_login']; ?>" data-senha="<?= $rows['usu_senha']; ?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id']; ?>" data-status="<?= $rows['usu_status']; ?>" data-cad="<?= $rows['usu_data_cad']; ?>"  data-update="<?= $rows['usu_update']; ?>">Visualizar</button></td>
            <td><button type="button" class="btn btn-sm btn-warning" <?= ((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioId'] != $rows["usu_id"])) ? 'disabled' : ''); ?> data-toggle="modal" data-target="#editeModalUsuario" data-codigo="<?= $rows['usu_id']; ?>" data-nome="<?= $rows['usu_nome']; ?>" data-email="<?= $rows['usu_email']; ?>" data-login="<?= $rows['usu_login']; ?>" data-senha="<?= $rows['usu_senha']; ?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id']; ?>" data-status="<?= $rows['usu_status']; ?>" data-cad="<?= $rows['usu_data_cad']; ?>"  data-update="<?= $rows['usu_update']; ?>">Editar</button></td>
            <td><button type="button" class="btn btn-sm btn-danger" <?= ($_SESSION['usuarioNivelAcesso'] != '1' ? 'disabled' : ''); ?> data-toggle="modal" data-target="#deletaModalUsuario" data-codigo="<?= $rows['usu_id']; ?>" data-nome="<?= $rows['usu_nome']; ?>" data-email="<?= $rows['usu_email']; ?>" data-login="<?= $rows['usu_login']; ?>" data-senha="<?= $rows['usu_senha']; ?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id']; ?>" data-cad="<?= $rows['usu_data_cad']; ?>"  data-status="<?= $rows['usu_status']; ?>" data-update="<?= $rows['usu_update']; ?>">Excluir</button></td>
        </tr>
        <?php
    endforeach;
else:
    ?>
    <tr>
        <td colspan="20" class="col-no-register">A busca não retornou valores.</td>
    </tr>
            <?php
endif;

