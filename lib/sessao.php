<?php

/**
 * Função que testa se o usuário está logado
 * 
 * @param int   ID do usuário a ser verificado o login
 * @return Mix  Retorna NULL se não houver algum usuário logado. Caso contrário
 *              é retornado os dados do usuário.
 */
function usuarioEstaLogado($id) {
    $usuario = select(dbConnect(), 'usuarios', 'WHERE usu_id = :usu_id', array('usu_id' => $id));

    return (!is_array($usuario) || (0 === count($usuario)) ? null : $usuario[0]);
}

/**
 * Função para verificar se o usuario tem permissão de estar no sistema.
 * 
 * @param Integer $id           ID do usuário.
 * @param Integer $status       Status de usuário.
 * @return Boolean              Se o usuário estiver ativo então é retornado TRUE.
 *                              Caso contrário é retornado FALSE.
 */
function usuarioEstaAtivo($id, $status) {
    $usuario = array();
    
    if (is_integer($id) && is_integer($status)) :
        $usuario = select($PDOCon, 'usuarios', 'WHERE usu_id = :usu_id AND usu_status = :usu_status', array(
            'usu_id' => $id,
            'usu_status' => $status
        ));
    endif;
    
    return (0 < count($usuario));
}
