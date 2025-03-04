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
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>CleanFood</title>
  <link rel="stylesheet" href="check.css">
</head>
<body>
  <div class="container">
    <h1>CleanFood</h1>
    <div class="cart">
    </div>
    <div class="payment-form">
      <h2>Bankkártya megadása</h2>
      <form>
        <label for="card-number">Bankkártya szám:</label>
        <input type="text" id="card-number" name="card-number" required>
        <label for="card-name">Név:</label>
        <input type="text" id="card-name" name="card-name">
        <label for="cvc">CVC kód:</label>
        <input type="password" id="cvc" name="cvc" pattern="[0-9]{3}" required>
        <label for="expiration-date">Lejárati dátum:</label>
        <input type="text" id="expiration-date" name="expiration-date" pattern="[0-9]{2}/[0-9]{2}" required>
        <label for="shipping-address">Szállítási cím:</label>
        <input type="text" id="shipping-address" name="shipping-address" required>
        <label for="delivery-instructions">Szállítási utasítások:</label>
        <input type="text" id="delivery-instructions" name="delivery-instructions">
        <button type="submit">Fizetés</button>
        <br><p></p>
        <a href="main.php" class="back-link">Vissza a főoldalra</a>
        <p id="payment-status"></p>
      </form>
    </div>
    <script src="checkout.js"></script>
  </div>
</body>
</html>