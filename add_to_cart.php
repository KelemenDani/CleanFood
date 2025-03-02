<?php
session_start();
header('Content-Type: application/json');

include 'db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);
$foodId = $data['foodId'];
$quantity = $data['quantity'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$foodId])) {
    $_SESSION['cart'][$foodId] += $quantity;
} else {
    $_SESSION['cart'][$foodId] = $quantity;
}

// Mentés az adatbázisba
try {
    $conn->beginTransaction();

    // Rendelés létrehozása, ha még nincs
    if (!isset($_SESSION['order_id'])) {
        $query = "INSERT INTO orders (user_id, total_price) VALUES (:user_id, 0)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['order_id'] = $conn->lastInsertId();
    }

    // Étel hozzáadása a rendeléshez
    $query = "INSERT INTO orderedfoods (orders_id, foods_id, quantity) VALUES (:orders_id, :foods_id, :quantity)
              ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':orders_id', $_SESSION['order_id'], PDO::PARAM_INT);
    $stmt->bindParam(':foods_id', $foodId, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->execute();

    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>