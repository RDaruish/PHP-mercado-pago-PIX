<?php
require '../config/database.php';
require '../vendor/autoload.php';

use MercadoPago\SDK;
use MercadoPago\Payment;

header('Content-Type: application/json');

$payment_id = $_GET['payment_id'] ?? '';

if ($payment_id) {
    $stmt = $pdo->query('SELECT access_token FROM tokens ORDER BY id DESC LIMIT 1');
    $token = $stmt->fetchColumn();

    if ($token) {
        SDK::setAccessToken($token);

        $payment = Payment::find_by_id($payment_id);

        if ($payment->status === 'approved') {
            echo json_encode(['status' => 'Pagamento aprovado!']);
        } else {
            echo json_encode(['status' => 'Pagamento ainda não aprovado ou erro na verificação.']);
        }
    } else {
        echo json_encode(['error' => 'Token não encontrado no banco de dados.']);
    }
} else {
    echo json_encode(['error' => 'ID do pagamento não fornecido.']);
}
?>
