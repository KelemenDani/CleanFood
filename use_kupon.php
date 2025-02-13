<?php
session_start();
$code = $_POST['code'] ?? '';
$couponsFile = 'coupons.json';

$coupons = json_decode(file_get_contents($couponsFile), true);

foreach($coupons as &$coupon){
    if($coupon['code'] === $code && !$coupon['used']){
        $coupon['used'] = true;
        break;
    }
}

file_put_contents($couponsFile, json_encode($coupons));
header('Location: kuponok.php');
exit;
?>