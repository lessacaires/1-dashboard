<?php
/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

$consulta = filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_ENCODED);
$busca = select(dbConnect(), 'historico h', "JOIN promotores p ON p.promo_id = h.his_id_promotor WHERE CONCAT_WS( ' ', p.promo_nome) LIKE '%{$consulta}%'");

if (0 < count($busca)):
    foreach ($busca as $rows):
        ?>
        <tr>
            <td><?= $rows["his_id"]; ?></td>
            <td><?= $rows['promo_nome']; ?></td>
            <td><?= date('d-m-Y H:i:s', $rows["his_data_entrada"]); ?></td>
            <td><?= ('0' == $rows["his_data_saida"])? '---': date('d-m-Y H:i:s', $rows["his_data_saida"]); ?></td>
            <td><?= calcula_tempo_permancencia($rows["his_tempo_total"]); ?></td>
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
