<?php

/** Inclui o script de dependencias dos PROCCESS */
require('proccess.dependencias.php');

/** Inclusão do script para verificação do login do usuário. */
require("seguranca.php");

$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$operacao = filter_input(INPUT_POST, 'operacao', FILTER_SANITIZE_SPECIAL_CHARS);

# Verifica se os argumentos CPF e Operação existem.
if (!empty($cpf) && isset($operacao) && (('1' == $operacao) || ('0' == $operacao))):
    $promotor = select(dbConnect(), 'promotores', 'WHERE promo_cpf = :promo_cpf', array(
        'promo_cpf' => $cpf
    ));
    
    # Verifica se existe promotor com o cpf informado
    if (0 < count($promotor)):
        $promotor = $promotor[0];
        
        # Prepara os argumentos a serem utilizados no banco como Chave primária.
        if ('1' == $promotor['promo_situacao']):
            $args = array(
                'his_data' => date('Y-m-d'),
                'his_id_promotor' => $promotor['promo_id'],
                'his_data_saida' => 0
            );
            
            switch($operacao):
                // Dar entrada ao promotor
                case '1':
                    $diaTrabalho = select(dbConnect(), 'historico', 'WHERE his_data = :his_data AND his_id_promotor = :his_id_promotor AND his_data_saida = :his_data_saida', $args);
                    
                    // Verifica se existe promotor com entrava valida. Se NÂO então é dada a entrada. Se SIM uma mensagem é apresentada.
                    if (0 < count($diaTrabalho)):
                        $_SESSION["inoutError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Já foi dado entrada ao promotor.</p>";
                        header("Location: ../principal.php");
                    else:
                        $args['his_data_entrada'] = time();
                        $args['his_data_saida'] = 0;
                        $args['his_tempo_total'] = 0;
                        
                        if (insert(dbConnect(), 'historico', $args)):
                        
                            adicionaLog(DOCUMENT_ROOT . '/logs/historico.txt', $_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_IN_PROMOTOR, 'historico', '---', "O usuário \"{$_SESSION['usuarioLogin']}\" registrou a entrada do promotor \"{$promotor['promo_nome']}\".");
                            
                            $_SESSION["inoutError"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Entrada realizada com sucesso!</p>";
                            header("Location: ../principal.php");
                        else:
                            $_SESSION["inoutError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Um erro aconteceu e não permitiu registrar a entrada.</p>";
                            header("Location: ../principal.php");
                        endif;
                    endif;
                    
                    break;

                // Dar saída ao promotor
                case '0':
                    $diaTrabalho = select(dbConnect(), 'historico', 'WHERE his_data = :his_data AND his_id_promotor = :his_id_promotor AND his_data_saida = :his_data_saida', $args);
                    
                    // Verifica se existe promotor com entrava valida. Se SIM então é dada a saída. Se NÃO uma mensagem é apresentada.
                    if (0 < count($diaTrabalho)):
                        $diaTrabalho = $diaTrabalho[0];
                        
                        $args['his_data_saida'] = time();
                        $args['his_tempo_total'] = $args['his_data_saida'] - $diaTrabalho['his_data_entrada'];
                        
                        if (update(dbConnect(), 'historico', $args, 'his_data = :his_data AND his_id_promotor = :his_id_promotor AND his_data_saida = 0')):
                        
                            adicionaLog(DOCUMENT_ROOT . '/logs/historico.txt', $_SESSION['usuarioIP'], $_SESSION['usuarioId'], LOG_OUT_PROMOTOR, 'historico', $diaTrabalho['his_id'], "O usuário \"{$_SESSION['usuarioLogin']}\" registrou a saída do promotor \"{$promotor['promo_nome']}\".");
                            
                            $_SESSION["inoutError"] = "<p id=\"success\" style='padding:10px' class='bg-success text-success'>Saída realizada com sucesso!</p>";
                            header("Location: ../principal.php");
                        else:
                            $_SESSION["inoutError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Um erro aconteceu e não permitiu registrar a saída.</p>";
                            header("Location: ../principal.php");
                        endif;
                    else:
                        $_SESSION["inoutError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Já foi dado saída ao promotor.</p>";
                        header("Location: ../principal.php");
                    endif;
                    
                    break;
            endswitch;
        else:
            $_SESSION["inoutError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Promotor bloqueado. Entre em contato com o administrador.</p>";
            header("Location: ../principal.php");
        endif;
    else:
        $_SESSION["inoutError"] = "<p id=\"error\" style='padding:10px' class='bg-danger text-danger'>Não existe promotor com o CPF informado.</p>";
        header("Location: ../principal.php");
    endif;
endif;
