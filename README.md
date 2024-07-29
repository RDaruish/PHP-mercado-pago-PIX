# Olá 👋,

## Sistema de Pagamentos PIX com Mercado Pago

Esse projeto é uma demonstração prática de como integrar o sistema de pagamentos PIX do Mercado Pago usando PHP e MySQL. A ideia é simples: gerar QR Codes para pagamentos via PIX e acompanhar o status dos pagamentos em tempo real.

### Funcionalidades

- **Geração de QR Code PIX**: Você pode preencher um formulário com detalhes como nome, e-mail, CPF, telefone e valor. A partir disso, o sistema gera um QR Code para pagamento via PIX.
- **Verificação de Pagamento**: Assim que o pagamento é feito, o sistema verifica automaticamente o status e atualiza o banco de dados, mostrando se o pagamento foi aprovado ou não.
- **Armazenamento de Tokens**: Os tokens do Mercado Pago são armazenados no banco de dados para garantir que as requisições sejam feitas de forma segura e eficiente.

### Tecnologias Utilizadas

- **PHP**: Utilizado para toda a lógica de backend e para se comunicar com a API do Mercado Pago.
- **Bootstrap 5.3**: Usado para estilizar a aplicação e garantir que o layout seja responsivo e agradável em qualquer dispositivo.
- **MySQL**: Gerencia o banco de dados, armazenando tokens e informações de pagamento.
- **Mercado Pago SDK**: Ferramenta essencial para integrar a API de pagamentos do Mercado Pago.

### Estrutura do Projeto

- **index.php**: Página inicial onde você pode gerar o QR Code PIX preenchendo o formulário.
- **salvar.php**: Faz o processamento dos dados do formulário, gera o QR Code e salva as informações no banco de dados.
- **verificar_pagamento.php**: Checa o status do pagamento e atualiza a informação no banco de dados, confirmando se o pagamento foi aprovado.
- **config/database.php**: Configura a conexão com o banco de dados MySQL.
- **views/create.php**: Formulário para adicionar novos pagamentos.
- **views/modal.php**: Modal que exibe o QR Code gerado.

### Contribuições

Se você tiver sugestões ou quiser ajudar a melhorar o projeto, fique à vontade para abrir uma issue. Toda contribuição é bem-vinda!

