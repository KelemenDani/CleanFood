<?php
session_start();

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodId = $_POST['food_id'];
    $order_id = $_SESSION['order_id'] ?? null;

    if ($order_id) {
        $query = "DELETE FROM orderedfoods WHERE orders_id = :order_id AND foods_id = :food_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':food_id', $foodId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

header('Location: cart.php');
exit();
?>