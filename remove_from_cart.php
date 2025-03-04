<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodId = $_POST['food_id'];

    if (isset($_SESSION['cart'][$foodId])) {
        unset($_SESSION['cart'][$foodId]);
    }
}

header('Location: cart.php');
exit();
?>