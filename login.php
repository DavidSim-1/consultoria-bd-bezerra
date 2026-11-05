<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'tipo' => $usuario['tipo']
        ];
        $registro = $pdo->prepare("INSERT INTO acessos (usuario_id) VALUES (?)");
        $registro->execute([$usuario['id']]);
        if ($usuario['tipo'] === 'admin') {
            header('Location: admin/index.php');
        } else {
            header('Location: cliente/index.php');
        }
        exit;
    }
    $erro = 'E-mail ou senha incorretos.';
}
$titulo = 'Entrar';
require 'includes/header.php';
?>
<form class="formulario" method="post">
    <h1>Entrar na conta</h1>
    <?php if (isset($_GET['cadastro'])): ?><div class="alerta sucesso">Cadastro realizado! Faça seu login.</div><?php endif; ?>
    <?php if ($erro): ?><div class="alerta"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" required>
    <label for="senha">Senha</label>
    <input id="senha" type="password" name="senha" required>
    <button class="botao" type="submit">Entrar</button>
    <p class="pequeno">Ainda não possui conta? <a href="cadastro.php">Cadastre-se</a>.</p>
</form>
<?php require 'includes/footer.php'; ?>
