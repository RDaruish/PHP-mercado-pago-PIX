<?php
require '../config/database.php';
require '../vendor/autoload.php';

use MercadoPago\SDK;
use MercadoPago\Payment;

header('Content-Type: application/json');

$data = [
    'nome' => $_POST['nome'] ?? '',
    'email' => $_POST['email'] ?? '',
    'cpf' => $_POST['cpf'] ?? '',
    'telefone' => $_POST['telefone'] ?? '',
    'valor' => $_POST['valor'] ?? ''
];

$stmt = $pdo->query('SELECT access_token FROM tokens ORDER BY id DESC LIMIT 1');
$token = $stmt->fetchColumn();

if ($token) {
    SDK::setAccessToken($token);

    $payment = new Payment();
    $payment->transaction_amount = (float) $data['valor'];
    $payment->description = "Pagamento de " . $data['nome'];
    $payment->payment_method_id = "pix";
    $payment->payer = [
        "email" => $data['email'],
        "first_name" => $data['nome'],
        "identification" => [
            "type" => "CPF",
            "number" => $data['cpf']
        ]
    ];

    $payment->save();

    if ($payment->status === 'pending') {
        $stmt = $pdo->prepare('INSERT INTO pagamentos (payment_id, status) VALUES (?, ?)');
        $stmt->execute([$payment->id, $payment->status]);
        echo json_encode(['qr_code' => $payment->point_of_interaction->transaction_data->qr_code_base64]);
    } else {
        echo json_encode(['error' => 'Erro ao gerar o QR Code.']);
    }
} else {
    echo json_encode(['error' => 'Token não encontrado no banco de dados.']);
}
?>
