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
    <!-- FontAwesome ikonok betöltése -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">Cleanfood</div>
        <div class="tagline">HEATHEN-FREE</div>
        <div class="search-bar">
            <input type="text" placeholder="Keresés...">
        </div>
        <nav>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="login.php">Bejelentkezés</a>
                <a href="index.php">Regisztráció</a>
            <?php endif; ?>
            <div class="header-buttons">
                <a href="cart.php" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a href="profil.php" class="profile-button">
                    <i class="fas fa-user"></i> Adatok
                </a>
            </div>
        </nav>
    </header>
    <main>
        <div class="sidebar">
        <footer class="footer">
        <span id="currentTime"></span>
    </footer>
            <h2>Éttermeink</h2>
            <ul>
                <li><a href="burgerking.php">Burger King</a></li>
                <li><a href="LYR.php">LYR Speciality Coffee and Food</a></li>
                <li><a href="McDonald.php">McDonald's</a></li>
                <li><a href="Mandala.php">Mandala Étterem</a></li>
                <li><a href="Unami.php">UMAMI</a></li>
                <li><a href="Szafi.php">Szafi Pékség</a></li>
                <li><a href="Shop.php">Cleanfood Shop</a></li>
                <li><a href="Starbucks.php">Starbucks</a></li>
                <li><a href="Vagamary.php">Vagamary Cukrászda</a></li>
                <li><a href="Truffel.php">Trüffel</a></li>
                <li><a href="Magda.php">Magda Cukrászda</a></li>
                <li><a href="Buddha.php">Buddha Original</a></li>
                <li><a href="Megyeri.php">Megyeri Burgerező</a></li>
                <li><a href="Pekinak.php">Pékinas</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="popular-foods">
                <h2>Legnépszerűbb Éttermeink</h2>
                <div class="food-row">
                    <div class="food-item">
                        <a href="Shop.php">
                            <img src="main.kepek/market_logo.webp" alt="CleanFood Shop">
                        </a>
                        <div class="food-name"><a href="Shop.php">CleanFood Shop</a></div>
                    </div>
                    <div class="food-item">
                        <a href="burgerking.php">
                            <img src="main.kepek/burgerking.png" alt="Burger King">
                        </a>
                        <div class="food-name"><a href="burgerking.php">Burger King</a></div>
                    </div>
                    <div class="food-item">
                        <a href="Mandala.php">
                        <img src="main.kepek/mandala.png" alt="Mandala Étterem">
                        </a>
                        <div class="food-name"><a href="Mandala.php">Mandala Étterem</a></div>
                    </div>
                </div>
                <div class="food-row">
                    <div class="food-item">
                        <a href="LYR.php">
                        <img src="main.kepek/lyr.png" alt="Lyr">
                        </a>
                        <div class="food-name"><a href="LYR.php">LYR Étterem</a></div>
                    </div>
                    <div class="food-item">
                        <a href="Starbucks.php">
                        <img src="main.kepek/starbucks.png" alt="Starbucks">
                        </a>
                        <div class="food-name"><a href="Starbucks.php">Starbucks</a></div>
                    </div>
                    <div class="food-item">
                        <a href="Szafi.php">
                        <img src="main.kepek/szafi.png" alt="Szafi Pékség">
                        </a>
                        <div class="food-name"> <a href="Szafi.php">Szafi pékség</a></div>
                    </div>
                </div>
            </div>
            <div class="recipe-gallery">
                <h2>Otthoni étel ajánló</h2>
                <div class="recipe-row">
                    <div class="recipe-item">
                        <img src="palacsinta.png" alt="banán_palacsinta">
                        <div class="recipe-info">1 érett banán, 2 tojás, pici fahéj (opcionális) Elkészítés: A banánt villával összetöröd, hozzáadod a tojásokat, jól összekevered, majd forró serpenyőben kis lepényeket sütsz belőle.</div>
                    </div>
                    <div class="recipe-item">
                        <img src="avokados.png" alt="Avokádós tojáskrém">
                        <div class="recipe-info">Hozzávalók: avokádó, tojás, só, bors. Elkészítés: Az avokádót és a tojásokat villával összetöröd, ízesíted sóval, borssal, pár csepp citromlével. Kenyér nélkül, zöldséghasábokkal is szuper!</div>
                    </div>
                    <div class="recipe-item">
                        <img src="zöldség_tal.png" alt="Sült zöldségtál ">
                        <div class="recipe-info">1 cukkini, 1 répa, 1 paprika ,Olívaolaj, só, bors. Elkészítés: A zöldségeket felvágod, meglocsolod olívaolajjal, sózod, borsozod, és sütőben 200 fokon kb. 20 perc alatt megsütöd.</div>
                    </div>
                </div>
                <div class="recipe-note">
                    <em>Ezekhez a hozzávalókat mind beszerezheted a CleanFood Shopba</em>
                </div>
            </div>
            <div class="why-order">
                <h2>Miért éri meg tőlünk rendelni?</h2>
                <ul>
                    <li>✔️ Friss és egészséges alapanyagok</li>
                    <li>✔️ Gyors és megbízható kiszállítás</li>
                    <li>✔️ Kedvező árak és akciók</li>
                    <li>✔️ Több, partnert is meg találsz nálunk, köztük egészen különleges, távoli konyhákat is</li>
                    <li>✔️ Legyen szó reggeli kávéról, hétköznapi ebédről a kollégáiddal, egy gyors bevásárlásról, egy romantikus vacsoráról, vagy akár titkos éjjeli snackről: a cleanfoodrol minden alkalomra rendelhetsz</li>
                    <li>✔️ A rendelési folyamatunk egyszerű és gyors: teszteld, és rendelj weben</li>
                    <li>✔️ Válaszd a maximális biztonságot: cleanfood szállítás érintkezésmentes kiszállítás, online előre fizetéssel</li>
                    <li>✔️ Széles választék kedvező áron a menüajánlatoktól kezdve egészen a prémium ételekig</li>
                </ul>
            </div>
        </div>
    </main>
    <script src="main.js"></script>
</body>
</html>