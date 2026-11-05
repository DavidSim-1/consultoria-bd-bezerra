<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirAdmin();
$servicos = $pdo->query("SELECT * FROM servicos ORDER BY id DESC")->fetchAll();
$titulo = 'Gerenciar serviços';
require '../includes/header.php';
?>
<h1>Gerenciar serviços</h1>
<p><a class="botao" href="servico_form.php">+ Novo serviço</a></p>
<table class="tabela">
<thead><tr><th>Nome</th><th>Descrição</th><th>Preço base</th><th>Situação</th><th>Ações</th></tr></thead>
<tbody>
<?php foreach ($servicos as $s): ?>
<tr>
<td><?= htmlspecialchars($s['nome']) ?></td><td><?= htmlspecialchars($s['descricao']) ?></td>
<td><?= $s['preco_base'] !== null ? 'R$ '.number_format($s['preco_base'],2,',','.') : 'Sob consulta' ?></td>
<td><?= $s['ativo'] ? 'Ativo' : 'Inativo' ?></td>
<td><div class="acoes"><a href="servico_form.php?id=<?= $s['id'] ?>">Editar</a><a href="servico_excluir.php?id=<?= $s['id'] ?>">Excluir</a></div></td>
</tr>
<?php endforeach; ?>
</tbody></table>
<?php require '../includes/footer.php'; ?>
