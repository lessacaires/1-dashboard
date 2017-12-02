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