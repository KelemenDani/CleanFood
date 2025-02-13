<?php
session_start();

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['user_id'])) {
    header('Location: profil.php'); // Ha nincs bejelentkezve, irányítsuk a bejelentkezési oldalra
    exit();
}

// Adatbázis kapcsolat betöltése
require 'db_connection.php';

// Felhasználó adatainak lekérése
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, phonenumber, city, zipcode FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Felhasználó nem található.");
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .profile-info p {
            font-size: 18px;
            margin: 10px 0;
        }
        .profile-info strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Profil Adatok</h1>
        <div class="profile-info">
            <p><strong>Név:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Telefonszám:</strong> <?= htmlspecialchars($user['phonenumber']) ?></p>
            <p><strong>Település:</strong> <?= htmlspecialchars($user['city']) ?></p>
            <p><strong>Irányítószám:</strong> <?= htmlspecialchars($user['zipcode']) ?></p>
        </div>
    </div>
</body>
</html>