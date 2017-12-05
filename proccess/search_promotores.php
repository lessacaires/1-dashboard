<?php
/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

$consulta = filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_SPECIAL_CHARS);
$promotores = select(dbConnect(), 'promotores', "WHERE CONCAT_WS( ' ', promo_nome, promo_cpf, promo_rg, promo_empresa, promo_ctps) LIKE '%{$consulta}%'");

if (0 < count($promotores)):
    foreach ($promotores as $rows):
        ?>
        <tr>
            <td><?= $rows["promo_id"]; ?></td>
            <td><?= $rows["promo_nome"]; ?></td>
            <td><?= $rows["promo_cpf"]; ?></td>
            <td><?= $rows["promo_rg"]; ?></td>
            <td><?= $rows["promo_ctps"]; ?></td>
            <td><?= $rows["promo_empresa"]; ?></td>
            <td><?= ($rows["promo_status"] == 1 ? "<span type=\"button\" class=\"btn btn-sm  btn-success\">ativo</span>" : "<span type=\"button\" class=\"btn btn-sm  btn-danger\">inativo</span>"); ?></td>
            <td><?= ($rows["promo_situacao"] == 1 ? "<button type=\"button\" class=\"btn btn-sm  btn-success\" data-toggle=\"modal\" data-target=\"#obsModal\" data-codigo=\"" . $rows['promo_id'] . "\">Livre</button>" : "<button type=\"button\" class=\"btn btn-sm  btn-danger\" data-toggle=\"modal\" data-target=\"#obsModal\" data-codigo=\"" . $rows['promo_id'] . "\"disabled>Bloqueado</button>"); ?></td>
            <td><?= date("d/m/Y", strtotime($rows["promo_data_cad"])); ?></td>
            <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#visualizaModalPromotor" data-codigo="<?= $rows['promo_id']; ?>" data-nome="<?= $rows['promo_nome']; ?>" data-cpf="<?= $rows['promo_cpf']; ?>" data-rg="<?= $rows['promo_rg']; ?>" data-ctps="<?= $rows['promo_ctps']; ?>" data-obs="<?= $rows['promo_obs']; ?>" data-status="<?= $rows['promo_status']; ?>" data-cad="<?= $rows['promo_data_cad']; ?>"  data-update="<?= $rows['promo_update']; ?>"  data-situacao="<?= $rows['promo_situacao']; ?>"  data-ficha-reg="<?= $rows['promo_ficha_reg']; ?>"  data-carta="<?= $rows['promo_carta']; ?>"  data-empresa="<?= $rows['promo_empresa']; ?>"  data-aso="<?= $rows['promo_aso']; ?>"  data-comp-res="<?= $rows['promo_comp_res']; ?>"  data-situacao="<?= $rows['promo_situacao']; ?>">Visualizar</button></td>
            <td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editeModalPromotor"  data-codigo="<?= $rows['promo_id']; ?>" data-nome="<?= $rows['promo_nome']; ?>" data-cpf="<?= $rows['promo_cpf']; ?>" data-rg="<?= $rows['promo_rg']; ?>" data-ctps="<?= $rows['promo_ctps']; ?>" data-obs="<?= $rows['promo_obs']; ?>" data-status="<?= $rows['promo_status']; ?>" data-cad="<?= $rows['promo_data_cad']; ?>"  data-update="<?= $rows['promo_update']; ?>"  data-situacao="<?= $rows['promo_situacao']; ?>"  data-ficha-reg="<?= $rows['promo_ficha_reg']; ?>"  data-carta="<?= $rows['promo_carta']; ?>"  data-empresa="<?= $rows['promo_empresa']; ?>"  data-aso="<?= $rows['promo_aso']; ?>"  data-comp-res="<?= $rows['promo_comp_res']; ?>"  data-situacao="<?= $rows['promo_situacao']; ?>">Editar</button></td>
            <td><button type="button" class="btn btn-sm btn-danger" <?=(($_SESSION['usuarioNivelAcesso'] != '1')?'disabled':'');?> data-toggle="modal" data-target="#deletaModalPromotor"  data-codigo="<?= $rows['promo_id']; ?>" data-nome="<?= $rows['promo_nome']; ?>" data-cpf="<?= $rows['promo_cpf']; ?>" data-rg="<?= $rows['promo_rg']; ?>" data-ctps="<?= $rows['promo_ctps']; ?>" data-obs="<?= $rows['promo_obs']; ?>" data-status="<?= $rows['promo_status']; ?>" data-cad="<?= $rows['promo_data_cad']; ?>"  data-update="<?= $rows['promo_update']; ?>"  data-situacao="<?= $rows['promo_situacao']; ?>"  data-ficha-reg="<?= $rows['promo_ficha_reg']; ?>"  data-carta="<?= $rows['promo_carta']; ?>"  data-empresa="<?= $rows['promo_empresa']; ?>"  data-aso="<?= $rows['promo_aso']; ?>"  data-comp-res="<?= $rows['promo_comp_res']; ?>"  data-situacao="<?= $rows['promo_situacao']; ?>">Excluir</button></td>
        <tr>
        <?php
    endforeach;
else:
    ?>
    <tr>
        <td colspan="20" class="col-no-register">A busca não retornou valores.</td>
    </tr>
        <?php
endif;
