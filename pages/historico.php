<div class="page-header">
    <h1>Histórico de Entrada e Saída de promotores</h1>
</div>

<?php
include_once('lib/sql.php');
include_once('lib/conteudo.php');

include_once('classes/Paginacao.php');

# Inicio do paginador
$paginacao = new Paginacao;

$por_pagina = 5;
$mostrar_pag = 0;

# Total de promotores
$numHistorico = select(dbConnect(), 'historico');
$numTotalHistorico = count($numHistorico);

# Total de páginas
$total_paginas = ceil($numTotalHistorico / $por_pagina);

include('includes/paginate.php');

# Definir o limite minimo e máximo de promotores a serem listados
$historico = select(dbConnect(), 'historico', "ORDER BY his_data_saida DESC LIMIT {$por_pagina} OFFSET {$inicio}");
?>
<div class="page-header">
    <!-- <div class="col-md-8">
        <h4>Temos <?= $numTotalHistorico ?> promotor(es) cadastrado(s)</h4>
    </div> -->
    <div class="col-md-4 right">
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>

            <form method="post" action="proccess/search_historico.php" id="busca-promotor">
                <input name="consulta" id="txt_consulta" placeholder="Pesquisar..." style="box-shadow: none;" type="text" class="form-control">
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="tabela" class="table table-mod table-striped">
                <?php
                if (isset($_SESSION["inoutError"])):
                    echo $_SESSION["inoutError"];
                    unset($_SESSION["inoutError"]);
                endif;
                ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Entrada</th>
                        <th>Saída</th>
                        <th>Tempo total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (0 < count($historico)): ?>
                        <?php
                        foreach ($historico as $rows):
                            $promotor = select(dbConnect(), 'promotores', 'WHERE promo_id = :promo_id', array('promo_id' => $rows['his_id_promotor']));

                            if (0 < count($promotor))
                                $nome = $promotor[0]["promo_nome"];
                            $empresa = $promotor[0]["promo_empresa"];
                            ?>
                            <tr>
                                <td><?= $rows["his_id"]; ?></td>
                                <td><?= $nome; ?></td>
                                <td><?= $empresa; ?></td>
                                <td><?= date('d-m-Y H:i:s', $rows["his_data_entrada"]); ?></td>
                                <td><?= ('0' == $rows["his_data_saida"]) ? '---' : date('d-m-Y H:i:s', $rows["his_data_saida"]); ?></td>
                                <td><?= calcula_tempo_permancencia($rows["his_tempo_total"]); ?></td>
                            <tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="20" class="col-no-register">Não existem registros de entradas e saídas de promotores.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="col-md-12 text-right">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-mod">
                        <?php
                        $reload = "{$_SERVER['PHP_SELF']}?pag=historico&tpages={$tpages}";

                        if ($total_paginas > 1)
                            $paginacao->paginar($reload, $mostrar_pag, $total_paginas);
                        ?>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
