<?php
session_start();
include("../Components/db.php");

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $rawData = file_get_contents('php://input');
    $orderData = json_decode($rawData, true);

    // Check if order data is received
    if (isset($orderData['order'])) {
        $orderItems = $orderData['order'];
        $userEmail = $_SESSION['user_email']; // Assuming you have the user email stored in session

        // Insert into the orders table
        $totalAmount = 0;
        $orderQuery = "INSERT INTO orders (user_email, total_amount) VALUES ('$userEmail', 0)";
        if (mysqli_query($con, $orderQuery)) {
            $orderId = mysqli_insert_id($con);

            // Insert each item into order_items table
            foreach ($orderItems as $item) {
                $itemTitle = mysqli_real_escape_string($con, $item['title']);
                $itemPrice = $item['price'];
                $quantity = $item['quantity'];
                $totalAmount += ($itemPrice * $quantity);

                $orderItemQuery = "INSERT INTO order_items (order_id, item_title, item_price, quantity) VALUES ('$orderId', '$itemTitle', '$itemPrice', '$quantity')";
                mysqli_query($con, $orderItemQuery);
            }

            // Update the total amount for the order
            $updateOrderQuery = "UPDATE orders SET total_amount = '$totalAmount' WHERE order_id = '$orderId'";
            mysqli_query($con, $updateOrderQuery);

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Order could not be placed.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid order data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
