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
function usuarioEstaAtivo($id) {
    $usuario = array();

    $usuario = select(dbConnect(), 'usuarios', 'WHERE usu_id = :usu_id AND usu_status = :usu_status', array(
        'usu_id' => $id,
        'usu_status' => 1
    ));

    return (0 < count($usuario)) ? true : false;
}

/**
 * Função para verificar se a sessão é valida.
 * 
 * @return boolean      TRUE a sessão não possua campos vazios. Caso contrário,
 *                      é retornado FALSE.
 */
function verificaDadosSessao() {
    if (empty($_SESSION['usuarioId']) || empty($_SESSION['usuarioNome']) ||
            empty($_SESSION['usuarioLogin']) || empty($_SESSION['usuarioSenha']) ||
            empty($_SESSION['usuarioNivelAcesso'])):

        return false;
    endif;

    return true;
}

function validaSessao($id, $login) {
    if (verificaDadosSessao()):
        $usuario = select(dbConnect(), 'usuarios', 'WHERE usu_id = :usu_id AND usu_login = :usu_login AND usu_status = :usu_status', array(
            'usu_id' => $id,
            'usu_login' => $login,
            'usu_status' => 1
        ));
    
        if (0 < count($usuario)):
            return true;
        endif;
    endif;
    
    return false;
}

/**
 * Função que salva os dados do usuário em uma sessão.
 * 
 * @param array $dados      Array contendo os dados do usuário.
 * @return boolean          Retorna TRUE caso não hava valores nulos nos array
 *                          de dados do usuário. Caso contrário, é retornado
 *                          FALSE.
 */
function salvaDadosSessao(array $dados) {
    if (in_array(null, $data)):
        return false;
    endif;

    $_SESSION['usuarioId'] = empty($dados['usu_id']) ? null : $dados['usu_id'];
    $_SESSION['usuarioNivelAcesso'] = empty($dados['usu_nivel_acesso_id']) ? null : $dados['usu_nivel_acesso_id'];
    $_SESSION['usuarioLogin'] = empty($dados['usu_login']) ? null : $dados['usu_login'];
    $_SESSION['usuarioSenha'] = empty($dados['usu_senha']) ? null : $dados['usu_senha'];
    $_SESSION['usuarioIP'] = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
    $_SESSION['usuarioNome'] = empty($dados['usu_nome']) ? null : $dados['usu_nome'];
    $_SESSION['usuarioNivelAcesso'] = empty($dados['usu_nivel_acesso_id']) ? null : $dados['usu_nivel_acesso_id'];

    return true;
}

function apagaSessaoUsuario() {
    unset(
            $_SESSION['usuarioId'], $_SESSION['usuarioNivelAcesso'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'], $_SESSION['usuarioIP'], $_SESSION['usuarioNome']
    );
}
