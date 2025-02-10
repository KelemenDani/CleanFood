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
                <li><a href="#">Natur Ételbár</a></li>
                <li><a href="#">Áfium Gasztropince</a></li>
                <li><a href="#">Szafi Smart Shop</a></li>
                <li><a href="#">Vegan Love</a></li>
                <li><a href="#">Cleanfood Shop</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="popular-foods">
                <h2>Legnépszerűbb ételeink</h2>
                <div class="food-row">
                    <div class="food-item">
                        <img src="main.kepek/veget_whopper.png" alt="Vegetáriánus Whopper">
                        <div class="food-name">Vegetáriánus Whopper</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/sajtburger.png" alt="Gluténmentes SajtBurger">
                        <div class="food-name">Gluténmentes SajtBurger</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/gyrostek.png" alt="Görög NEM 'Pipi' Gyros Tekercs">
                        <div class="food-name">Görög NEM 'Pipi' Gyros Tekercs</div>
                    </div>
                </div>
                <div class="food-row">
                    <div class="food-item">
                        <img src="main.kepek/baswhopper.png" alt="Plant-Based Whopper">
                        <div class="food-name">Plant-Based Whopper</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/mcfarm.png" alt="Gluténmentes Sertés McFarm">
                        <div class="food-name">Gluténmentes Sertés McFarm</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/gorogtal.png" alt="TÁL Görög NEM 'Pipi' Gyros">
                        <div class="food-name">TÁL Görög NEM 'Pipi' Gyros</div>
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