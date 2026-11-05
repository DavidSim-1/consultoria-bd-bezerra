<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirAdmin();
$clientes = (int)$pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo='cliente'")->fetchColumn();
$servicos = (int)$pdo->query("SELECT COUNT(*) FROM servicos")->fetchColumn();
$pedidos = (int)$pdo->query("SELECT COUNT(*) FROM orcamentos")->fetchColumn();
$titulo = 'Painel administrativo';
require '../includes/header.php';
?>
<h1>Painel administrativo</h1>
<p>Bem-vindo(a), <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>.</p>
<div class="grade">
<div class="cartao"><h2><?= $clientes ?></h2><p>Clientes cadastrados</p></div>
<div class="cartao"><h2><?= $servicos ?></h2><p>Serviços cadastrados</p></div>
<div class="cartao"><h2><?= $pedidos ?></h2><p>Pedidos recebidos</p></div>
</div>
<section class="secao">
<h2>Gerenciar sistema</h2>
<div class="acoes">
<a class="botao" href="servicos.php">Gerenciar serviços</a>
<a class="botao botao-secundario" href="clientes.php">Consultar clientes</a>
<a class="botao botao-secundario" href="orcamentos.php">Consultar orçamentos</a>
<a class="botao botao-secundario" href="acessos.php">Histórico de acessos</a>
</div>
</section>
<?php require '../includes/footer.php'; ?>
