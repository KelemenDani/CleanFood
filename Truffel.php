<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit();
}

include 'db_connection.php';

try {
    $query = "SELECT id, name, price FROM foods WHERE restaurants_id = 14";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Hiba történt az ételek lekérésekor: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trüffel Cukrászda</title>
    <link rel="stylesheet" href="ettermek.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">Cleanfood</div>
        <div class="tagline">HEATHEN-FREE</div>
        <div class="search-bar">
            <input type="text" placeholder="Keresés...">
        </div>
        <nav>
            <a href="main.php">Vissza a főoldalra</a>
            <a href="cart.php">Kosár</a>
        </nav>
    </header>
    <main>
        <div class="main-content">
            <h2>Trüffel Cukrászda ételei</h2>
            <div class="food-list">
                <?php foreach ($foods as $food): ?>
                    <div class="food-item">
                        <h3><?php echo htmlspecialchars($food['name']); ?></h3>
                        <p>Ár: <?php echo htmlspecialchars($food['price']); ?> Ft</p>
                        <form action="add_to_cart.php" method="post">
                            <input type="hidden" name="food_id" value="<?php echo htmlspecialchars($food['id']); ?>">
                            <label for="quantity">Mennyiség:</label>
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit">Kosárba</button>
                        </form>
                        <form action="remove_from_cart.php" method="post">
                            <input type="hidden" name="food_id" value="<?php echo htmlspecialchars($food['id']); ?>">
                            <button type="submit">Eltávolítás</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <script src="truffel.js"></script>
</body>
</html>