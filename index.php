<!DOCTYPE html>
<?php require_once 'web.php' ;?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleanfood Regisztráció</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cleanfood Regisztráció</h1>
        <form id="registration-form" method="post" action="/register">
            <label for="name">Teljes név:</label>
            <input type="text" id="name" name="name" required placeholder="Írd be a teljes neved">

            <label for="email">E-mail cím:</label>
            <input type="email" id="email" name="email" required placeholder="Írd be az e-mail címed">

            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password" required placeholder="Írd be a jelszót">
            
            <label for="confirm-password">Jelszó megerősítés:</label>
            <input type="password" id="confirm-password" name="confirm-password" required placeholder="Megerősítés">

            <label for="phonenumber">Telefonszám:</label>
            <input type="text" id="phonenumber" name="phonenumber" required placeholder="Írd be a telefonszámod">

            <label for="zipcode">Irányítószám:</label>
            <div class="inline">
                <input type="text" id="zipcode" name="zipcode" required placeholder="Írd be az irányítószámot">
                <input type="text" id="city" name="city" required placeholder="Írd be a települést">
            </div>
            <div class="button-group">
                <button type="submit">  <a href="Login.php"></a>Regisztrálok</button>
                <button type="button"> <a href="Login.php"></a> Van már fiókom</button>
            </div>
        </form>
        <p class="message" id="error-message"></p>
    </div>
    <script src="script.js"></script>
</body>
</html>