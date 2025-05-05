<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .ticket {
            border: 2px solid #000;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
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
            color: #333;
        }
        .value {
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            font-size: 12px;
            color: #666;
        }
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .signature {
            margin-top: 40px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
            <h1>Ticket de Paiement</h1>
            <p>Nostalgia - Enchères en ligne</p>
        </div>

        <div class="details">
            <div class="details-row">
                <span class="label">Numéro de Transaction:</span>
                <span class="value">{{ $payment->paypal_transaction_id }}</span>
            </div>
            <div class="details-row">
                <span class="label">Date:</span>
                <span class="value">{{ $payment->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="details-row">
                <span class="label">Statut:</span>
                <span class="value">{{ ucfirst($payment->status) }}</span>
            </div>
        </div>

        <div class="details">
            <h3>Détails du Produit</h3>
            <div class="details-row">
                <span class="label">Titre:</span>
                <span class="value">{{ $product->title }}</span>
            </div>
            <div class="details-row">
                <span class="label">Catégorie:</span>
                <span class="value">{{ $product->category->name }}</span>
            </div>
            <div class="details-row">
                <span class="label">Prix Final:</span>
                <span class="value">{{ number_format($payment->amount, 2) }} €</span>
            </div>
        </div>

        <div class="details">
            <h3>Informations Acheteur</h3>
            <div class="details-row">
                <span class="label">Nom:</span>
                <span class="value">{{ $payment->user->name }} {{ $payment->user->first_name }}</span>
            </div>
            <div class="details-row">
                <span class="label">Email:</span>
                <span class="value">{{ $payment->user->email }}</span>
            </div>
        </div>

        <div class="details">
            <h3>Informations Vendeur</h3>
            <div class="details-row">
                <span class="label">Nom:</span>
                <span class="value">{{ $product->user->name }} {{ $product->user->first_name }}</span>
            </div>
            <div class="details-row">
                <span class="label">Email:</span>
                <span class="value">{{ $product->user->email }}</span>
            </div>
        </div>

        <div class="qr-code">
            <!-- You can add a QR code here if needed -->
        </div>

        <div class="signature">
            <p>Signature électronique:</p>
            <p>{{ $payment->paypal_transaction_id }}</p>
        </div>

        <div class="footer">
            <p>Ce ticket est une preuve de transaction valide.</p>
            <p>Nostalgia - Enchères en ligne</p>
            <p>Date d'émission: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
