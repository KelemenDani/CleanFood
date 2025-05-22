<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandala Étterem</title>
    <link rel="stylesheet" href="ettermek.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">Cleanfood</div>
        <div class="tagline">HEATHEN-FREE</div>
        <nav>
            <a href="main.php">Vissza a főoldalra</a>
            <a href="cart.php">Kosár</a>
        </nav>
    </header>
    <main>
        <div class="main-content">
            <h2>Mandala Étterem ételei</h2>
            <div class="food-list"></div>
        </div>
    </main>
    <script src="mandala.js"></script>
</body>
</html>