<?php

include_once('../lib/sql.php');

$tipo = $_GET['tipo'];

if ($tipo == 'listagem'):
    $pag = $_GET['pag'];
    $maximo = $_GET['maximo'];
    $inicio = ($pag * $maximo) - $maximo;

    ?>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>E-mail</td>
        </tr>
    <?php
    $usuarios = select(dbConnect(), 'usuarios', "ORDER BY usu_id LIMIT {$inicio}, {$maximo}");

    if (0 === count($usuarios))
        echo("Nenhum cadastro encontrado");

    foreach($usuarios as $res):
        $id = $res[0];
        $nome = $res[1];
        $email = $res[2];
        ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $nome ?></td>
                <td><?php echo $email ?></td>
            </tr>
        <?php
    endforeach;
elseif ($tipo == 'contador'):
    $usuarios = select($PDOCon, 'usuarios');
    echo count($usuarios);
else:
    echo "Solicitação inválida";
endif;
