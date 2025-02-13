<?php
session_start();
$couponsFile = 'coupons.json';

// Kuponok betöltése fájlból
$coupons = file_exists($couponsFile) 
    ? json_decode(file_get_contents($couponsFile), true) 
    : [];

if(empty($coupons)){
    $coupons = [
        [
            'code' => 'SUMMER',
            'amount' => 3000,
            'used' => false
        ],
        [
            'code' => 'WINTER',
            'amount' => 4000,
            'used' => false
        ],
        [
            'code' => 'AUTUMN',
            'amount' => 5000,
            'used' => false
        ]
    ];
    file_put_contents($couponsFile, json_encode($coupons));
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
            <?php if(!$coupon['used']): ?>
                <form method="POST" action="use_kupon.php">
                    <input type="hidden" name="code" value="<?= $coupon['code'] ?>">
                    <button type="submit">Kupon felhasználása</button>
                </form>
            <?php else: ?>
                <p style="color: red;">Már felhasználtad ezt a kupont!</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>