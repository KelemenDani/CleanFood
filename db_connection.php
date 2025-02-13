<?php
$host = 'localhost'; // Adatbázis szerver
$dbname = 'cleanfood'; // Adatbázis neve
$username = 'your_username'; // Adatbázis felhasználónév
$password = 'your_password'; // Adatbázis jelszó

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Adatbázis kapcsolódási hiba: " . $e->getMessage());
}
?>