<?php

session_start();

include_once("../conexao.php");
include_once("../seguranca.php");

$consulta = filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_SPECIAL_CHARS);

$sqlConsulta  = "SELECT * FROM usuarios WHERE usu_nome LIKE '%".$consulta."%'";
$execConsulta = mysqli_query($con, $sqlConsulta);

while($rows = mysqli_fetch_array($execConsulta)):
?>

<tr>
<td><?=$rows["usu_id"];?></td>
<td><?=$rows["usu_nome"];?></td>
<td><?=$rows["usu_email"];?></td>
<td><?=$rows["usu_login"];?></td>
<td><?=date("d/m/Y H:i:s", strtotime($rows["usu_data_cad"]));?></td>
<td><?=date("d/m/Y H:i:s", strtotime($rows["usu_update"]));?></td>
<td><?=($rows["usu_nivel_acesso_id"] == 1 ? "admin" : "usuário");?></td>
<td><?=($rows["usu_status"] == 1 ? "<span type=\"button\" class=\"btn btn-sm  btn-success\">ativo</span>" : "<span type=\"button\" class=\"btn btn-sm  btn-danger\">inativo</span>");?></td>
<td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#visualizaModal" data-codigo="<?= $rows['usu_id'];?>" data-nome="<?= $rows['usu_nome'];?>" data-email="<?= $rows['usu_email'];?>" data-login="<?= $rows['usu_login'];?>" data-senha="<?= $rows['usu_senha'];?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id'];?>" data-status="<?= $rows['usu_status'];?>" data-cad="<?= $rows['usu_data_cad'];?>"  data-update="<?= $rows['usu_update'];?>">Visualizar</button></td>
<td><button type="button" class="btn btn-sm btn-warning" <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["usu_nivel_acesso_id"]))?'disabled':'');?> data-toggle="modal" data-target="#editeModal" data-codigo="<?= $rows['usu_id'];?>" data-nome="<?= $rows['usu_nome'];?>" data-email="<?= $rows['usu_email'];?>" data-login="<?= $rows['usu_login'];?>" data-senha="<?= $rows['usu_senha'];?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id'];?>" data-status="<?= $rows['usu_status'];?>" data-update="<?= $rows['usu_update'];?>">Editar</button></td>
<td><button type="button" class="btn btn-sm btn-danger" <?=($_SESSION['usuarioNivelAcesso'] != '1'?'disabled':'');?> data-toggle="modal" data-target="#deletaModal" data-codigo="<?= $rows['usu_id'];?>" data-nome="<?= $rows['usu_nome'];?>" data-email="<?= $rows['usu_email'];?>" data-login="<?= $rows['usu_login'];?>" data-senha="<?= $rows['usu_senha'];?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id'];?>" data-status="<?= $rows['usu_status'];?>" data-update="<?= $rows['usu_update'];?>">Excluir</button></td>
</tr>
<?php
endwhile;