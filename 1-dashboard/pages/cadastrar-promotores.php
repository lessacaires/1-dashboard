<div class="page-header">
	<h1>Cadastro de Usuários</h1>
  </div>
  <div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" action="proccess/cad-usuario.php" method="POST" name="frm_cadastro">
		  <div class="form-group">
			<label for="inputNome" class="col-sm-2 control-label">Nome</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome" placeholder="Nome completo">
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">E-mail</label>
			<div class="col-sm-10">
			  <input type="email" name="email" class="form-control" placeholder="Digite um e-mail válido">
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputLogin" class="col-sm-2 control-label">Usuário</label>
			<div class="col-sm-10">
			  <input type="text" name="usuario" class="form-control" placeholder="Digite seu usuario">
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputSenha" class="col-sm-2 control-label">Senha</label>
			<div class="col-sm-10">
			  <input type="password" name="senha" class="form-control" placeholder="Digite sua senha">
			</div>
		  </div>
		  <div class="form-group">
		  <label for="inputNivel" class="col-sm-2 control-label">Nível de Acesso</label>
			  <div class="col-sm-10">
				  <select class="form-control" name="nivel_acesso">
					<option value="1">Administrador</option>
					<option value="2">Usuário</option>
				  </select>
			  </div>
		  </div>
		  <div class="form-group">
		  <label for="inputStatus" class="col-sm-2 control-label">Status</label>
			  <div class="col-sm-10">
				  <select class="form-control" name="status">
					<option value="0">Ativo</option>
					<option value="1">Inativo</option>
				  </select>
			  </div>
		  </div>
		  <div class="form-group">
			<label for="inputSenha" class="col-sm-2 control-label">Data Cadastro</label>
			<div class="col-sm-10">
			  <input type="text" name="data_cad" class="form-control" readonly placeholder="Data Cadastro" value="<?=date("Y-m-d H:i:s");?>">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<a href="principal.php?pag=listar-usuarios" class="btn btn-info">Voltar</a>
				<button type="reset" name="limpar" class="btn btn-warning">Limpar</button>
				<button type="submit" name="cadastra" class="btn btn-primary">Cadastrar</button>
			</div>
		  </div>
		</form>	
	</div>
</div>