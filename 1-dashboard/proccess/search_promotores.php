<?php

session_start();

include_once("../conexao.php");
include_once("../seguranca.php");

$consulta = filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_SPECIAL_CHARS);

$sqlConsulta  = "SELECT * FROM promotores WHERE CONCAT_WS( ' ', promo_nome, promo_cpf, promo_rg, promo_empresa, promo_ctps) LIKE '%".$consulta."%'";
$execConsulta = mysqli_query($con, $sqlConsulta);
		
	while($rows = mysqli_fetch_array($execConsulta)):
?>
  <tr>
	<td><?=$rows["promo_id"];?></td>
	<td><?=$rows["promo_nome"];?></td>
	<td><?=$rows["promo_cpf"];?></td>
	<td><?=$rows["promo_rg"];?></td>
	<td><?=$rows["promo_ctps"];?></td>
	<td><?=$rows["promo_empresa"];?></td>
	<td><?=($rows["promo_status"] == 1 ? "<span type=\"button\" class=\"btn btn-sm  btn-success\">ativo</span>" : "<span type=\"button\" class=\"btn btn-sm  btn-danger\">inativo</span>");?></td>
	<td><?=($rows["promo_bloqueado"] == 0 ? "<span type=\"button\" class=\"btn btn-sm  btn-success\">Livre</span>" : "<span type=\"button\" class=\"btn btn-sm  btn-danger\">Bloqueado</span>");?></td>
	<td><?=date("d/m/Y", strtotime($rows["promo_data_cad"]));?></td>
	<td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#visualizaModal" data-codigo="<?= $rows['promo_id'];?>" data-nome="<?= $rows['promo_nome'];?>" data-cpf="<?= $rows['promo_cpf'];?>" data-rg="<?= $rows['promo_rg'];?>" data-senha="<?= $rows['promo_ctps'];?>" data-obs="<?= $rows['promo_obs'];?>" data-status="<?= $rows['promo_status'];?>" data-cad="<?= $rows['promo_data_cad'];?>"  data-update="<?= $rows['promo_update'];?>"  data-bloqueado="<?= $rows['promo_bloqueado'];?>"  data-ficha-reg="<?= $rows['promo_ficha_reg'];?>"  data-carta="<?= $rows['promo_carta'];?>"  data-empresa="<?= $rows['promo_empresa'];?>"  data-aso="<?= $rows['promo_aso'];?>"  data-comp-res="<?= $rows['promo_comp_res'];?>"  data-obs="<?= $rows['promo_obs'];?>">Visualizar</button></td>
	<td><button type="button" class="btn btn-sm btn-warning"data-codigo="<?= $rows['promo_id'];?>" data-toggle="modal" data-target="#editeModal"  data-nome="<?= $rows['promo_nome'];?>" data-cpf="<?= $rows['promo_cpf'];?>" data-rg="<?= $rows['promo_rg'];?>" data-senha="<?= $rows['promo_ctps'];?>" data-obs="<?= $rows['promo_obs'];?>" data-status="<?= $rows['promo_status'];?>" data-cad="<?= $rows['promo_data_cad'];?>"  data-update="<?= $rows['promo_update'];?>"  data-bloqueado="<?= $rows['promo_bloqueado'];?>"  data-ficha-reg="<?= $rows['promo_ficha_reg'];?>"  data-carta="<?= $rows['promo_carta'];?>"  data-empresa="<?= $rows['promo_empresa'];?>"  data-aso="<?= $rows['promo_aso'];?>"  data-comp-res="<?= $rows['promo_comp_res'];?>"  data-obs="<?= $rows['promo_obs'];?>">Editar</button></td>
	<td><button type="button" class="btn btn-sm btn-danger" <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["usu_nivel_acesso_id"]))?'disabled':'');?>  data-toggle="modal" data-target="#deletaModal" data-codigo="<?= $rows['promo_id'];?>" data-nome="<?= $rows['promo_nome'];?>" data-cpf="<?= $rows['promo_cpf'];?>" data-rg="<?= $rows['promo_rg'];?>" data-senha="<?= $rows['promo_ctps'];?>" data-obs="<?= $rows['promo_obs'];?>" data-status="<?= $rows['promo_status'];?>" data-cad="<?= $rows['promo_data_cad'];?>"  data-update="<?= $rows['promo_update'];?>"  data-bloqueado="<?= $rows['promo_bloqueado'];?>"  data-ficha-reg="<?= $rows['promo_ficha_reg'];?>"  data-carta="<?= $rows['promo_carta'];?>"  data-empresa="<?= $rows['promo_empresa'];?>"  data-aso="<?= $rows['promo_aso'];?>"  data-comp-res="<?= $rows['promo_comp_res'];?>"  data-obs="<?= $rows['promo_obs'];?>">Excluir</button></td>
  </tr>		
<?php endwhile;?>