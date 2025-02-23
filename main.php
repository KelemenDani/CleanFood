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
                <li><a href="#">Starbucks</a></li>
                <li><a href="#">Vagamary Cukrászda</a></li>
                <li><a href="#">Trüffel</a></li>
                <li><a href="#">Magda Cukrászda</a></li>
                <li><a href="#">Buddha Original</a></li>
                <li><a href="#">Megyeri Burgerező</a></li>
                <li><a href="#">Pékinas</a></li>
                <li><a href="#">Tesco</a></li>
                
            </ul>
        </div>
        <div class="main-content">
            
            <div class="popular-foods">
                <h2>Legnépszerűbb Éttermeink</h2>

                <div class="food-row">
                    <div class="food-item">
                        <img src="main.kepek/market_logo.webp" alt="CleanFood Shop">
                        <div class="food-name">CleanFood Shop</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/burgerking.png" alt="Burger King">
                        <div class="food-name">Burger King</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/mandala.png" alt="Mandala Étterem">
                        <div class="food-name">Mandala Étterem</div>
                    </div>
                </div>

                <div class="food-row">
                    <div class="food-item">
                        <img src="main.kepek/lyr.png" alt="Lyr">
                        <div class="food-name">Lyr</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/starbucks.png" alt="Starbucks">
                        <div class="food-name">Starbucks</div>
                    </div>
                    <div class="food-item">
                        <img src="main.kepek/szafi.png" alt="Szafi Pékség">
                        <div class="food-name">Szafi Pékség</div>
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

            <!-- Új div a szöveghez -->
            <div class="why-order">
                <h2>Miért éri meg tőlünk rendelni?</h2>
                <ul>
                    <li>✔️ Friss és egészséges alapanyagok</li>
                    <li>✔️ Gyors és megbízható kiszállítás</li>
                    <li>✔️ Kedvező árak és akciók</li>
                    <li>✔️ Több,  partnert is meg találsz nálunk , köztük egészen különleges, távoli konyhákat is</li>
                    <li>✔️Legyen szó reggeli kávéról, hétköznapi ebédről a kollégáiddal, egy gyors bevásárlásról, egy romantikus vacsoráról, vagy akár titkos éjjeli snackről: a cleanfoodrol minden alkalomra rendelhetsz</li>
                    <li>✔️ A rendelési folyamatunk egyszerű és gyors: teszteld, és rendelj weben</li>
                    <li>✔️ Válaszd a maximális biztonságot: cleanfood szállítás érintkezésmentes kiszállítás, online előre fizetésse</li>
                    <li>✔️ Széles választék kedvező áron a menüajánlatoktól kezdve egészen a prémium ételekig</li>
                </ul>
            </div>
        </div>
    </main>
    <footer class="footer">
        <span><?php echo date('Y-m-d '); ?></span>
        
        <a href="kuponok.php">
        <button class="coupon-button">Kuponok</button>
        </a>
        <a href="profil.php">
        <button class="profile-button">Adatok</button>
        </a>
    </footer>
    
</body>
</html>