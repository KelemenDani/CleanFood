<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Nincs bejelentkezve']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['name'], $data['price'], $data['quantity'])) {
    $foodName = $data['name'];
    $foodPrice = $data['price'];
    $quantity = $data['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$foodName])) {
        $_SESSION['cart'][$foodName]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$foodName] = [
            'name' => $foodName,
            'price' => $foodPrice,
            'quantity' => $quantity
        ];
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Hiányzó adatok']);
}
?>