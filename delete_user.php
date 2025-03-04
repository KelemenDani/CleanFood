<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['email'] != 'admin123@gmail.com') {
    header("Location: /login.php");
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    try {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (Exception $e) {
        die("Hiba történt a felhasználó törlésekor: " . $e->getMessage());
    }
}
?>