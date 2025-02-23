<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit();
}

// Adatbázis kapcsolat
include 'db_connection.php';

// Hibakeresési információk
$user = $_SESSION['user'];
$user_id = $user['id'];
if (!$user_id) {
    die("Hiba: A felhasználó azonosítója nincs beállítva a session-ben.");
}

// Felhasználói adatok lekérése
try {
    $query = "SELECT name, email, city, phonenumber, zipcode FROM users WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception("Felhasználó nem található az adatbázisban a megadott azonosítóval: " . $user_id);
    }
} catch (Exception $e) {
    die("Hiba történt a felhasználói adatok lekérésekor: " . $e->getMessage());
}

// Adatok frissítése
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    updateUser($conn, $user_id);
}

// Felhasználó törlése
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    deleteUser($conn, $user_id);
}

function updateUser($conn, $user_id) {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $phonenumber = $_POST['phonenumber'];
        $zipcode = $_POST['zipcode'];

        $update_query = "UPDATE users SET name = :name, email = :email, city = :city, phonenumber = :phonenumber, zipcode = :zipcode WHERE id = :id";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $update_stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $update_stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $update_stmt->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
        $update_stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
        $update_stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $update_stmt->execute();

        header("Location: profil.php");
        exit();
    } catch (Exception $e) {
        die("Hiba történt az adatok frissítésekor: " . $e->getMessage());
    }
}

function deleteUser($conn, $user_id) {
    try {
        $delete_query = "DELETE FROM users WHERE id = :id";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $delete_stmt->execute();

        session_destroy();
        header("Location: /index.php");
        exit();
    } catch (Exception $e) {
        die("Hiba történt a felhasználó törlésekor: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adataink</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>
    <div class="profile-container">
        <h1>Profil</h1>
        <form action="profil.php" method="post">
            <label for="name">Név:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <label for="city">Város:</label>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
            
            <label for="phonenumber">Telefonszám:</label>
            <input type="text" id="phonenumber" name="phonenumber" value="<?php echo htmlspecialchars($user['phonenumber']); ?>" required>
            
            <label for="zipcode">Irányítószám:</label>
            <input type="text" id="zipcode" name="zipcode" value="<?php echo htmlspecialchars($user['zipcode']); ?>" required>
            
            <div class="button-container">
                <button type="submit" name="update" class="update-button">Adatok frissítése</button>
                <button type="submit" name="delete" class="delete-button">Profil törlése</button>
                <button type="submit" formaction="main.php" class="back-button">Vissza</button>
            </div>
        </form>
    </div>
</body>
</html>