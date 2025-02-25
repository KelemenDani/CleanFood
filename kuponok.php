<?php
session_start();
require 'db.php'; // Adatbázis kapcsolat

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Kuponok lekérése az adatbázisból
$coupons = [];
$query = "SELECT * FROM coupons";
$result = $conn->query($query);
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $coupons[] = $row;
    }
}

// Felhasznált kuponok lekérése az adatbázisból
$used_coupons = [];
$query = "SELECT coupon_id FROM used_coupons WHERE user_id = $user_id";
$result = $conn->query($query);
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $used_coupons[] = $row['coupon_id'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kuponok</title>
</head>
<body>
    <h1>Elérhető kuponok</h1>
    <?php foreach($coupons as $coupon): ?>
        <div style="margin: 20px; padding: 10px; border: 1px solid #ccc;">
            <h3><?= $coupon['code'] ?></h3>
            <p>Érték: <?= $coupon['amount'] ?> Ft</p>
            <?php if (!in_array($coupon['id'], $used_coupons)): ?>
                <form method="POST" action="use_kupon.php">
                    <input type="hidden" name="coupon_id" value="<?= $coupon['id'] ?>">
                    <button type="submit">Kupon felhasználása</button>
                </form>
            <?php else: ?>
                <p style="color: red;">Már felhasználtad ezt a kupont!</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>