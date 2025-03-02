<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit();
}

include 'db_connection.php';

// Kosár tartalmának lekérése
$order_id = $_SESSION['order_id'] ?? null;
$foods = [];
$total = 0;

if ($order_id) {
    $query = "SELECT f.id, f.name, f.price, of.quantity 
              FROM foods f
              JOIN orderedfoods of ON f.id = of.foods_id
              WHERE of.orders_id = :order_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();
    $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Összesen kiszámítása
    foreach ($foods as $food) {
        $total += $food['price'] * $food['quantity'];
    }

    // Rendelés összegének frissítése
    $query = "UPDATE orders SET total_price = :total_price WHERE id = :order_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':total_price', $total, PDO::PARAM_STR);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();

    // Kosár ürítése
    unset($_SESSION['cart']);
    unset($_SESSION['order_id']);

    echo "Rendelés sikeresen leadva! Összesen fizetendő: " . number_format($total, 0, ',', ' ') . " Ft";
} else {
    echo "Nincs aktív rendelés.";
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fizetés</title>
    <link rel="stylesheet" href="kosar.css">
</head>
<body>
    <div class="container">
        <h1>Fizetés</h1>
        <p>Rendelés sikeresen leadva! Összesen fizetendő: <?php echo number_format($total, 0, ',', ' '); ?> Ft</p>
        <a href="main.php">Vissza a főoldalra</a>
    </div>
</body>
</html>