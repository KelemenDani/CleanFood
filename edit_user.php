<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['email'] != 'admin123@gmail.com') {
    header("Location: /login.php");
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Hiba történt a felhasználó adatainak lekérésekor: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

    try {
        $query = "UPDATE users SET name = :name, email = :email, phonenumber = :phonenumber, city = :city, zipcode = :zipcode WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (Exception $e) {
        die("Hiba történt a felhasználó adatainak módosításakor: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználó módosítása</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h1>Felhasználó módosítása</h1>
        <form method="post" action="edit_user.php">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <label for="name">Név:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <label for="phonenumber">Telefonszám:</label>
            <input type="text" id="phonenumber" name="phonenumber" value="<?php echo htmlspecialchars($user['phonenumber']); ?>" required>
            <label for="city">Város:</label>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
            <label for="zipcode">Irányítószám:</label>
            <input type="text" id="zipcode" name="zipcode" value="<?php echo htmlspecialchars($user['zipcode']); ?>" required>
            <button type="submit" class="edit">Módosítás</button>
        </form>
    </div>
</body>
</html>