<?php
include 'db_connection.php';

if (isset($_GET['restaurant_name']) || isset($_GET['restaurant_address'])) {
    $restaurantName = $_GET['restaurant_name'] ?? null;
    $restaurantAddress = $_GET['restaurant_address'] ?? null;

    try {
        if ($restaurantName) {
            $query = "
                SELECT f.name, f.price, a.name AS allergens 
                FROM foods f
                LEFT JOIN allergens a ON f.allergens_id = a.id
                WHERE f.restaurants_id = (SELECT id FROM restaurants WHERE name = :restaurant_name)
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':restaurant_name', $restaurantName, PDO::PARAM_STR);
        } elseif ($restaurantAddress) {
            $query = "
                SELECT f.name, f.price, a.name AS allergens 
                FROM foods f
                LEFT JOIN allergens a ON f.allergens_id = a.id
                WHERE f.restaurants_id = (SELECT id FROM restaurants WHERE address = :restaurant_address)
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':restaurant_address', $restaurantAddress, PDO::PARAM_STR);
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
    echo json_encode(['error' => 'Étterem neve vagy címe nem található.']);
}
?>