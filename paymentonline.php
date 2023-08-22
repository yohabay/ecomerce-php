<?php
include 'inc/header.php';

// Define the removeProduct function in your code
function removeProduct($productId) {
 
    $sql = "DELETE FROM cart WHERE productId = $productId";
 
    $result = $conn->query($sql);
    if ($result) {
        // Product removed successfully
        echo "Product removed from the cart.";
    } else {
        // Product removal failed
        echo "Failed to remove the product from the cart.";
    }
}

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51NbIemCiAMLU2fTKefttogWxZo5TJTOs7m9JwmMUjBhwG0hT29UAXaQWv4dDKmScfKXMBokWjOxvFHTOEv2AlXYr00xLLKDavu');

// Fetch product details from the database
$getPro = $ct->getCartProduct();
if ($getPro) {
    $i = 0;
    $qty = 0;
    $lineItems = [];
    $sum = 0;

    while ($result = $getPro->fetch_assoc()) {
        $i++;

        $productId = $result['productId'];
        $productName = $result['productName'];
        $productImage = $result['image'];
        $productPrice = $result['price'];
        $detail = $result['body'];

        $productQuantity = $result['quantity'];
        $price = $result['price'];
        $total = $productPrice * $productQuantity;
        $qty = $qty + $productQuantity;
        $sum = $sum + $total;

        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $productName,
                ],
                'unit_amount' => $productPrice * 100, // Amount in cents
            ],
            'quantity' => $productQuantity,
        ];

        $productImage;
        $detail;
    }

    // Calculate VAT and grand total
    $gtotal = $sum;

    // Create a new Checkout Session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => 'http://localhost/shop%20(1)/shop/success.php',
        'cancel_url' => 'http://localhost/cancel.php',
    ]);

    // Check if payment is successful
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        // Remove the product from the cart database table
        removeProduct($productId);
    }

    // Redirect to the payment page
    header('Location: ' . $session->url);
    exit;
}

?>
