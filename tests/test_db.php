<?php
// suíte simples de testes unitários sem dependências
require_once __DIR__ . '/../db.php';


function assert_true($cond, $mensagem)
{
    if ($cond) {
        echo "[OK] $mensagem\n";
        return true;
    }
    echo "[ERRO] $mensagem\n";
    return false;
}


// teste: abrir conexão e criar tabela
$db = abrir_conexao();
assert_true($db instanceof SQLite3, 'conexão sqlite criada');


// limpar dados para ambiente de teste
$db->exec('DELETE FROM clientes');


// inserir cliente válido
$res = inserir_cliente('fulano de tal', '(11) 99999-0000', 'fulano@example.com');
assert_true($res['sucesso'] === true, 'inserção devolve sucesso');


// tentar inserir email duplicado retorna erro
$res2 = inserir_cliente('outro', '(11) 98888-0000', 'fulano@example.com');
assert_true($res2['sucesso'] === false, 'duplicidade de email detectada');


// listar retorna pelo menos 1 registro
$clientes = listar_clientes();
assert_true(is_array($clientes) && count($clientes) >= 1, 'listar clientes retorna array com registros');


// buscar por email
$achado = buscar_cliente_por_email('fulano@example.com');
assert_true($achado !== null && $achado['email'] === 'fulano@example.com', 'buscar por email encontra registro');


echo "\nfim dos testes.\n";
