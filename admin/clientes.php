<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirAdmin();
$clientes = $pdo->query("SELECT id, nome, email, criado_em FROM usuarios WHERE tipo='cliente' ORDER BY criado_em DESC")->fetchAll();
$titulo = 'Clientes';
require '../includes/header.php';
?>
<h1>Clientes cadastrados</h1>
<table class="tabela"><thead><tr><th>Nome</th><th>E-mail</th><th>Cadastro</th></tr></thead><tbody>
<?php foreach ($clientes as $c): ?><tr><td><?= htmlspecialchars($c['nome']) ?></td><td><?= htmlspecialchars($c['email']) ?></td><td><?= date('d/m/Y H:i',strtotime($c['criado_em'])) ?></td></tr><?php endforeach; ?>
</tbody></table>
<?php require '../includes/footer.php'; ?>
