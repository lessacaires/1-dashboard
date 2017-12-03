<?php
$promotor = select(dbConnect(), 'promotores', 'WHERE promo_id = :promo_id', array('promo_id' => get('codigo')));
$promotor = (0 < count($promotor)) ? $promotor[0] : null;

if (is_null($promotor)):
    ?>
    <div class="page-header">
        <h1>Promotor inexistente</h1>
    </div>
    <?php
else:
    ?>
    <div class="page-header">
        <h1>Editar Promotor</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="proccess/del-promotores.php" method="POST" name="frm_cadastro">
                <div class="form-group">
                    <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nome" placeholder="Nome completo" value="<?= (isset($promotor['promo_nome']) ? $promotor['promo_nome'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" placeholder="Digite um e-mail válido" value="<?= (isset($promotor['promo_email']) ? $promotor['promo_email'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputLogin" class="col-sm-2 control-label">Usuário</label>
                    <div class="col-sm-10">
                        <input type="text" name="usuario" class="form-control" placeholder="Digite seu usuario" name="<?= (isset($promotor['promo_login']) ? $promotor['promo_login'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSenha" class="col-sm-2 control-label">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" value="<?= (isset($promotor['promo_senha']) ? $promotor['promo_senha'] : null) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNivel" class="col-sm-2 control-label">Nível de Acesso</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="nivel_acesso">
                            <option value="1" <?= (isset($promotor['promo_nivel_acesso_id']) && ($promotor['promo_nivel_acesso_id'] == '1') ? "selected='selected'" : ""); ?>>Administrador</option>
                            <option value="2" <?= (isset($promotor['promo_nivel_acesso_id']) && ($promotor['promo_nivel_acesso_id'] == '2') ? "selected='selected'" : ""); ?>>Usuário</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status">
                            <option value="1" <?= (isset($promotor['promo_status']) && ($promotor['promo_status'] == '1') ? "selected='selected'" : ""); ?>>Ativo</option>
                            <option value="0" <?= (isset($promotor['promo_status']) && ($promotor['promo_status'] == '0') ? "selected='selected'" : ""); ?>>Inativo</option>
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
                        <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
                        <input type="hidden" name="codigo" value="<?= $promotor['promo_id']; ?>">
                    </div>
                </div>
            </form>	
        </div>
    </div>
<?php endif;