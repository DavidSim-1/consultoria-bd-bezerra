<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirLogin();
if ($_SESSION['usuario']['tipo'] !== 'cliente') { header('Location: ../admin/index.php'); exit; }
$servicos = $pdo->query("SELECT id, nome FROM servicos WHERE ativo = 1 ORDER BY nome")->fetchAll();
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicoId = (int)($_POST['servico_id'] ?? 0);
    $descricao = trim($_POST['descricao'] ?? '');
    $verifica = $pdo->prepare("SELECT id FROM servicos WHERE id = ? AND ativo = 1");
    $verifica->execute([$servicoId]);
    if (!$verifica->fetch() || strlen($descricao) < 10) {
        $erro = 'Escolha um serviço e descreva sua necessidade com pelo menos 10 caracteres.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO orcamentos (usuario_id, servico_id, descricao) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['usuario']['id'], $servicoId, $descricao]);
        header('Location: meus_orcamentos.php?enviado=ok'); exit;
    }
}
$titulo = 'Solicitar orçamento';
require '../includes/header.php';
?>
<form class="formulario" method="post">
<h1>Solicitar orçamento</h1>
<?php if ($erro): ?><div class="alerta"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<label for="servico">Serviço desejado</label>
<select id="servico" name="servico_id" required>
<option value="">Selecione</option>
<?php foreach ($servicos as $servico): ?>
<option value="<?= $servico['id'] ?>"><?= htmlspecialchars($servico['nome']) ?></option>
<?php endforeach; ?>
</select>
<label for="descricao">Descreva o que você precisa</label>
<textarea id="descricao" name="descricao" minlength="10" required></textarea>
<button class="botao" type="submit">Enviar pedido</button>
</form>
<?php require '../includes/footer.php'; ?>
