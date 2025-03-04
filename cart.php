<?php
session_start();

// Hibakeresés: Session tartalmának kiírása
/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit();
}

// Kosár tartalmának lekérése
$foods = $_SESSION['cart'] ?? [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosár</title>
    <link rel="stylesheet" href="kosar.css">
    </head>
<body>
    <div class="container">
        <h1>Kosár</h1>
        <?php if (!empty($foods)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Étel</th>
                        <th>Ár</th>
                        <th>Mennyiség</th>
                        <th>Összesen</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($foods as $foodId => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo number_format($item['price'], 0, ',', ' '); ?> Ft</td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo number_format($item['price'] * $item['quantity'], 0, ',', ' '); ?> Ft</td>
                            <td>
                                <button class="remove-button" onclick="removeFromCart('<?php echo htmlspecialchars($foodId); ?>')">Törlés</button>
                            </td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total">Összesen: <?php echo number_format($total, 0, ',', ' '); ?> Ft</p>
            <form action="checkout.php" method="post">
                <button type="submit" class="checkout-button">Fizetés</button>
            </form>
        <?php else: ?>
            <p class="empty-cart">A kosár üres.</p>
        <?php endif; ?>
        <a href="main.php" class="back-link">Vissza a főoldalra</a>
    </div>

    <script>
        function removeFromCart(foodId) {
            fetch('/remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: foodId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Termék eltávolítva a kosárból!');
                    location.reload(); // Oldal frissítése
                } else {
                    alert('Hiba történt: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>