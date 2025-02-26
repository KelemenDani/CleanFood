<?php
session_start();
require 'db.php'; // Adatbázis kapcsolat

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['coupon_id'])) {
    $coupon_id = $_POST['coupon_id'];

    // Ellenőrizzük, hogy a felhasználó már felhasználta-e ezt a kupont
    $query = "SELECT * FROM used_coupons WHERE user_id = $user_id AND coupon_id = $coupon_id";
    $result = $conn->query($query);

    if ($result->rowCount() === 0) {
        // Ha még nem használta fel, akkor hozzáadjuk az adatbázishoz
        $query = "INSERT INTO used_coupons (user_id, coupon_id) VALUES ($user_id, $coupon_id)";
        $conn->query($query);
    }

    // Visszairányítjuk a felhasználót a kuponok oldalra
    header('Location: kuponok.php');
    exit;
}