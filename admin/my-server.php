<?php require './../vendor/autoload.php';
require '.classess/Product.php';?>
<?php
// Assuming $itemList is an array of items with their respective quantities
$lineItems = [];
$total = 0;

foreach ($itemList as $item) {
    $id = $conn->real_escape_string($item->id);
    $quantity = $conn->real_escape_string($item->quantity);

    $result = $conn->query('select price from products where id =' . $id . ';');
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        $total += $row['price'] * intval($quantity);

        // Add each product with its respective quantity to the line items array
        $lineItems[] = [
            'quantity' => intval($quantity),
            'price_data' => [
                'currency' => 'usd',
                'unit_amount' => $row['price'],
                'product_data' => [
                    'name' => 'Grocery Store',
                    'description' => 'Your Invoice for Grocery today.'
                ]
            ]
        ];
    } else {
        echo json_encode(['status'=>'no such product found']);
        exit();
    }
}

// Create the checkout session with the updated line items
$paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => $gtotal * 100, // Amount in cents
    'currency' => 'usd',
    'payment_method_types' => ['card'],
]);

echo json_encode(['id' => $session->id]);

?>