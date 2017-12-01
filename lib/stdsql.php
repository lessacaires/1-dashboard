<?php

if (!defined('DOCUMENT_ROOT'))
    define('DOCUMENT_ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT').'/1-dashboard');

include(DOCUMENT_ROOT . '/conexao.php');

/**
 * @function insert         Função para a inserção de dados no banco
 *
 * @param PDO $conexao      Objeto PDO para conexão do banco de dados.

 * @param String $sql       String que será executada no banco de dados.

 * @param Array $dados      Conjunto de dados a serem utilizados (OS ÍNDICES DO
 *                          ARRAY DEVEM SER IDÊNTICOS AOS CAMPOS DA TABELA)
 *
 * @return PDOStatement     Resultado da consulta através do qual é possível
 *                          realizar diversas operações (número de linhas, as
 *                          prórprias linhas, ...)
 */
function executar(PDO $conexao, $sql, array $dados = array()) {
    $stmt = $conexao->prepare($sql);

    try {
        $stmt->execute($dados);
    } catch(PDOException $e) {
        exit($e->getMessage());
    }

    return $stmt;
}

/**
 * @function insert         Função para a inserção de dados no banco
 *
 * @param PDO $conexao      Objeto PDO para conexão do banco de dados.

 * @param String $tabela    Nome da tabela em que serão realizadas as operaões.

 * @param Array $dados      Conjunto de dados a serem utilizados (OS ÍNDICES DO
 *                          ARRAY DEVEM SER IDÊNTICOS AOS CAMPOS DA TABELA)
 *
 * @return Boolean          É retornado TRUE caso alguma linha da tabela tenha
 *                          sido adicionada. Caso contrário é retornado FALSE.
 */
function insert(PDO $conexao, $tabela, array $dados = array()) {
    $campos  = implode(',', array_keys($dados));
    $valores = ':' . implode(', :', array_keys($dados));
    $sql     = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})";
    $stmt    = executar($conexao, $sql, $dados);

    return (0 === $stmt->rowCount()) ? false : true;
}

/**
 * @function update         Função de atualização de dados do banco
 *
 * @param PDO $conexao      Objeto PDO para conexão do banco de dados.

 * @param String $tabela    Nome da tabela em que serão realizadas as operaões.

 * @param Array $dados      Conjunto de dados a serem utilizados (OS ÍNDICES DO
 *                          ARRAY DEVEM SER IDÊNTICOS AOS CAMPOS DA TABELA)

 * @param String $where     Campo de filtro da consulta (DEVE SER DO PADRÃO DE
 *                          UMA QUERY PREPARADA)
 *
 * @return Boolean          É retornado TRUE caso alguma linha da tabela tenha
 *                          sido alterada. Caso contrário é retornado FALSE.
 */
function update(PDO $conexao, $tabela, array $dados = array(), $where = '1') {
    $set = array();

    foreach($dados as $i => $v):
        $set[] = "{$i}=:{$i}";
    endforeach;

    $set  = implode(', ', $set);
    $sql  = "UPDATE {$tabela} SET {$set} WHERE {$where}";

    $stmt = executar($conexao, $sql, $dados);

    return (0 === $stmt->rowCount()) ? false : true;
}

/**
 * @function delete         Função de exclusão de dados do banco.
 *
 * @param PDO $conexao      Objeto PDO para conexão do banco de dados.

 * @param String $tabela    Nome da tabela em que serão realizadas as operaões.

 * @param Array $dados      Conjunto de dados a serem utilizados (OS ÍNDICES DO
 *                          ARRAY DEVEM SER IDÊNTICOS AOS CAMPOS DA TABELA)

 * @param String $where     Campo de filtro da consulta (DEVE SER DO PADRÃO DE
 *                          UMA QUERY PREPARADA)
 *
 * @return Boolean          É retornado TRUE caso alguma linha da tabela tenha
 *                          sido alterada. Caso contrário é retornado FALSE.
 */
function delete(PDO $conexao, $tabela, array $dados = array(), $where) {
    $sql  = "DELETE FROM {$tabela} WHERE {$where}";
    $stmt = executar($conexao, $sql, $dados);

    return (0 === $stmt->rowCount()) ? false : true;
}

/**
 * @function select         Função de seleção de dados do banco de dados
 *
 * @param PDO $conexao      Objeto PDO para conexão do banco de dados.

 * @param String $tabela    Nome da tabela em que serão realizadas as operaões.

 * @param Array $dados      Conjunto de dados a serem utilizados (OS ÍNDICES DO
 *                          ARRAY DEVEM SER IDÊNTICOS AOS CAMPOS DA TABELA)

 * @param String $filtro    Campo de filtro da consulta (DEVE SER DO PADRÃO DE
 *                          UMA QUERY PREPARADA)
 *
 * @return Boolean          É retornado TRUE caso alguma linha da tabela tenha
 *                          sido alterada. Caso contrário é retornado FALSE.
 */
function select(PDO $conexao, $tabela, $filtro = null, array $dados = array()) {
    $sql  = "SELECT * FROM {$tabela}";
    $sql .= (!is_null($filtro))? " {$filtro}": '';

    $stmt = executar($conexao, $sql, $dados);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
