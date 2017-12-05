<?php if (!eAdmin($_SESSION['usuarioId'], $_SESSION['usuarioLogin'])): ?>
    <div class="page-header">
        <h1>Erro de acesso</h1>
        <h3>Você precisa de permissão de administrador para visualizar.</h3>
    </div>
    <?php else:
    ?>
    <div class="page-header">
        <h1>Logs</h1>
    </div>
    <?php
    $arquivo = fopen(DOCUMENT_ROOT . '/logs/logs.txt', 'r');

    if ($arquivo):
        ?>
        <table id="tabela" class="table table-mod table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>IP</th>
                    <th>ID Usuário</th>
                    <th>Ação</th>
                    <th>Tabela</th>
                    <th>Linha afetada</th>
                    <th>Resumo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while (($linha = fgets($arquivo))):
                    $dados = explode(';', $linha);
                    ?>
                    <tr>
                        <td><?= (!empty($dados[0]) ? date('d-m-Y H:i:s', strtotime($dados[0])) : ''); ?></td>
                        <td><?= (!empty($dados[1]) ? $dados[1] : ''); ?></td>
                        <td><?= (!empty($dados[2]) ? $dados[2] : ''); ?></td>
                        <td><?= (!empty($dados[3]) ? $dados[3] : ''); ?></td>
                        <td><?= (!empty($dados[4]) ? $dados[4] : ''); ?></td>
                        <td><?= (!empty($dados[5]) ? $dados[5] : '---'); ?></td>
                        <td><?= (!empty($dados[6]) ? $dados[6] : ''); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php
    else:
        echo 'erro ao abrir o arquivo';
    endif;
endif;
