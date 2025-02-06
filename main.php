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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Üdvözöljük a Cleanfood Főoldalon!</h1>
        <p>Üdvözöljük, <?php echo $_SESSION['user']['name']; ?>!</p>
        <a href="logout.php">Kijelentkezés</a>
    </div>
</body>
</html>