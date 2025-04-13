<!DOCTYPE html>
<html>
<head>
    <title>Congratulations!</title>
</head>
<body>
    <h1>Congratulations, {{ $product->winner->name }}!</h1>
    <p>You have won the auction for the product: {{ $product->name }}.</p>
    <p>Please proceed to payment to finalize your purchase.</p>
    <a href="{{ url('/payment/'.$product->id) }}">Pay Now</a>
</body>
</html>
