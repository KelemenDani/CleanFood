<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['email'] != 'admin123@gmail.com') {
    header("Location: /login.php");
    exit();
}

include 'db_connection.php';

// Felhasználók lekérése
try {
    $query = "SELECT * FROM users";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Hiba történt a felhasználók lekérésekor: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Felhasználók kezelése</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="profile-container">
        <h1>Felhasználók kezelése</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Email</th>
                    <th>Telefonszám</th>
                    <th>Város</th>
                    <th>Irányítószám</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['phonenumber']); ?></td>
                        <td><?php echo htmlspecialchars($user['city']); ?></td>
                        <td><?php echo htmlspecialchars($user['zipcode']); ?></td>
                        <td>
                            <div class="button-group">
                                <form action="delete_user.php" method="post" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="delete" onclick="return confirm('Biztosan törölni szeretnéd ezt a felhasználót?');">Törlés</button>
                                </form>
                                <form action="edit_user.php" method="get" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="edit">Módosítás</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="main.php" class="btn">Vissza a főoldalra</a>
        </div>
    </div>
</body>
</html>