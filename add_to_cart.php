<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$foodId = $data['foodId'];
$quantity = $data['quantity'];

include 'db_connection.php';

$query = "SELECT name, price FROM foods WHERE id = :foodId";
$stmt = $conn->prepare($query);
$stmt->bindParam(':foodId', $foodId, PDO::PARAM_INT);
$stmt->execute();
$food = $stmt->fetch(PDO::FETCH_ASSOC);

if ($food) {
    $foodName = $food['name'];
    $foodPrice = $food['price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$foodId])) {
        $_SESSION['cart'][$foodId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$foodId] = [
            'name' => $foodName,
            'price' => $foodPrice,
            'quantity' => $quantity
        ];
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Étel nem található.']);
}
?>