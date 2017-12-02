<?php
$usuario = select(dbConnect(), 'usuarios', 'WHERE usu_id = :usu_id', array('usu_id' => get('codigo')));
$usuario = (0 < count($usuario)) ? $usuario[0] : null;

if (is_null($usuario)):
    ?>
    <div class="page-header">
        <h1>Usuário inexistente</h1>
    </div>
    <?php
else:
    ?>
    <div class="page-header">
        <h1>Editar Promotor</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="proccess/edit-usuario.php" method="POST" name="frm_cadastro">
                <div class="form-group">
                    <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nome" placeholder="Nome completo" value="<?= (isset($usuario['usu_nome']) ? $usuario['usu_nome'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" placeholder="Digite um e-mail válido" value="<?= (isset($usuario['usu_email']) ? $usuario['usu_email'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputLogin" class="col-sm-2 control-label">Usuário</label>
                    <div class="col-sm-10">
                        <input type="text" name="usuario" class="form-control" placeholder="Digite seu usuario" name="login" value="<?= (isset($usuario['usu_login']) ? $usuario['usu_login'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSenha" class="col-sm-2 control-label">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" value="<?= (isset($usuario['usu_senha']) ? $usuario['usu_senha'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNivel" class="col-sm-2 control-label">Nível de Acesso</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="nivel_acesso">
                            <option value="1" <?= (isset($usuario['usu_nivel_acesso_id']) && ($usuario['usu_nivel_acesso_id'] == '1') ? "selected='selected'" : ""); ?>>Administrador</option>
                            <option value="2" <?= (isset($usuario['usu_nivel_acesso_id']) && ($usuario['usu_nivel_acesso_id'] == '2') ? "selected='selected'" : ""); ?>>Usuário</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status">
                            <option value="1" <?= (isset($usuario['usu_status']) && ($usuario['usu_status'] == '1') ? "selected='selected'" : ""); ?>>Ativo</option>
                            <option value="0" <?= (isset($usuario['usu_status']) && ($usuario['usu_status'] == '0') ? "selected='selected'" : ""); ?>>Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSenha" class="col-sm-2 control-label">Data Cadastro</label>
                    <div class="col-sm-10">
                        <input type="text" name="data_edit" class="form-control" readonly placeholder="Data Cadastro" value="<?= date("Y-m-d H:i:s"); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="principal.php?pag=listar-usuarios" class="btn btn-info">Voltar</a>
                        <button type="reset" name="limpar" class="btn btn-warning">Limpar</button>
                        <button type="submit" name="edite" class="btn btn-primary">Atualizar</button>
                        <input type="hidden" name="codigo" value="<?= $usuario['usu_id']; ?>">
                    </div>
                </div>
            </form>	
        </div>
    </div>
<?php endif;