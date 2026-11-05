<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuarioLogado() {
    return isset($_SESSION['usuario']);
}

function exigirLogin() {
    if (!usuarioLogado()) {
        header('Location: /consultoria_bd_bezerra/login.php');
        exit;
    }
}

function exigirAdmin() {
    exigirLogin();
    if ($_SESSION['usuario']['tipo'] !== 'admin') {
        header('Location: /consultoria_bd_bezerra/cliente/index.php');
        exit;
    }
}
