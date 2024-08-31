<?php
include("../Components/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartData = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SESSION['username'])) {
        http_response_code(403);
        echo json_encode(['message' => 'User not logged in']);
        exit();
    }

    $username = $_SESSION['username'];
    $email = $_SESSION['email']; // Make sure to set email in the session on login
    $totalAmount = 0;

    foreach ($cartData as $item) {
        $totalAmount += $item['price'] * $item['qty'];
    }

    $orderQuery = "INSERT INTO orders (username, email, total) VALUES (?, ?, ?)";
    $stmt = $con->prepare($orderQuery);
    $stmt->bind_param('ssd', $username, $email, $totalAmount);
    $stmt->execute();
    $orderId = $stmt->insert_id;

    foreach ($cartData as $item) {
        $itemTitle = $item['title'];
        $itemPrice = $item['price'];
        $itemQty = $item['qty'];

        $orderDetailQuery = "INSERT INTO order_details (order_id, item_title, item_price, item_qty) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($orderDetailQuery);
        $stmt->bind_param('isdi', $orderId, $itemTitle, $itemPrice, $itemQty);
        $stmt->execute();
    }

    echo json_encode(['message' => 'Order placed successfully']);
} else {
    http_response_code(405);
}
?>
