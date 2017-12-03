<div class="page-header">
    <h1>Lista de Usuários</h1>
</div>

<?php
include_once('lib/sql.php');

include_once('classes/Paginacao.php');

# Inicio do paginador
$paginacao = new Paginacao;

$por_pagina = 5;
$mostrar_pag = 0;

# Total de usuários
$numUsuarios = select(dbConnect(), 'usuarios');
$numTotalUsuarios = count($numUsuarios);

# Total de páginas
$total_paginas = ceil($numTotalUsuarios / $por_pagina);

include('includes/paginate.php');

$usuarios = select(dbConnect(), 'usuarios', "LIMIT {$por_pagina} OFFSET {$inicio}");
?>
<div class="page-header">
    <div class="col-md-8">
        <h4>Temos <?= $numTotalUsuarios ?> usuário(s) cadastrado(s)</h4>
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
                if (isset($_SESSION["cadError"])):
                    echo $_SESSION["cadError"];
                    unset($_SESSION["cadError"]);
                elseif (isset($_SESSION["cadSuccess"])):
                    echo $_SESSION["cadSuccess"];
                    unset($_SESSION["cadSuccess"]);
                endif;

                if (isset($_SESSION["editError"])):
                    echo $_SESSION["editError"];
                    unset($_SESSION["editError"]);
                elseif (isset($_SESSION["editSuccess"])):
                    echo $_SESSION["editSuccess"];
                    unset($_SESSION["editSuccess"]);
                endif;

                if (isset($_SESSION["delError"])):
                    echo $_SESSION["delError"];
                    unset($_SESSION["delError"]);
                elseif (isset($_SESSION["delSuccess"])):
                    echo $_SESSION["delSuccess"];
                    unset($_SESSION["delSuccess"]);
                endif;

                if (isset($_SESSION["warning"])):
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
                    <?php if (0 < $numTotalUsuarios): ?>
                        <?php foreach ($usuarios as $rows): ?>
                            <tr>
                                <td><?= $rows["usu_id"]; ?></td>
                                <td><?= $rows["usu_nome"]; ?></td>
                                <td><?= $rows["usu_email"]; ?></td>
                                <td><?= $rows["usu_login"]; ?></td>
                                <td><?= date("d/m/Y H:i:s", strtotime($rows["usu_data_cad"])); ?></td>
                                <td><?= date("d/m/Y H:i:s", strtotime($rows["usu_update"])); ?></td>
                                <td><?= ($rows["usu_nivel_acesso_id"] == 1 ? "admin" : "usuário"); ?></td>
                                <td><?= ($rows["usu_status"] == 1 ? "<span type=\"button\" class=\"btn btn-sm  btn-success\">ativo</span>" : "<span type=\"button\" class=\"btn btn-sm  btn-danger\">inativo</span>"); ?></td>
                                <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#visualizaModal" data-codigo="<?= $rows['usu_id']; ?>" data-nome="<?= $rows['usu_nome']; ?>" data-email="<?= $rows['usu_email']; ?>" data-login="<?= $rows['usu_login']; ?>" data-senha="<?= $rows['usu_senha']; ?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id']; ?>" data-status="<?= $rows['usu_status']; ?>" data-cad="<?= $rows['usu_data_cad']; ?>"  data-update="<?= $rows['usu_update']; ?>">Visualizar</button></td>
                                <td><button type="button" class="btn btn-sm btn-warning" <?= ((($_SESSION['usuarioNivelAcesso'] != '1') && ($_SESSION['usuarioId'] != $rows["usu_id"])) ? 'disabled' : ''); ?> data-toggle="modal" data-target="#editeModalUsuario" data-codigo="<?= $rows['usu_id']; ?>" data-nome="<?= $rows['usu_nome']; ?>" data-email="<?= $rows['usu_email']; ?>" data-login="<?= $rows['usu_login']; ?>" data-senha="<?= $rows['usu_senha']; ?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id']; ?>" data-status="<?= $rows['usu_status']; ?>" data-cad="<?= $rows['usu_data_cad']; ?>"  data-update="<?= $rows['usu_update']; ?>">Editar</button></td>
                                <td><button type="button" class="btn btn-sm btn-danger" <?= ($_SESSION['usuarioNivelAcesso'] != '1' ? 'disabled' : ''); ?> data-toggle="modal" data-target="#deletaModalUsuario" data-codigo="<?= $rows['usu_id']; ?>" data-nome="<?= $rows['usu_nome']; ?>" data-email="<?= $rows['usu_email']; ?>" data-login="<?= $rows['usu_login']; ?>" data-senha="<?= $rows['usu_senha']; ?>" data-nivel-acesso="<?= $rows['usu_nivel_acesso_id']; ?>" data-status="<?= $rows['usu_status']; ?>" data-update="<?= $rows['usu_update']; ?>">Excluir</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="20" class="col-no-register">Não existem usuários registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="col-md-12 text-right">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-mod">
                        <?php
                        $reload = "{$_SERVER['PHP_SELF']}?pag=listar-usuarios&tpages={$tpages}";

                        if ($total_paginas > 1)
                            $paginacao->paginar($reload, $mostrar_pag, $total_paginas);
                        ?>

                    </ul>

                    <button type="button" class="btn btn-sm btn-success text-center" <?= ($_SESSION['usuarioNivelAcesso'] != '1' ? 'disabled' : ''); ?> data-toggle="modal" data-target="#cadastraModalUsuario" >Cadastrar novo usuário</button>
                </nav>
            </div>
        </div>

        <!--modal edit-->
        <div class="modal fade" id="editeModalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Editar Usuários</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="proccess/edit-usuario.php" >
                            <div class="row">
                                <div class="form-group col col-sm-12">
                                    <label for="recipient-name" class="control-label">Nome:</label>
                                    <input type="text" class="form-control" name="nome" id="recipient-name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col col-sm-12">
                                    <label for="message-text" class="control-label">E-mail:</label>
                                    <input type="text" class="form-control" name="email" id="recipient-email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col col-sm-4">
                                    <label for="message-text" class="control-label">Login:</label>
                                    <input type="text" class="form-control" name="login" id="recipient-login">
                                </div>
                                <div class="form-group col col-sm-4">
                                    <label for="message-text" class="control-label">Senha:</label>
                                    <input type="password" class="form-control" name="senha" id="recipient-senha">
                                </div>

                                <div class="form-group col col-sm-4">
                                    <label for="message-text" class="control-label">Nível de Acesso</label>
                                    <div>
                                        <select class="form-control" name="nivel_acesso" id="recipient-nivel-acesso">
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuário</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col col-sm-4">
                                    <label for="inputStatus" class="control-label">Status</label>
                                    <select class="form-control" name="status" id="recipient-status">
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
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
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning" name="edite">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim modal edit -->


        <!--modal delete-->
        <div class="modal fade" id="deletaModalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                                <select class="form-control" name="nivel_acesso" id="recipient-nivel-acesso" disabled>
                                    <option  value="1">Administrador</option>
                                    <option value="2">Usuário</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus" class="control-label">Status</label>
                                <select class="form-control" name="status" id="recipient-status" disabled>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
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
                                <select class="form-control" name="status" id="recipient-status" disabled>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
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
        <div class="modal fade" id="cadastraModalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                                    <select class="form-control" name="nivel_acesso" id="recipient-nivel-acesso"  required>
                                        <option  value="1">Administrador</option>
                                        <option  value="2">Usuário</option>
                                    </select>
                                </div>
                                <div class="form-group col col-sm-3">
                                    <label for="inputStatus" class="control-label">Status</label>
                                    <select class="form-control" name="status" id="recipient-status"  required>
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Data Cadastro:</label>
                                <input type="text" class="form-control" name="data_cad" value="<?= date("Y-m-d H:i:s"); ?>" readonly id="recipient-cadastro"  required>
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
</div>
