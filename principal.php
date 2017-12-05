<?php require('includes/header.php'); ?>
<div class="container theme-showcase" role="main">
    <?php getPage('pag'); ?>

    <!--modal visualiza-->
    <div class="modal fade" id="visualizaModalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="recipient-codigo" name="codigo" value="">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fim modal visualiza -->


    <!-- modal entrada e saída de promotores -->
    <div class="modal fade" id="inoutPromotoresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Entrada/Saída de promotores</h4>
                </div>

                <form method="POST" action="proccess/inout-promotores.php" id="inout-form">
                    <div class="modal-body">
                        <?php if (!empty($_SESSION['inoutError']) && !empty($_SESSION['inoutError'])): ?>
                            <div class="row">
                                <div class="form-group col col-sm-12">
                                    <?= $_SESSION['inoutError']; unset($_SESSION['inoutError']); ?>
                                </div>
                            </div>
                        <?php endif;?>
                        
                        <div class="row">
                            <div class="form-group col col-sm-6">
                                <label class="control-label">Tipo de operação:</label>
                                <select class="form-control" name="operacao" required>
                                    <option value="1">Registrar entrada</option>
                                    <option value="0">Registrar saída</option>
                                </select>
                            </div>

                            <div class="form-group col col-sm-6">
                                <label for="recipient-name" class="control-label">CPF:</label>
                                <input type="text" class="form-control" name="cpf" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Realizar operação</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- fim modal entrada e saída de promotores -->

</div> <!-- Fim do conteúdo da página -->

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="js/ie-emulation-modes-warning.js?<?= time(); ?>"></script>

<!--jQuery (necessary for Bootstrap's JavaScript plugins)--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

<!--Include all compiled plugins (below), or include individual files as needed--> 
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    /*DADOS DO USUÁRIO*/
    $('#editeModalUsuario, #deletaModalUsuario, #cadastraModalUsuario, #visualizaModalUsuario').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nome = button.data('nome') // Extract info from data-* attributes
        var email = button.data('email')
        var login = button.data('login')
        var senha = button.data('senha')
        var nivelAcesso = button.data('nivel-acesso')
        var status = button.data('status')
        var cad = button.data('cad')
        var update = button.data('update')
        var codigo = button.data('codigo')

        var modal = $(this);

        switch (modal.get(0).id) {
            case 'editeModalUsuario':
                if ('1' != nivelAcesso) {
                    modal.find('#recipient-nivel-acesso').prop('disabled', true)
                    modal.find('#recipient-status').prop('disabled', true)
                }

                modal.find('.modal-title').text('Editando Usuário: ' + nome)
                break;
            case 'deletaModalUsuario':
                modal.find('input:not([type="hidden"]), select, option, checkbox, radio, textarea').prop('disabled', true);
                modal.find('.modal-title').text('Deletar Usuário: ' + nome)
                break;
            case 'cadastraModalUsuario':
                modal.find('.modal-title').text('Cadastrar Usuário: ' + nome)
                break;
            case 'visualizaModalUsuario':
                modal.find('input:not([type="hidden"]), select, option, checkbox, radio, textarea').prop('disabled', true);
                modal.find('.modal-title').text('Visualizar Usuário: ' + nome)
                break;
        }

        modal.find('#recipient-name').val(nome)
        modal.find('#recipient-email').val(email)
        modal.find('#recipient-login').val(login)
        modal.find('#recipient-senha').val(senha)
        modal.find('#recipient-nivel-acesso').val(nivelAcesso)
        modal.find('#recipient-status').val(status)
        modal.find('#recipient-codigo').val(codigo)
        modal.find('#recipient-update').val(update)
        modal.find('#recipient-cad').val(cad)
    });

    /*FIMDADOS DO USUÁRIO*/

    setTimeout(function () {
        $('#success, #error, #warning').fadeOut('slow', function () {
            $(this).remove();
        });
    }, 5000);
</script>

<script>
    $('#busca-usuario').submit(function () {
        var data = new FormData(this);
        var action = $(this).get(0).action;

        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            beforeSend: function () {
                console.log('Enviando...');
            },
            success: function (resposta) {
                $('#tabela tbody').fadeTo(700, 0.2, function () {
                    $(this).html(resposta);
                    $(this).fadeTo(700, 1);
                });
            },
            cache: false,
            contentType: false,
            processData: false,
        });

        return false;
    });

    $('#busca-promotor').submit(function () {
        var data = new FormData(this);
        var action = $(this).get(0).action;

        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            beforeSend: function () {
                console.log('Enviando...');
            },
            success: function (resposta) {
                $('#tabela tbody').fadeTo(700, 0.2, function () {
                    $(this).html(resposta);
                    $(this).fadeTo(700, 1);
                });
            },
            cache: false,
            contentType: false,
            processData: false,
        });

        return false;
    });
</script>

<script type="text/javascript">
    /*DADOS DO PROMOTOR*/
    $('#editeModalPromotor, #deletaModalPromotor, #cadastraModalPromotor, #visualizaModalPromotor, #obsModalPromotor').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var nome = button.data('nome');
        var empresa = button.data('empresa');
        var cpf = button.data('cpf');
        var rg = button.data('rg');
        var ctps = button.data('ctps');
        var carta = button.data('carta');
        var ficha_reg = button.data('ficha-reg');
        var comp_res = button.data('comp-res');
        var status = button.data('status');
        var aso = button.data('aso');
        var situacao = button.data('situacao');
        var update = button.data('update');
        var obs = button.data('obs');
        var codigo = button.data('codigo');

        var modal = $(this);

        modal.find('#recipient-name').val(nome);
        modal.find('#recipient-empresa').val(empresa);
        modal.find('#recipient-cpf').val(cpf);
        modal.find('#recipient-rg').val(rg);
        modal.find('#recipient-ctps').val(ctps);
        modal.find('#recipient-status').val(status);
        modal.find('#recipient-situacao').val(situacao);
        modal.find('#recipient-codigo').val(codigo);
        modal.find('#recipient-obs').val(obs);

        if ('0' == situacao)
            modal.find('#recipient-obs').prop('disabled', false);
        else
            modal.find('#recipient-obs').prop('disabled', true);

        var obs = modal.find('#recipient-obs').val();

        modal.find('#recipient-situacao').change(function () {
            if ('0' == $(this).val())
                modal.find('#recipient-obs').prop('disabled', false).val(obs);
            else
                modal.find('#recipient-obs').prop('disabled', true).val('');
        });

        if ('1' == carta)
            modal.find('#recipient-carta').prop('checked', true);
        else
            modal.find('#recipient-carta').prop('checked', false);

        if ('1' == ficha_reg)
            modal.find('#recipient-ficha-reg').prop('checked', true);
        else
            modal.find('#recipient-ficha-reg').prop('checked', false);

        if ('1' == comp_res)
            modal.find('#recipient-comp-res').prop('checked', true);
        else
            modal.find('#recipient-comp-res').prop('checked', false);

        if ('1' == aso)
            modal.find('#recipient-aso').prop('checked', true);
        else
            modal.find('#recipient-aso').prop('checked', false);

        modal.find('#recipient-update').val(update);

        switch (modal.get(0).id) {
            case 'editeModalPromotor':
                modal.find('.modal-title').text('Editando Promotor: ' + nome);
                break;
            case 'deletaModalPromotor':
                modal.find('input:not([type="hidden"]), select, option, checkbox, radio, textarea').prop('disabled', true);
                modal.find('.modal-title').text('Deletar Promotor: ' + nome);
                break;
            case 'cadastraModalPromotor':
                modal.find('.modal-title').text('Cadastrar Promotor:');
                break;
            case 'obsModalPromotor':
                modal.find('#recipient-obs').prop('disabled', false);
                break;
            case 'visualizaModalPromotor':
                modal.find('input, select, option, checkbox, radio, textarea').prop('disabled', true);
                modal.find('.modal-title').text('Visualizar Promotor: ' + nome);
                break;
        }
    });
    /* FIM DADOS DO PROMOTOR */
</script>

<?php if ('1' != $_SESSION['usuarioNivelAcesso']): ?>
    <script type="text/javascript">
        
        if ('' === location.search) {
            $(document).ready(function () {
                $('#inoutPromotores').click();
            });
        }
    </script>
<?php endif; ?>

</body>
</html>
<?php
ob_end_flush();
