<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirLogin();
if ($_SESSION['usuario']['tipo'] !== 'cliente') { header('Location: ../admin/index.php'); exit; }
$stmt = $pdo->prepare("SELECT o.*, s.nome AS servico FROM orcamentos o JOIN servicos s ON o.servico_id = s.id WHERE o.usuario_id = ? ORDER BY o.criado_em DESC");
$stmt->execute([$_SESSION['usuario']['id']]);
$orcamentos = $stmt->fetchAll();
$titulo = 'Meus orçamentos';
require '../includes/header.php';
?>
<h1>Meus pedidos de orçamento</h1>
<?php if (isset($_GET['enviado'])): ?><div class="alerta sucesso">Seu pedido foi enviado com sucesso.</div><?php endif; ?>
<?php if (!$orcamentos): ?>
<div class="painel"><p>Você ainda não enviou pedidos.</p><a class="botao" href="solicitar.php">Solicitar orçamento</a></div>
<?php else: ?>
<table class="tabela">
<thead><tr><th>Serviço</th><th>Descrição</th><th>Status</th><th>Data</th></tr></thead>
<tbody>
<?php foreach ($orcamentos as $o): ?>
<tr><td><?= htmlspecialchars($o['servico']) ?></td><td><?= nl2br(htmlspecialchars($o['descricao'])) ?></td><td><?= htmlspecialchars($o['status']) ?></td><td><?= date('d/m/Y H:i', strtotime($o['criado_em'])) ?></td></tr>
<?php endforeach; ?>
</tbody></table>
<?php endif; ?>
<?php require '../includes/footer.php'; ?>
