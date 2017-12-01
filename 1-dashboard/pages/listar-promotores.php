<div class="page-header">
	<h1>Lista de Promotores</h1>
  </div>
  <?php
	include_once('paginacao.php');
	
	// Contagem dos promotores bloqueados
	
	$sqlBlock = "SELECT * FROM promotores";
	$result = mysqli_query($con, $sqlBlock);
	$cont = mysqli_num_rows($result);
	
	// Inicio do paginador
	
	$paginacao = new paginacao;
	
	$por_pagina  = 5;         
	$mostrar_pag = 0;
	
	# Total de promotores
	$sqlTodospromotores  = "SELECT * FROM promotores";
	$execTodospromotores = mysqli_query($con, $sqlTodospromotores);
	$numTotalpromotores  = mysqli_num_rows($execTodospromotores);
	
	# Total de páginas
	$total_paginas = ceil($numTotalpromotores / $por_pagina);
	
	include('paginate.php');
	
	# Definir o limite minimo e máximo de promotores a serem listados
	$sqlLimites 	= "SELECT * FROM promotores LIMIT $por_pagina OFFSET $inicio";
	$sqlExecLimites = mysqli_query($con, $sqlLimites);
	
	#exit(var_dump($sqlExecLimites));
  ?>
  <div class="page-header">
	<div class="col-md-8">
		<h4>Temos <?=$cont?> promotor(es) cadastrado(s)</h4>
	</div>
	<div class="col-md-4">
	<div class="form-group input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
		
		<form method="post" action="proccess/search_promotores.php" id="busca-promotor">
			<input name="consulta" id="txt_consulta" placeholder="Pesquisar..." style="box-shadow: none;" type="text" class="form-control">
		</form>
	</div>
	</div>
  <div class="row">
	<div class="col-md-12">
	  <table id="tabela" class="table table-mod table-striped">
		<?php
		if(isset($_SESSION["cadError"])):
			echo $_SESSION["cadError"];
			unset($_SESSION["cadError"]);
		else:
			echo $_SESSION["cadSuccess"];
			unset($_SESSION["cadSuccess"]);
		endif;
		if(isset($_SESSION["editError"])):
			echo $_SESSION["editError"];
			unset($_SESSION["editError"]);
		else:
			echo $_SESSION["editSuccess"];
			unset($_SESSION["editSuccess"]);
		endif;
		if(isset($_SESSION["delError"])):
			echo $_SESSION["delError"];
			unset($_SESSION["delError"]);
		else:
			echo $_SESSION["delSuccess"];
			unset($_SESSION["delSuccess"]);
		endif;
		if(isset($_SESSION["warning"])):
			echo $_SESSION["warning"];
			unset($_SESSION["warning"]);
		endif;
		?>
		<thead>
		  <tr>
			<th class="text-center">ID</th>
			<th class="text-center">Nome</th>
			<th class="text-center">CPF</th>
			<th class="text-center">RG</th>
			<th class="text-center">CTPS</th>
			<th class="text-center">Empresa</th>
			<th class="text-center">Status</th>
			<th class="text-center">Acesso</th>
			<th class="text-center">Data Cad</th>
			<th class="text-center" colspan="3">Ações</th>
		  </tr>
		</thead>
		<tbody>	  
		<?php		
			while($rows = mysqli_fetch_array($sqlExecLimites)):
			if($rows % 2 == 9):
				$bg = "#968";
			else:
				$bg="#698";
			endif;
		?>
		  <tr>
			<td><?=$rows["promo_id"];?></td>
			<td><?=$rows["promo_nome"];?></td>
			<td><?=$rows["promo_cpf"];?></td>
			<td><?=$rows["promo_rg"];?></td>
			<td><?=$rows["promo_ctps"];?></td>
			<td><?=$rows["promo_empresa"];?></td>
			<td><?=($rows["promo_status"] == 1 ? "<span type=\"button\" class=\"btn btn-sm  btn-success\">Ativo</span>" : "<span type=\"button\" class=\"btn btn-sm  btn-danger\">Inativo</span>");?></td>
			<td><?=($rows["promo_bloqueado"] == 1 ? "<button type=\"button\" class=\"btn btn-sm  btn-success\" data-toggle=\"modal\" data-target=\"#obsModal\" data-codigo=\"".$rows['promo_id']."\">Livre</button>" : "<button type=\"button\" class=\"btn btn-sm  btn-danger\" data-toggle=\"modal\" data-target=\"#obsModal\" data-codigo=\"".$rows['promo_id']."\"disabled>Bloqueado</button>");?></td>
			<td><?=date("d/m/Y", strtotime($rows["promo_data_cad"]));?></td>
			<td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#visualizaModal" data-codigo="<?= $rows['promo_id'];?>" data-nome="<?= $rows['promo_nome'];?>" data-cpf="<?= $rows['promo_cpf'];?>" data-rg="<?= $rows['promo_rg'];?>" data-ctps="<?= $rows['promo_ctps'];?>" data-obs="<?= $rows['promo_obs'];?>" data-status="<?= $rows['promo_status'];?>" data-cad="<?= $rows['promo_data_cad'];?>"  data-update="<?= $rows['promo_update'];?>"  data-bloqueado="<?= $rows['promo_bloqueado'];?>"  data-ficha-reg="<?= $rows['promo_ficha_reg'];?>"  data-carta="<?= $rows['promo_carta'];?>"  data-empresa="<?= $rows['promo_empresa'];?>"  data-aso="<?= $rows['promo_aso'];?>"  data-comp-res="<?= $rows['promo_comp_res'];?>"  data-situacao="<?= $rows['promo_situacao'];?>">Visualizar</button></td>
			<td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editeModal"  data-codigo="<?= $rows['promo_id'];?>" data-nome="<?= $rows['promo_nome'];?>" data-cpf="<?= $rows['promo_cpf'];?>" data-rg="<?= $rows['promo_rg'];?>" data-ctps="<?= $rows['promo_ctps'];?>" data-obs="<?= $rows['promo_obs'];?>" data-status="<?= $rows['promo_status'];?>" data-cad="<?= $rows['promo_data_cad'];?>"  data-update="<?= $rows['promo_update'];?>"  data-bloqueado="<?= $rows['promo_bloqueado'];?>"  data-ficha-reg="<?= $rows['promo_ficha_reg'];?>"  data-carta="<?= $rows['promo_carta'];?>"  data-empresa="<?= $rows['promo_empresa'];?>"  data-aso="<?= $rows['promo_aso'];?>"  data-comp-res="<?= $rows['promo_comp_res'];?>"  data-situacao="<?= $rows['promo_situacao'];?>">Editar</button></td>
			<td><button type="button" class="btn btn-sm btn-danger" <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["usu_nivel_acesso_id"]))?'disabled':'');?> data-toggle="modal" data-target="#deletaModal"  data-codigo="<?= $rows['promo_id'];?>" data-nome="<?= $rows['promo_nome'];?>" data-cpf="<?= $rows['promo_cpf'];?>" data-rg="<?= $rows['promo_rg'];?>" data-ctps="<?= $rows['promo_ctps'];?>" data-obs="<?= $rows['promo_obs'];?>" data-status="<?= $rows['promo_status'];?>" data-cad="<?= $rows['promo_data_cad'];?>"  data-update="<?= $rows['promo_update'];?>"  data-bloqueado="<?= $rows['promo_bloqueado'];?>"  data-ficha-reg="<?= $rows['promo_ficha_reg'];?>"  data-carta="<?= $rows['promo_carta'];?>"  data-empresa="<?= $rows['promo_empresa'];?>"  data-aso="<?= $rows['promo_aso'];?>"  data-comp-res="<?= $rows['promo_comp_res'];?>"  data-situacao="<?= $rows['promo_situacao'];?>">Excluir</button></td>
		  </tr>		
		<?php endwhile;?>
		</tbody>
	  </table>
	  <div class="col-md-12 text-right">
		<nav aria-label="Page navigation">
			<ul class="pagination pagination-mod">
				<?php
					$reload = $_SERVER['PHP_SELF'] . "?pag=listar-promotores&tpages=" . $tpages;
					
					if ($total_paginas > 1) {
							$paginacao->paginar($reload, $mostrar_pag, $total_paginas);
					}					
				?>
				
			</ul>	  
			<button type="button" class="btn btn-sm btn-success text-center" data-toggle="modal" data-target="#cadastraModal" >Cadastrar novo Promotor</button>
		</nav>
	  </div>
	</div>	
	
	<!--modal edit-->
	<div class="modal fade" id="editeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Editar Promotor</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="proccess/edit-promotores.php" class="was-validated" >
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" id="recipient-name" required>
			  </div>
			  <div class="row">
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CPF:</label>
					<input type="text" class="form-control" name="cpf" id="recipient-cpf" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">RG:</label>
					<input type="text" class="form-control" name="rg" id="recipient-rg" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CTPS</label>
					<input type="text" class="form-control" name="ctps" id="recipient-ctps" required>
				  </div>
			  </div>
			  <div class="form-group">
					<label for="message-text" class="control-label">Documentos Obrigatórios</label>
					<div class="form-check form-check-inline">
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-carta"> Carta
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-ficha-reg" > Ficha Registro
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-comp-res"> Comp. Residência
						  </label>
						
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-aso" checked> (ASO)
						  </label>
					</div>
				</div>
					<div class="row">
						<div class="form-group col col-sm-4">
							<label for="message-text" class="control-label">Data Atualização:</label>
							<input type="text" class="form-control" name="update" id="recipient-update" disabled required>
						  </div>
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Status</label>
							  <div>
								  <select class="form-control" name="status" id="recipient-status"  <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["promo_nivel_acesso_id"]))?'disabled':'');?> required>
									<option value="1">Ativo</option>
									<option value="0">Inativo</option>
								  </select>
							  </div>
						</div>
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Situação</label>
							  <div>
								  <select class="form-control" name="situacao" id="recipient-situacao"  <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["promo_nivel_acesso_id"]))?'disabled':'');?> required>
									<option value="1">Livre</option>
									<option value="0">Bloqueado</option>
								  </select>
							  </div>
						</div>
					</div>
						
					<div class="row">
						<div class="form-group col col-sm-12">
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Motivo do Bloqueio:</label>
								<textarea class="form-control" id="recipient-obs" rows="4" style="resize: vertical;" placeholder="Em caso de bloqueio descrever a situação aqui"></textarea>
							</div>
						</div>
					</div>
				
			  <div class="modal-footer">
				<input type="hidden" id="recipient-codigo" name="codigo" value="<?=$rows['promo_id'];?>">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
				<button type="submit" name="edite" class="btn btn-warning" >Atualizar</button>
			  </div>
			</form>
		  </div>  
		</div>
	  </div>
	</div>
	<!-- fim modal edit -->
	
	
	<!--modal observação-->
	<div class="modal fade" id="obsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Bloquear Promotor</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="proccess/block-promotores.php">
				<div class="row">
					<div class="form-group col col-sm-12">
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Motivo do bloqueio:</label>
							<textarea class="form-control" name="obs" id="recipient-obs" rows="4" style="resize: vertical;" placeholder="Em caso de bloqueio descrever a situação aqui"></textarea>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<input type="hidden" id="recipient-codigo" name="codigo" value="<?=$rows['promo_id'];?>">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
					<button type="submit" name="bloquear" class="btn btn-danger">Bloquear</button>
				</div>
			</form>
		  </div>  
		</div>
	  </div>
	</div>
	<!-- fim modal observação -->
	
	
	<!--modal delete-->
	<div class="modal fade" id="deletaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Editar Promotor</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="proccess/del-promotores.php" >
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" id="recipient-name" required>
			  </div>
			  <div class="row">
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CPF:</label>
					<input type="text" class="form-control" name="cpf" id="recipient-cpf" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">RG:</label>
					<input type="text" class="form-control" name="rg" id="recipient-rg" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CTPS</label>
					<input type="text" class="form-control" name="ctps" id="recipient-ctps" required>
				  </div>
			  </div>
			  <div class="form-group">
					<label for="message-text" class="control-label">Documentos Obrigatórios</label>
					<div class="form-check form-check-inline">
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-carta"> Carta
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-ficha-reg" > Ficha Registro
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-comp-res"> Comp. Residência
						  </label>
						
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-aso" checked> (ASO)
						  </label>
					</div>
				</div>
					<div class="row">
						<div class="form-group col col-sm-4">
							<label for="message-text" class="control-label">Data Atualização:</label>
							<input type="text" class="form-control" name="update" id="recipient-update" disabled required>
						  </div>
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Status</label>
							  <div>
								  <select class="form-control" name="status" id="recipient-status"  <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["promo_nivel_acesso_id"]))?'disabled':'');?> required>
									<option value="1">Ativo</option>
									<option value="0">Inativo</option>
								  </select>
							  </div>
						</div>
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Situação</label>
							  <div>
								  <select class="form-control" name="situacao" id="recipient-situacao"  <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["promo_nivel_acesso_id"]))?'disabled':'');?> required>
									<option value="1">Livre</option>
									<option value="0">Bloqueado</option>
								  </select>
							  </div>
						</div>
					</div>
						
					<div class="row">
						<div class="form-group col col-sm-12">
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Observação:</label>
								<textarea class="form-control" id="recipient-obs" rows="4" style="resize: vertical;" placeholder="Em caso de bloqueio descrever a situação aqui"></textarea>
							</div>
						</div>
					</div>
				
			  <div class="modal-footer">
				<input type="hidden" id="recipient-codigo" name="codigo" value="<?=$rows['promo_id'];?>">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
			  </div>
			</form>
		  </div>  
		</div>
	  </div>
	</div>
	<!-- fim modal delete -->
	
	
	<!--modal visualiza-->
	
	<div class="modal fade" id="visualizaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Editar Promotor</h4>
		  </div>
		  <div class="modal-body">
			
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" id="recipient-name" required>
			  </div>
			  <div class="row">
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CPF:</label>
					<input type="text" class="form-control" name="cpf" id="recipient-cpf" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">RG:</label>
					<input type="text" class="form-control" name="rg" id="recipient-rg" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CTPS</label>
					<input type="text" class="form-control" name="ctps" id="recipient-ctps" required>
				  </div>
			  </div>
			  <div class="form-group">
					<label for="message-text" class="control-label">Documentos Obrigatórios</label>
					<div class="form-check form-check-inline">
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-carta"> Carta
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-ficha-reg" > Ficha Registro
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-comp-res"> Comp. Residência
						  </label>
						
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-aso" checked> (ASO)
						  </label>
					</div>
				</div>
					<div class="row">
						<div class="form-group col col-sm-4">
							<label for="message-text" class="control-label">Data Atualização:</label>
							<input type="text" class="form-control" name="update" id="recipient-update" disabled required>
						  </div>
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Status</label>
							  <div>
								  <select class="form-control" name="status" id="recipient-status"  <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["promo_nivel_acesso_id"]))?'disabled':'');?> required>
									<option value="1">Ativo</option>
									<option value="0">Inativo</option>
								  </select>
							  </div>
						</div>
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Situação</label>
							  <div>
								  <select class="form-control" name="situacao" id="recipient-situacao"  <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["promo_nivel_acesso_id"]))?'disabled':'');?> required>
									<option value="1">Livre</option>
									<option value="0">Bloqueado</option>
								  </select>
							  </div>
						</div>
					</div>
						
					<div class="row">
						<div class="form-group col col-sm-12">
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Observação:</label>
								<textarea class="form-control" id="recipient-obs" rows="4" style="resize: vertical;" placeholder="Em caso de bloqueio descrever a situação aqui"></textarea>
							</div>
						</div>
					</div>
				
			  <div class="modal-footer">
				<input type="hidden" id="recipient-codigo" name="codigo" value="<?=$rows['promo_id'];?>">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
			  </div>
			
		  </div>  
		</div>
	  </div>
	</div>
	<!-- fim modal visualiza -->
	
	<!--modal cadastra-->
	<div class="modal fade" id="cadastraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Editar Promotor</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="proccess/cad-promotores.php"  class="was-validated">
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" required>
			  </div>
			  <div class="form-group">
				<label for="recipient-empresa" class="control-label">Empresa:</label>
				<input type="text" class="form-control" name="empresa" required>
			  </div>
			  <div class="row">
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CPF:</label>
					<input type="text" class="form-control" name="cpf" id="recipient-cpf" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">RG:</label>
					<input type="text" class="form-control" name="rg" id="recipient-rg" required>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">CTPS</label>
					<input type="text" class="form-control" name="ctps" id="recipient-ctps" required>
				  </div>
			  </div>
			  <div class="form-group">
					<label for="message-text" class="control-label">Documentos Obrigatórios</label>
					<div class="form-check form-check-inline">
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-carta"> Carta
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-ficha-reg" > Ficha Registro
						  </label>
						
						  <label class="form-check-label col-sm-4">
							<input class="form-check-input" type="checkbox" id="recipient-comp-res"> Comp. Residência
						  </label>
						
						  <label class="form-check-label col-sm-2">
							<input class="form-check-input" type="checkbox" id="recipient-aso" checked> (ASO)
						  </label>
					</div>
				</div>
					<div class="row">
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Status</label>
							  <div>
								  <select class="form-control" name="status" id="recipient-status"required>
									<option value="1">Ativo</option>
									<option value="0">Inativo</option>
								  </select>
							  </div>
						</div>
						<div class="form-group col col-sm-4">
						  <label for="inputStatus" class="control-label">Situação</label>
							  <div>
								  <select class="form-control" name="situacao" id="recipient-situacao"required>
									<option value="1">Livre</option>
									<option value="0">Bloqueado</option>
								  </select>
							  </div>
						</div>
					  <div class="form-group col col-sm-4">
						<label for="message-text" class="control-label">Data Cadastro:</label>
						<input type="text" value="<?=date("Y-m-d H:i:s");?>" class="form-control" name="data_cad" readonly required>
					  </div>
				  </div>
			  </div>
			  <div class="modal-footer">
				<!-- <input type="hidden" id="recipient-codigo" name="codigo" value="<?=$rows['promo_id'];?>"> -->
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success" name="cadastra">Cadastrar</button>
			  </div>
			</form>
		  </div>  
		</div>
	  </div>
	</div>
	<!-- fim modal cadastro -->	
</div>