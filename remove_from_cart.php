<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Nincs bejelentkezve']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $foodId = $data['id'];

    if (isset($_SESSION['cart'][$foodId])) {
        unset($_SESSION['cart'][$foodId]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Termék nem található a kosárban']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Hiányzó adatok']);
}
?>