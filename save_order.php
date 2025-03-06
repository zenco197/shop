<?php
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $orderText = "Order Details:\n";
    $orderText .= "Name: " . $data['name'] . "\n";
    $orderText .= "Email: " . $data['email'] . "\n";
    $orderText .= "Address: " . $data['address'] . "\n";
    $orderText .= "Payment Method: " . $data['payment'] . "\n";
    $orderText .= "Items:\n";

    foreach ($data['cart'] as $item) {
        $orderText .= "- " . $item['name'] . " (" . $item['quantity'] . "x) - ₱" . number_format($item['price'] * $item['quantity'], 2) . "\n";
    }

    $orderText .= "Total: ₱" . array_reduce($data['cart'], function($sum, $item) {
        return $sum + ($item['price'] * $item['quantity']);
    }, 0) . "\n";
    $orderText .= "-------------------------\n";

    file_put_contents("orders.txt", $orderText, FILE_APPEND);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>