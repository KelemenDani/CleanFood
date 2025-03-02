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
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosár</title>
    <link rel="stylesheet" href="kosar.css">
</head>
<body>
    <div class="container">
        <h1>Kosár</h1>
        <?php if (!empty($foods)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Étel</th>
                        <th>Ár</th>
                        <th>Mennyiség</th>
                        <th>Összesen</th>
                        <th>Művelet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($foods as $food): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($food['name']); ?></td>
                            <td><?php echo number_format($food['price'], 0, ',', ' '); ?> Ft</td>
                            <td><?php echo $food['quantity']; ?></td>
                            <td><?php echo number_format($food['price'] * $food['quantity'], 0, ',', ' '); ?> Ft</td>
                            <td>
                                <form action="remove_from_cart.php" method="post">
                                    <input type="hidden" name="food_id" value="<?php echo $food['id']; ?>">
                                    <button type="submit">Eltávolítás</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Összesen: <?php echo number_format($total, 0, ',', ' '); ?> Ft</p>
            <form action="checkout.php" method="post">
                <button type="submit">Fizetés</button>
            </form>
        <?php else: ?>
            <p>A kosár üres.</p>
        <?php endif; ?>
        <a href="main.php">Vissza a főoldalra</a>
    </div>
</body>
</html>