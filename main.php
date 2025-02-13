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
    <title>Cleanfood Főoldal</title>
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
            <a href="Login.php">Bejelentkezés</a>
            <a href="index.php">Regisztráció</a>
        </nav>
    </header>
    <main>
        <div class="sidebar">
            <h2>Éttermeink</h2>
            <ul>
                <li><a href="#">Burger King</a></li>
                <li><a href="#">LYR Speciality Coffee and Food</a></li>
                <li><a href="#">McDonald's</a></li>
                <li><a href="#">Mandala Étterem</a></li>
                <li><a href="#">UMAMI</a></li>
                <li><a href="#">Szafi Pékség</a></li>
                <li><a href="#">Cleanfood Shop</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="popular-foods">
                <h2>Legnépszerűbb Éttermeink</h2>
                <div class="food-row">
                    <div class="food-item">
                        <img src="main.kepek/veget_whopper.png" alt="CleanFood Shop">
                        <div class="food-name">Cleanfood Shop</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/sajtburger.png" alt="Burger king">
                        <div class="food-name">Burger King</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/gyrostek.png" alt="Mandala Éterrem">
                        <div class="food-name">Mandala Éterrem</div>
                    </div>
                </div>
                <div class="food-row">
                    <div class="food-item">
                        <img src="main.kepek/baswhopper.png" alt="Lyr Étterem">
                        <div class="food-name">Lyr Étterem</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/mcfarm.png" alt="Starbucks">
                        <div class="food-name">Starbucks </div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/gorogtal.png" alt="TÁL Görög NEM 'Pipi' Gyros">
                        <div class="food-name">Szafi Pékség</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <span><?php echo date('Y-m-d '); ?></span>
        <a href="#">Kuponok</a>
        <a href="#">Profil</a>
    </footer>
    
</body>
</html>