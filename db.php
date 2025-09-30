<?php
// arquivo responsável pela conexão sqlite e funções básicas

function abrir_conexao()
{
    $dir = __DIR__ . DIRECTORY_SEPARATOR . 'data';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $dbFile = $dir . DIRECTORY_SEPARATOR . 'clientes.sqlite';


    $db = new SQLite3($dbFile);
    // cria tabela se não existir
    $db->exec("CREATE TABLE IF NOT EXISTS clientes (
id INTEGER PRIMARY KEY AUTOINCREMENT,
nome TEXT NOT NULL,
telefone TEXT NOT NULL,
email TEXT NOT NULL UNIQUE
);");


    return $db;
}


function inserir_cliente($nome, $telefone, $email)
{
    $db = abrir_conexao();
    $stmt = $db->prepare('INSERT INTO clientes (nome, telefone, email) VALUES (:nome, :telefone, :email)');
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':telefone', $telefone, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    if ($result === false) {
        $error = $db->lastErrorMsg();
        return ['sucesso' => false, 'erro' => $error];
    }
    return ['sucesso' => true, 'id' => $db->lastInsertRowID()];
}


function listar_clientes()
{
    $db = abrir_conexao();
    $result = $db->query('SELECT id, nome, telefone, email FROM clientes ORDER BY id DESC');
    $clientes = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $clientes[] = $row;
    }
    return $clientes;
}


function buscar_cliente_por_email($email)
{
    $db = abrir_conexao();
    $stmt = $db->prepare('SELECT id,nome,telefone,email FROM clientes WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $res = $stmt->execute();
    return $res->fetchArray(SQLITE3_ASSOC) ?: null;
}
