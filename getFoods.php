<?php
include 'db_connection.php';

if (isset($_GET['restaurant_name']) || isset($_GET['restaurant_address']) || isset($_GET['restaurant_id'])) {
    $restaurantName = $_GET['restaurant_name'] ?? null;
    $restaurantAddress = $_GET['restaurant_address'] ?? null;
    $restaurantId = $_GET['restaurant_id'] ?? null;

    try {
        if ($restaurantName) {
            $query = "
                SELECT f.name, f.price, a.name AS allergens 
                FROM foods f
                LEFT JOIN allergens a ON f.allergens_id = a.id
                WHERE f.restaurants_id = (SELECT id FROM restaurants WHERE name = :restaurant_name LIMIT 1)
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':restaurant_name', $restaurantName, PDO::PARAM_STR);
        } elseif ($restaurantAddress) {
            $query = "
                SELECT f.name, f.price, a.name AS allergens 
                FROM foods f
                LEFT JOIN allergens a ON f.allergens_id = a.id
                WHERE f.restaurants_id = (SELECT id FROM restaurants WHERE address = :restaurant_address LIMIT 1)
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':restaurant_address', $restaurantAddress, PDO::PARAM_STR);
        } elseif ($restaurantId) {
            $query = "
                SELECT f.name, f.price, a.name AS allergens 
                FROM foods f
                LEFT JOIN allergens a ON f.allergens_id = a.id
                WHERE f.restaurants_id = :restaurant_id
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':restaurant_id', $restaurantId, PDO::PARAM_INT);
        }

        $stmt->execute();
        $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($foods)) {
            echo json_encode(['error' => 'Nincs elérhető étel ebben az étteremben.']);
        } else {
            echo json_encode($foods);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Hiba történt az ételek lekérésekor: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Étterem neve, címe vagy azonosítója nem található.']);
}
?>