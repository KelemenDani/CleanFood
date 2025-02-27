<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit();
}

// Adatbázis kapcsolat
include 'db_connection.php';

// Burger King éttermek lekérése
try {
    $query = "SELECT address FROM restaurants WHERE name = 'Burger King'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Hiba történt az éttermek lekérésekor: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger King</title>
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
        </nav>
    </header>
    <main>
        <div class="main-content">
            <h2>Burger King</h2>
            <label for="restaurant-select">Válassz melyikből szeretnéd:</label>
            <select id="restaurant-select">
                <option value="">Válassz...</option>
                <?php foreach ($restaurants as $restaurant): ?>
                    <option value="<?php echo htmlspecialchars($restaurant['address']); ?>"><?php echo htmlspecialchars($restaurant['address']); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="food-list"></div>
        </div>
    </main>
    <script src="burgerking.js"></script>
</body>
</html>