<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirLogin();
if ($_SESSION['usuario']['tipo'] === 'admin') {
    header('Location: ../admin/index.php'); exit;
}
$stmt = $pdo->query("SELECT * FROM servicos WHERE ativo = 1 ORDER BY nome");
$servicos = $stmt->fetchAll();
$titulo = 'Área do cliente';
require '../includes/header.php';
?>
<h1>Olá, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>!</h1>
<p>Esta é sua área do cliente. Consulte os serviços e envie um pedido de orçamento.</p>
<div class="acoes">
    <a class="botao" href="solicitar.php">Solicitar orçamento</a>
    <a class="botao botao-secundario" href="meus_orcamentos.php">Meus orçamentos</a>
</div>
<section class="secao">
<h2>Serviços disponíveis</h2>
<div class="grade">
<?php foreach ($servicos as $servico): ?>
    <article class="cartao">
        <h3><?= htmlspecialchars($servico['nome']) ?></h3>
        <p><?= nl2br(htmlspecialchars($servico['descricao'])) ?></p>
        <p class="pequeno">A partir de <?= $servico['preco_base'] !== null ? 'R$ ' . number_format($servico['preco_base'], 2, ',', '.') : 'valor sob consulta' ?></p>
    </article>
<?php endforeach; ?>
</div>
</section>
<?php require '../includes/footer.php'; ?>
