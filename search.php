<?php
include 'db_connection.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    try {
        $sql = "SELECT name, price, restaurants_id FROM foods WHERE name LIKE :query";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($foods)) {
            echo json_encode(['error' => 'Nincs találat.']);
        } else {
            echo json_encode($foods);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Hiba történt a keresés során: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Nincs keresési lekérdezés.']);
}
?>