<?php
session_start();
?>
<!DOCTYPE html>
<?php require_once 'web.php'; ?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleanfood Bejelentkezés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cleanfood Bejelentkezés</h1>
        <?php if (isset($_SESSION['login_error_message'])): ?>
            <script>
                alert("<?php echo $_SESSION['login_error_message']; unset($_SESSION['login_error_message']); ?>");
            </script>
        <?php endif; ?>
        <form id="login-form" method="post" action="/login">
            <label for="email">E-mail cím:</label>
            <input type="email" id="email" name="email" required placeholder="Írd be az e-mail címed">

            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password" required placeholder="Írd be a jelszót">

            <div class="button-group">
                <button type="submit">Bejelentkezés</button>
                <button type="button"> <a href="index.php">Regisztráció</a> </button>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>