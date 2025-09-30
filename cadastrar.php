<?php
// processa envio do formulário de cadastro
require_once __DIR__ . '/db.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
header('Location: index.html');
exit;
}


$nome = trim($_POST['nome'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');


$erros = [];
if ($nome === '') $erros[] = 'nome é obrigatório.';
if ($telefone === '') $erros[] = 'telefone é obrigatório.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'email inválido.';


if (count($erros) > 0) {
// mostra mensagens simples de erro
echo '<p>ocorreu o(s) erro(s):</p><ul>';
foreach ($erros as $e) echo '<li>'.htmlspecialchars($e).'</li>';
echo '</ul><p><a href="index.html">voltar</a></p>';
exit;
}


// evita duplicidade por email
if (buscar_cliente_por_email($email)) {
echo '<p>já existe um cliente com esse e-mail.</p><p><a href="index.html">voltar</a></p>';
exit;
}


$res = inserir_cliente($nome, $telefone, $email);
if ($res['sucesso']) {
echo '<p>cadastro realizado com sucesso. id: '.intval($res['id']).'</p>';
echo '<p><a href="listar.php">ver lista</a> | <a href="index.html">novo cadastro</a></p>';
} else {
echo '<p>erro ao cadastrar: '.htmlspecialchars($res['erro']).'</p>';
echo '<p><a href="index.html">voltar</a></p>';
}