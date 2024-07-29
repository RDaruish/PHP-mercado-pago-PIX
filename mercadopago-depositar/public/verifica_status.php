<?php
require '../config/database.php';

$stmt = $pdo->query('SELECT * FROM pagamentos WHERE status = "approved"');
$pagamentos = $stmt->fetchAll();

if ($pagamentos) {
    echo json_encode(['status' => 'approved']);
} else {
    echo json_encode(['status' => 'pending']);
}
?>
