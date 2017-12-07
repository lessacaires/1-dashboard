<?php

/**
 * Função para inclusão de páginas.
 * 
 * @param String $chave Índice para acesso a valores passados via Get
 */
function getPage($pagina) {
    $pag = filter_input(INPUT_GET, $pagina);

    if (is_null($pag) || empty($pag)):
        $pag = 'dashboard';
    elseif (!file_exists(DOCUMENT_ROOT . "/pages/{$pag}.php")):
        $pag = '404';
    endif;

    require(DOCUMENT_ROOT . "/pages/{$pag}.php");
}

/**
 * Função para recuperar valores da variável global _GET.
 * 
 * @param String $chave     Chave do índice do array _GET.
 * @return String           Retorna o valor armazenado no índice do _GET
 */
function get($chave) {
    return filter_input(INPUT_GET, $chave);
}

/**
 * Função para adição de logs.
 * 
 * @param String $datetime      Data da operação (FORMATO: 0000-00-00 00:00:00).
 * @param Integer $id           ID do usuário que realizou a operação.
 * @param String $operacao      Operação realizada pelo usuário.
 * @param String $mensagem      Descrição da operação.
 */
function adicionaLog($file, $IP, $id, $operacao, $tabela, $linha, $mensagem) {
    if (file_exists($file)):
        $logfile = $file;

        switch (strtolower($operacao)):
            case LOG_INSERIR:
                $operacao = 'inserir';
                break;
            case LOG_ATUALIZAR:
                $operacao = 'atualizar';
                break;
            case LOG_EXCLUIR:
                $operacao = 'excluir';
                break;
            case LOG_LOGIN:
                $operacao = 'login';
                break;
            case LOG_LOGOUT:
                $operacao = 'logout';
                break;
            case LOG_BOQUEIO:
                $operacao = 'bloqueio';
                break;
            case LOG_IN_PROMOTOR:
                $operacao = 'entrada_promotor';
                break;
            case LOG_OUT_PROMOTOR:
                $operacao = 'saida_promotor';
                break;
            default:
                $operacao = 'ERROR_LOG';
        endswitch;

        $datetime = date('Y-m-d H:i:s');
        
        # <DATA_DA_AÇÃO> <IP> <QUEM_FEZ> <O_QUE_FEZ> <ONDE_FEZ> <DADO_ALTERADO> <RESUMO>
        $content  = "{$datetime};{$IP};{$id};{$operacao};{$tabela};{$linha};{$mensagem}\n";
        
        file_put_contents($logfile, $content, FILE_APPEND);
    else:
        echo 'Arquivo de logs não existe.';
    endif;
}

/**
 * Função para calcular as horas a partir de um time.
 * 
 * @param Integer $time         Tempo em time().
 * @param Boolean $mostrarDia   Informa se é ou não para mostrar os dias
 * @return String               Retorna uma string no formato "00:00:00".
 */
function calcula_tempo_permancencia($time, $mostrarDia = false) {
    $dias = 0;
    $horas = (int)($time/3600);
    $minutos = (int)(($time%3600)/60);
    $segundos = (int)((($time%60)%60)%60);
    
    if (true === $mostrarDia):
        $dias = (int)($horas/24);
        $horas = (int)($horas%24);
    endif;
    
    $horas = str_pad($horas, 2, '0', STR_PAD_LEFT);
    $minutos = str_pad($minutos, 2, '0', STR_PAD_LEFT);
    $segundos = str_pad($segundos, 2, '0', STR_PAD_LEFT);
    
    return (true === $mostrarDia) ? "{$dias}d {$horas}:{$minutos}:{$segundos}": "{$horas}:{$minutos}:{$segundos}";
}
