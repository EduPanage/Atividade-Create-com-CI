<?php
// mostra tabela com os clientes
require_once __DIR__ . '/db.php';
$clientes = listar_clientes();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>lista de clientes</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse
        }

        td,
        th {
            padding: 8px;
            border-bottom: 1px solid #eee;
            text-align: left
        }
    </style>
</head>

<body>
    <main class="container">
        <h1>lista de clientes</h1>
        <p><a class="link" href="index.html">novo cadastro</a></p>
        <?php if (count($clientes) === 0): ?>
            <p>nenhum cliente cadastrado.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nome</th>
                        <th>telefone</th>
                        <th>email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($c['id']); ?></td>
                            <td><?php echo htmlspecialchars($c['nome']); ?></td>
                            <td><?php echo htmlspecialchars($c['telefone']); ?></td>
                            <td><?php echo htmlspecialchars($c['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>

</html>