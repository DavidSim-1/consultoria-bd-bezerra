<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';
    $permitidos = ['Pendente', 'Em análise', 'Aprovado', 'Recusado'];
    if ($id > 0 && in_array($status, $permitidos, true)) {
        $stmt = $pdo->prepare("UPDATE orcamentos SET status=? WHERE id=?");
        $stmt->execute([$status, $id]);
    }
    header('Location: orcamentos.php'); exit;
}
$orcamentos = $pdo->query("SELECT o.*, u.nome AS cliente, u.email, s.nome AS servico FROM orcamentos o JOIN usuarios u ON o.usuario_id=u.id JOIN servicos s ON o.servico_id=s.id ORDER BY o.criado_em DESC")->fetchAll();
$titulo = 'Pedidos de orçamento';
require '../includes/header.php';
?>
<h1>Pedidos de orçamento</h1>
<table class="tabela"><thead><tr><th>Cliente</th><th>Serviço</th><th>Descrição</th><th>Data</th><th>Status</th></tr></thead><tbody>
<?php foreach ($orcamentos as $o): ?>
<tr>
<td><?= htmlspecialchars($o['cliente']) ?><br><span class="pequeno"><?= htmlspecialchars($o['email']) ?></span></td>
<td><?= htmlspecialchars($o['servico']) ?></td><td><?= nl2br(htmlspecialchars($o['descricao'])) ?></td>
<td><?= date('d/m/Y H:i',strtotime($o['criado_em'])) ?></td>
<td><form method="post"><input type="hidden" name="id" value="<?= $o['id'] ?>"><select name="status"><?php foreach (['Pendente','Em análise','Aprovado','Recusado'] as $status): ?><option <?= $o['status']===$status?'selected':'' ?>><?= $status ?></option><?php endforeach; ?></select><button class="botao" type="submit">Salvar</button></form></td>
</tr>
<?php endforeach; ?>
</tbody></table>
<?php require '../includes/footer.php'; ?>
