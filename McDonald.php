<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit();
}

include 'db_connection.php';

try {
    $query = "SELECT name, price FROM foods WHERE restaurants_id = (SELECT id FROM restaurants WHERE name = 'Burger King')";
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
    <title>McDonald's</title>
    <link rel="stylesheet" href="main.css">
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
            <h2>McDonald's ételei</h2>
            <div class="food-list">
                <?php foreach ($foods as $food): ?>
                    <div class="food-item">
                        <h3><?php echo htmlspecialchars($food['name']); ?></h3>
                        <p>Ár: <?php echo htmlspecialchars($food['price']); ?> Ft</p>
                        <button class="add-to-cart" data-food="<?php echo htmlspecialchars($food['name']); ?>" data-price="<?php echo htmlspecialchars($food['price']); ?>">Kosárba</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.add-to-cart');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const food = this.getAttribute('data-food');
                    const price = this.getAttribute('data-price');
                    alert(`Hozzáadva a kosárhoz: ${food} - ${price} Ft`);
                });
            });
        });
    </script>
</body>
</html>