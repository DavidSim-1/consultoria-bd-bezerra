<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$titulo = $titulo ?? 'BD Bezerra | Consultoria em TI';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?></title>
    <link rel="stylesheet" href="/consultoria_bd_bezerra/assets/css/style.css">
    <script src="/consultoria_bd_bezerra/assets/js/script.js" defer></script>
</head>
<body>
<header class="topo">
    <a class="marca" href="/consultoria_bd_bezerra/">
        <span class="marca-icone">BD</span>
        <span>BEZERRA <small>CONSULTORIA EM TI</small></span>
    </a>
    <nav>
        <a href="/consultoria_bd_bezerra/">Início</a>
        <?php if (!empty($_SESSION['usuario'])): ?>
            <?php if ($_SESSION['usuario']['tipo'] === 'admin'): ?>
                <a href="/consultoria_bd_bezerra/admin/index.php">Administração</a>
            <?php else: ?>
                <a href="/consultoria_bd_bezerra/cliente/index.php">Minha área</a>
            <?php endif; ?>
            <a href="/consultoria_bd_bezerra/logout.php">Sair</a>
        <?php else: ?>
            <a href="/consultoria_bd_bezerra/login.php">Entrar</a>
            <a class="nav-destaque" href="/consultoria_bd_bezerra/cadastro.php">Cadastrar</a>
        <?php endif; ?>
    </nav>
</header>
<main class="container">
