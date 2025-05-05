<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .ticket {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #000;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
            <h1>Ticket de Paiement</h1>
            <p>Confirmation d'achat</p>
        </div>

        <div class="details">
            <div class="details-row">
                <span class="label">Numéro de Transaction:</span>
                <span>{{ $payment->id }}</span>
            </div>
            <div class="details-row">
                <span class="label">Date:</span>
                <span>{{ $payment->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="details-row">
                <span class="label">Produit:</span>
                <span>{{ $product->title }}</span>
            </div>
            <div class="details-row">
                <span class="label">Prix:</span>
                <span>{{ number_format($payment->amount, 2) }} €</span>
            </div>
            <div class="details-row">
                <span class="label">Acheteur:</span>
                <span>{{ $payment->user->name }}</span>
            </div>
            <div class="details-row">
                <span class="label">Vendeur:</span>
                <span>{{ $product->user->name }}</span>
            </div>
        </div>

        <div class="footer">
            <p>Ce ticket est une preuve de votre achat. Veuillez le conserver précieusement.</p>
            <p>Pour toute question, veuillez contacter notre service client.</p>
        </div>
    </div>
</body>
</html>
