<?php ob_start(); ?>
<!DOCTYPE html>
<?php require_once 'web.php'; ?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termékek</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Termékek</h1>
        <?php
        // Példa termékek megjelenítése
        $products = [
            ['id' => 1, 'name' => 'Banán', 'price' => 200],
            // ...további termékek...
        ];

        foreach ($products as $product) {
            echo '<div class="product">';
            echo '<h2>' . $product['name'] . '</h2>';
            echo '<p>Ár: ' . $product['price'] . ' Ft</p>';
            echo '<button class="add-to-cart" data-product-id="' . $product['id'] . '">Kosárba</button>';
            echo '</div>';
        }
        ?>
    </div>
    <script src="script.js"></script>
    <script src="/C:/MAMP/htdocs/CleanFood/js/cart.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>
