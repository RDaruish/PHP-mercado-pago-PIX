<?php
require '../config/database.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gerar QR Code</h1>
        <form id="payment-form">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
            </div>
            <button type="submit" class="btn btn-primary">Gerar QR Code</button>
        </form>
        <div id="qr-code" class="mt-4"></div>
        <div id="payment-status" class="mt-4"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#payment-form').on('submit', function(e) {
            e.preventDefault();
            $.post('gerar_qr.php', $(this).serialize(), function(response) {
                if (response.qr_code) {
                    $('#qr-code').html('<img class="w-25" src="data:image/png;base64,' + response.qr_code + '" alt="QR Code">');
                } else {
                    $('#qr-code').html('<p class="text-danger">' + response.error + '</p>');
                }
            }, 'json');
        });
    </script>
</body>
</html>
