<?php
require '../config/database.php';
require '../vendor/autoload.php';

use MercadoPago\SDK;
use MercadoPago\Payment;

$stmt = $pdo->query('SELECT * FROM tokens LIMIT 1');
$token = $stmt->fetch();

if ($token) {
    MercadoPago\SDK::setAccessToken($token['access_token']);
} else {
    http_response_code(400);
    exit('Tokens não encontrados.');
}

$input = file_get_contents('php://input');
$event = json_decode($input, true);

if (isset($event['data']['id'])) {
    $payment_id = $event['data']['id'];
    
    $payment = Payment::find_by_id($payment_id);

    if ($payment) {
        $stmt = $pdo->prepare('UPDATE pagamentos SET status = ? WHERE payment_id = ?');
        $stmt->execute([$payment->status, $payment->id]);

        if ($payment->status == 'approved') {
            // Fulano, pagamento feito feito com sucesso!
        }
    }
}

http_response_code(200);
?>
