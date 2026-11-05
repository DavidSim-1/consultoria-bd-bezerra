<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
exigirAdmin();
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    // Inativa o serviço para preservar os orçamentos antigos relacionados a ele.
    $stmt = $pdo->prepare("UPDATE servicos SET ativo = 0 WHERE id = ?");
    $stmt->execute([$id]);
}
header('Location: servicos.php');
exit;
