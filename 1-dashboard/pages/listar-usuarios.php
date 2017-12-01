<div class="page-header">
	<h1>Lista de Usuários</h1>
  </div>
  <?php
	include_once('paginacao.php');
	
	$paginacao = new paginacao;
	
	$por_pagina  = 5;         
	$mostrar_pag = 0;
	
	# Total de usuários
	$sqlTodosUsuarios  = "SELECT * FROM usuarios";
	$execTodosUsuarios = mysqli_query($con, $sqlTodosUsuarios);
	$numTotalUsuarios  = mysqli_num_rows($execTodosUsuarios);
	
	# Total de páginas
	$total_paginas = ceil($numTotalUsuarios / $por_pagina);
	
	include('paginate.php');
	
	# Definir o limite minimo e máximo de usuários a serem listados
	$sqlLimites 	= "SELECT * FROM usuarios LIMIT $por_pagina OFFSET $inicio";
	$sqlExecLimites = mysqli_query($con, $sqlLimites);
	
	#exit(var_dump($sqlExecLimites));
  ?>
  <div class="page-header">
	<div class="col-md-8">
		<h4>Temos <?=$cont?> usuário(s) cadastrado(s)</h4>
	</div>
	<div class="col-md-4">
	<div class="form-group input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
		
		<form method="post" action="proccess/search_usuario.php" id="busca-usuario">
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
			<th>ID</th>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Login</th>
			<th>Data Cad</th>
			<th>Ultima Alteração</th>
			<th>Nível</th>
			<th>Status</th>
			<th class="text-center" colspan="3">Ações</th>
		  </tr>
		</thead>
		<tbody>	  
		<?php		
			while($rows = mysqli_fetch_array($sqlExecLimites)):
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
		<?php endwhile;?>
		</tbody>
	  </table>
	  <div class="col-md-12 text-right">
		<nav aria-label="Page navigation">
			<ul class="pagination pagination-mod">
				<?php
					$reload = $_SERVER['PHP_SELF'] . "?pag=listar-usuarios&tpages=" . $tpages;
					
					if ($total_paginas > 1) {
							$paginacao->paginar($reload, $mostrar_pag, $total_paginas);
					}					
				?>
				
			</ul>
		  
			<button type="button" class="btn btn-sm btn-success text-center" <?=($_SESSION['usuarioNivelAcesso'] != '1'?'disabled':'');?> data-toggle="modal" data-target="#cadastraModal" >Cadastrar novo usuário</button>
		</nav>
			
			
	  </div>
	</div>	
	
	<!--modal edit-->
	<div class="modal fade" id="editeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Editar Usuários</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="proccess/edit-usuario.php" >
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" id="recipient-name" required>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">E-mail:</label>
				<input type="email" class="form-control" name="email" id="recipient-email" required>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">Login:</label>
				<input type="text" class="form-control" name="login" id="recipient-login" required>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">Senha:</label>
				<input type="password" class="form-control" name="senha" id="recipient-senha" required>
			  </div>
			 <div class="form-group">
			  <label for="message-text" class="control-label">Nível de Acesso</label>
					<div>
					    <select class="form-control" name="nivel_acesso" id="recipient-nivel-acesso" <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["usu_nivel_acesso_id"]))?'disabled':'');?> required>
							<option  value="1">Administrador</option>
							<option value="2">Usuário</option>
					    </select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col col-sm-6">
					  <label for="inputStatus" class="control-label">Status</label>
						  <div>
							  <select class="form-control" name="status" id="recipient-status"  <?=((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioNivelAcesso'] != $rows["usu_nivel_acesso_id"]))?'disabled':'');?> required>
								<option value="1">Ativo</option>
								<option value="0">Inativo</option>
							  </select>
						  </div>
					</div>
				  <div class="form-group col col-sm-6">
					<label for="message-text" class="control-label">Data Atualização:</label>
					<input type="text" class="form-control" name="data_edit" id="recipient-update" value="<?=date("Y-m-d H:i:s");?>" readonly required>
				  </div>
			  </div>
			  <div class="modal-footer">
				<input type="hidden" id="recipient-codigo" name="codigo" value="<?=$rows['usu_id'];?>">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success" name="edite">Atualizar</button>
			  </div>
			</form>
		  </div>  
		</div>
	  </div>
	</div>
	<!-- fim modal edit -->
	
	
	<!--modal delete-->
	<div class="modal fade" id="deletaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Editar Usuários</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="proccess/del-usuario.php" >
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" id="recipient-name" disabled>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">E-mail:</label>
				<input type="text" class="form-control" name="email" id="recipient-email" disabled>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">Login:</label>
				<input type="text" class="form-control" name="login" id="recipient-login" disabled>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">Senha:</label>
				<input type="password" class="form-control" name="senha" id="recipient-senha" disabled>
			  </div>
			 <div class="form-group">
			  <label for="message-text" class="control-label">Nível de Acesso</label>
				  <div>
					  <select class="form-control" name="nivel_acesso" id="recipient-nivel-acesso" disabled>
						<option  value="1">Administrador</option>
						<option value="2">Usuário</option>
					  </select>
				  </div>
			  </div>
			  <div class="form-group">
				  <label for="inputStatus" class="control-label">Status</label>
					  <div>
						  <select class="form-control" name="status" id="recipient-status" disabled>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						  </select>
					  </div>
				  </div>
			  <div class="modal-footer">
				<input type="hidden" id="recipient-codigo" name="codigo" value="">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger" name="excluir">Excluir</button>
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
			<h4 class="modal-title" id="exampleModalLabel">Editar Usuários</h4>
		  </div>
		  <div class="modal-body">
		    <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" id="recipient-name"  disabled>
		    </div>
		    <div class="form-group">
				<label for="message-text" class="control-label">E-mail:</label>
				<input type="text" class="form-control" name="email" id="recipient-email"  disabled>
		    </div>
			<div class="row">
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">Login:</label>
					<input type="text" class="form-control" name="login" id="recipient-login"  disabled>
				  </div>
				  <div class="form-group col col-sm-4">
					<label for="message-text" class="control-label">Senha:</label>
					<input type="password" class="form-control" name="senha" id="recipient-senha"  disabled>
				  </div>
				  
				 <div class="form-group col col-sm-4">
				  <label for="message-text" class="control-label">Nível de Acesso</label>
					  <div>
						  <select class="form-control" name="nivel_acesso" id="recipient-nivel-acesso" disabled>
							<option value="1">Administrador</option>
							<option value="2">Usuário</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
				  <div class="form-group  col col-sm-4">
					  <label for="inputStatus" class="control-label">Status</label>
						  <div>
							  <select class="form-control" name="status" id="recipient-status" disabled>
								<option value="1">Ativo</option>
								<option value="0">Inativo</option>
							  </select>
						  </div>
					  </div>
				    <div class="form-group  col col-sm-4">
						<label for="message-text" class="control-label">Data Cadastro:</label>
						<input type="text" class="form-control" name="data_cad" id="recipient-cad" disabled>
				    </div>
					<div class="form-group  col col-sm-4">
						<label for="message-text" class="control-label">Data Atualização:</label>
						<input type="text" class="form-control" name="data_update" id="recipient-update" disabled>
				    </div>
				</div>
				<div class="modal-footer">
				<input type="hidden" id="recipient-codigo" name="codigo" value="">
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
			<h4 class="modal-title" id="exampleModalLabel" required>Editar Usuários</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="proccess/cad-usuario.php" >
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nome:</label>
				<input type="text" class="form-control" name="nome" id="recipient-name"  required>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">E-mail:</label>
				<input type="email" class="form-control" name="email" id="recipient-email"  required>
			  </div>
			  <div class="row">
			  <div class="form-group col col-sm-3">
				<label for="message-text" class="control-label">Login:</label>
				<input type="text" class="form-control" name="login" id="recipient-login"  required>
			  </div>
			  
			  <div class="form-group col col-sm-3">
				<label for="message-text" class="control-label">Senha:</label>
				<input type="password" class="form-control" name="senha" id="recipient-senha"  required>
			  </div>
			 <div class="form-group col col-sm-3">
			  <label for="message-text" class="control-label">Nível de Acesso</label>
				  <div>
					  <select class="form-control" name="nivel_acesso" id="recipient-nivel-acesso"  required>
						<option  value="1">Administrador</option>
						<option  value="2">Usuário</option>
					  </select>
				  </div>
			  </div>
			  <div class="form-group col col-sm-3">
				  <label for="inputStatus" class="control-label">Status</label>
					  <div>
						  <select class="form-control" name="status" id="recipient-status"  required>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						  </select>
					  </div>
				  </div>
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">Data Cadastro:</label>
				<input type="text" class="form-control" name="data_cad" value="<?=date("Y-m-d H:i:s");?>" readonly id="recipient-cadastro"  required>
			  </div>
			  <div class="modal-footer">
				<a href="principal.php?pag=listar-usuarios" class="btn btn-info">Voltar</a>
				<button type="reset" name="limpar" class="btn btn-warning">Limpar</button>
				<button type="submit" name="cadastra" class="btn btn-primary">Cadastrar</button>
			  </div>
			</form> 
		  </div>  
		</div>
	  </div>
	</div>
	<!-- fim modal cadastro -->	
</div>