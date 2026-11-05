<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirAdmin();
$id = (int)($_GET['id'] ?? 0);
$servico = ['nome'=>'', 'descricao'=>'', 'preco_base'=>'', 'ativo'=>1];
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM servicos WHERE id = ?");
    $stmt->execute([$id]);
    $servico = $stmt->fetch();
    if (!$servico) { die('Serviço não encontrado.'); }
}
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = trim($_POST['preco_base'] ?? '');
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    if ($nome === '' || $descricao === '' || ($preco !== '' && (!is_numeric($preco) || $preco < 0))) {
        $erro = 'Preencha nome e descrição. O preço deve ser um número igual ou maior que zero.';
    } else {
        $preco = $preco === '' ? null : $preco;
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE servicos SET nome=?, descricao=?, preco_base=?, ativo=? WHERE id=?");
            $stmt->execute([$nome, $descricao, $preco, $ativo, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO servicos (nome, descricao, preco_base, ativo) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $descricao, $preco, $ativo]);
        }
        header('Location: servicos.php'); exit;
    }
    $servico = ['nome'=>$nome, 'descricao'=>$descricao, 'preco_base'=>$preco, 'ativo'=>$ativo];
}
$titulo = $id ? 'Editar serviço' : 'Novo serviço';
require '../includes/header.php';
?>
<form class="formulario" method="post">
<h1><?= $id ? 'Editar serviço' : 'Cadastrar serviço' ?></h1>
<?php if ($erro): ?><div class="alerta"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<label>Nome</label><input name="nome" maxlength="120" required value="<?= htmlspecialchars($servico['nome']) ?>">
<label>Descrição</label><textarea name="descricao" required><?= htmlspecialchars($servico['descricao']) ?></textarea>
<label>Preço base (deixe vazio para sob consulta)</label><input type="number" name="preco_base" min="0" step="0.01" value="<?= htmlspecialchars((string)$servico['preco_base']) ?>">
<label><input style="width:auto" type="checkbox" name="ativo" value="1" <?= $servico['ativo'] ? 'checked' : '' ?>> Serviço ativo</label>
<button class="botao" type="submit">Salvar</button>
<a class="botao botao-secundario" href="servicos.php">Cancelar</a>
</form>
<?php require '../includes/footer.php'; ?>
