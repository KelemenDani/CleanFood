<?php
session_start();

$products = [
    1 => ['id' => 1, 'name' => 'teszt', 'price' => 2990],
    2 => ['id' => 2, 'name' => 'teszt', 'price' => 3990],
    3 => ['id' => 3, 'name' => 'teszt', 'price' => 4490],
];

$_SESSION['cart'] = $_SESSION['cart'] ?? [];    


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    $productId = (int)$_GET['id'];
    if (isset($products[$productId])) {
        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + 1;
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $productId = (int)$_GET['id'];
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>CleanFood</title>
<link rel="stylesheet" href="kosar.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛒 CleanFood - Kosár</h1>
            <p>Egészséges életmód a mindennapokra</p>
            <a href="main.php" class="btn" style="background-color: #4CAF50; color: white;">Vissza a főoldalra</a>
        </div>

        <div class="products">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <!-- <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image"> -->
                <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>
                <p class="product-price"><?= number_format($product['price'], 0, ',', ' ') ?> Ft</p>
                <a href="?action=add&id=<?= $product['id'] ?>" class="btn">Kosárba</a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="cart">
            <h2>🛍️ A kosaram</h2>
            <?php if (!empty($_SESSION['cart'])): ?>
                <table class="cart-table">
                    <tr>
                        <th>Termék</th>
                        <th>Ár</th>
                        <th>Mennyiség</th>
                        <th>Összesen</th>
                        <th></th>
                    </tr>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $productId => $quantity): 
                        $product = $products[$productId];
                        $subtotal = $product['price'] * $quantity;
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= number_format($product['price'], 0, ',', ' ') ?> Ft</td>
                        <td><?= $quantity ?></td>
                        <td><?= number_format($subtotal, 0, ',', ' ') ?> Ft</td>
                        <td><a href="?action=remove&id=<?= $productId ?>">❌</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <div class="total">Végösszeg: <?= number_format($total, 0, ',', ' ') ?> Ft</div>
            <?php else: ?>
                <p>A kosara üres.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>