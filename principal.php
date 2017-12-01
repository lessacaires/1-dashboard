<?php include_once 'includes/header.php'; ?>

<div class="container theme-showcase" role="main">
    <?php

    function getGet($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    $pag = getGet('pag');
    if (is_file('pages/' . $pag . '.php'))
        include 'pages/' . $pag . '.php';
    else
        include 'pages/dashboard.php';
    ?>
</div> <!-- /container -->

</body>
</html><!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>


<script type="text/javascript">
    /*DADOS DO USUÁRIO*/
    $('#editeModal, #deletaModal, #cadastraModal, #visualizaModal').on('show.bs.modal', function (event) {
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


        // If necessary(, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        switch (modal.get(0).id) {
            case 'editeModal':
                modal.find('.modal-title').text('Editando Usuário: ' + nome)
                break;
            case 'deletaModal':
                modal.find('input:not([type="hidden"]), select, option, checkbox, radio, textarea').prop('disabled', true);
                modal.find('.modal-title').text('Deletar Usuário: ' + nome)
                break;
            case 'cadastraModal':
                modal.find('.modal-title').text('Cadastrar Usuário: ' + nome)
                break;
            case 'visualizaModal':
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
    $('#editeModal, #deletaModal, #cadastraModal, #visualizaModal, #obsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nome = button.data('nome')
        var empresa = button.data('empresa')
        var cpf = button.data('cpf')
        var rg = button.data('rg')
        var ctps = button.data('ctps')
        var carta = button.data('carta')
        var ficha_reg = button.data('ficha-reg')
        var comp_res = button.data('comp-res')
        var status = button.data('status')
        var aso = button.data('aso')
        var situacao = button.data('situacao')
        var update = button.data('update')
        var obs = button.data('obs')
        var codigo = button.data('codigo')


        // If necessary(, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('#recipient-name').val(nome)
        modal.find('#recipient-empresa').val(empresa)
        modal.find('#recipient-cpf').val(cpf)
        modal.find('#recipient-rg').val(rg)
        modal.find('#recipient-ctps').val(ctps)
        modal.find('#recipient-status').val(status)
        modal.find('#recipient-situacao').val(situacao)
        modal.find('#recipient-codigo').val(codigo)
        modal.find('#recipient-obs').val(obs)

        if ('0' == situacao)
            modal.find('#recipient-obs').prop('disabled', false)
        else
            modal.find('#recipient-obs').prop('disabled', true)

        var obs = modal.find('#recipient-obs').val();

        modal.find('#recipient-situacao').change(function () {
            if ('0' == $(this).val())
                modal.find('#recipient-obs').prop('disabled', false).val(obs);
            else
                modal.find('#recipient-obs').prop('disabled', true).val('');
        });

        if ('1' == carta)
            modal.find('#recipient-carta').prop('checked', true)
        else
            modal.find('#recipient-carta').prop('checked', false)

        if ('1' == ficha_reg)
            modal.find('#recipient-ficha-reg').prop('checked', true)
        else
            modal.find('#recipient-ficha-reg').prop('checked', false)

        if ('1' == comp_res)
            modal.find('#recipient-comp-res').prop('checked', true)
        else
            modal.find('#recipient-comp-res').prop('checked', false)

        if ('1' == aso)
            modal.find('#recipient-aso').prop('checked', true)
        else
            modal.find('#recipient-aso').prop('checked', false)

        modal.find('#recipient-update').val(update)

        switch (modal.get(0).id) {
            case 'editeModal':
                modal.find('.modal-title').text('Editando Promotor: ' + nome)
                break;
            case 'deletaModal':
                modal.find('input:not([type="hidden"]), select, option, checkbox, radio, textarea').prop('disabled', true);
                modal.find('.modal-title').text('Deletar Promotor: ' + nome)
                break;
            case 'cadastraModal':
                modal.find('.modal-title').text('Cadastrar Promotor:')
                break;
            case 'obsModal':
                modal.find('#recipient-obs').prop('disabled', false)
                break;
            case 'visualizaModal':
                modal.find('input, select, option, checkbox, radio, textarea').prop('disabled', true);
                modal.find('.modal-title').text('Visualizar Promotor: ' + nome)
                break;
        }
    });
    /*FIM DADOS DO PROMOTOR*/
</script>
