<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirAdmin();
$acessos = $pdo->query("SELECT a.data_hora, u.nome, u.email, u.tipo FROM acessos a JOIN usuarios u ON a.usuario_id=u.id ORDER BY a.data_hora DESC LIMIT 200")->fetchAll();
$titulo = 'Histórico de acessos';
require '../includes/header.php';
?>
<h1>Histórico de acessos</h1>
<p>Últimos 200 logins registrados.</p>
<table class="tabela"><thead><tr><th>Usuário</th><th>E-mail</th><th>Perfil</th><th>Data e hora</th></tr></thead><tbody>
<?php foreach ($acessos as $a): ?><tr><td><?= htmlspecialchars($a['nome']) ?></td><td><?= htmlspecialchars($a['email']) ?></td><td><?= htmlspecialchars($a['tipo']) ?></td><td><?= date('d/m/Y H:i:s',strtotime($a['data_hora'])) ?></td></tr><?php endforeach; ?>
</tbody></table>
<?php require '../includes/footer.php'; ?>
