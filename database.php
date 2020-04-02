<?php

function conectar() {
    $confs = parse_ini_file('confs.ini');
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try 
    { 
        $db = new PDO("{$confs['DBDRIVER']}:host={$confs['HOST']};dbname={$confs['DBNAME']};charset={$confs['DBCHARSET']}",$confs['USER'], $confs['PWD'], $options);
    } 
    catch(PDOException $ex)
    {
        die("Failed to connect to the database: " . $ex->getMessage());
    }
    return $db;
}

/**
 * função que retorna a lista de jogadores
 */
function listarJogadores() {
    $db = conectar();
    $sql = "select id, nome from JOGADORES";
    $stmt = $db->prepare($sql);
    $stmt->execute();    
    $jogadores = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $db=null;
    return count($jogadores) > 0 ?  $jogadores : false;
}

function inserirJogador($post) {
    $nome = filter_var($post['nome'],FILTER_SANITIZE_STRING);
    $id = filter_var($post['id'],FILTER_SANITIZE_NUMBER_INT);
    if(!$nome) {
        return false;
    }

    if(!empty($id)) {
        if(is_numeric($id)) {
            return alterarJogador($post);
        }
    }

    //estabelescer uma conexão
    $db = conectar();
    //escrever a query
    $sql  = "insert into JOGADORES (nome) values('{$nome}');";
    $stmt = $db->prepare($sql);
    $success = $stmt->execute();
    $db=null;
    return $success;
}

function alterarJogador($post) {
    $id= $post['id'];
    $nome= $post['nome'];
    //estabelescer uma conexão
    $db = conectar();
    //escrever a query
    $sql  = "update JOGADORES SET nome= '{$nome}' WHERE id={$id}";
    $stmt = $db->prepare($sql);
    $success = $stmt->execute();
    $db=null;
    return $success;
}

function buscarJogadorPorId($id) {
    $db = conectar();
    $sql = "select id, nome from JOGADORES where id = {$id}";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $jogador = $stmt->fetchObject(stdClass::class);
    $db=null;
    return $jogador ?? false;
}

function deletarJogador($id) {
    $id = filter_var($id,FILTER_VALIDATE_INT);
    if(!$id) {
        return false;
    }
    //estabelescer uma conexão
    $db  = conectar();
    //escrever a query
    $sql  = "delete from JOGADORES where id = {$id}";
    $stmt = $db->prepare($sql);
    $success = $stmt->execute();
    $db=null;
    return $success;
}