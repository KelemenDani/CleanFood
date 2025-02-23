<?php
$host = 'localhost'; // Adatbázis szerver
$dbname = 'cleanfood'; // Adatbázis neve
$username = 'root'; // Adatbázis felhasználónév
$password = 'root'; // Adatbázis jelszó

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Adatbázis kapcsolódási hiba: " . $e->getMessage());
}
?>