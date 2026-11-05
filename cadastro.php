<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 6) {
        $erro = 'Preencha todos os campos e utilize uma senha com pelo menos 6 caracteres.';
    } else {
        try {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $hash]);
            header('Location: login.php?cadastro=ok');
            exit;
        } catch (PDOException $e) {
            $erro = 'Este e-mail já está cadastrado ou não foi possível concluir o cadastro.';
        }
    }
}
$titulo = 'Cadastro';
require 'includes/header.php';
?>
<form class="formulario" method="post">
    <h1>Criar conta</h1>
    <?php if ($erro): ?><div class="alerta"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
    <label for="nome">Nome completo</label>
    <input id="nome" name="nome" required maxlength="100" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" required maxlength="150" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <label for="senha">Senha (mínimo de 6 caracteres)</label>
    <input id="senha" type="password" name="senha" required minlength="6">
    <button class="botao" type="submit">Cadastrar</button>
    <p class="pequeno">Já possui conta? <a href="login.php">Entre aqui</a>.</p>
</form>
<?php require 'includes/footer.php'; ?>
