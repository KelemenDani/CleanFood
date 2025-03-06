<!DOCTYPE html>
<html>
<head>
  <title>CleanFood</title>
  <link rel="stylesheet" href="check.css">
</head>
<body>
  <div class="container">
    <h1>CleanFood</h1>
    <div class="cart">
    </div>
    <div class="payment-form">
      <h2>Fizetési és szállítási adatok</h2>
      <form>
        <!-- Szállítási mód választása -->
        <label for="delivery-type">Szállítási mód:</label>
        <select id="delivery-type" name="delivery-type" required>
          <option value="asap">Kiszállítás amint lehetséges</option>
          <option value="preorder">Előrendelés időponttal</option>
        </select>

        <!-- Időpont választása (csak előrendelés esetén jelenik meg) -->
        <div id="delivery-time-section">
       <label for="delivery-time">Kérjük válassza ki a szállítási időt:</label>
        <input type="time" id="delivery-time" name="delivery-time">
        </div>

        <!-- Fizetési mód választása -->
        <label for="payment-method">Fizetési mód:</label>
        <select id="payment-method" name="payment-method" required>
          <option value="cash">Készpénz (futárnál)</option>
          <option value="card">Bankkártya (futárnál)</option>
        </select>

        <!-- Szállítási cím és egyéb információk -->
        <label for="shipping-address">Szállítási cím:</label>
        <input type="text" id="shipping-address" name="shipping-address" required>
        <label for="delivery-instructions">Szállítási utasítások:</label>
        <input type="text" id="delivery-instructions" name="delivery-instructions">
        <button type="submit">Rendelés leadása</button>
        <br><p></p>
        <a href="main.php" class="back-link">Vissza a főoldalra</a>
        <p id="payment-status"></p>
      </form>
    </div>
    <script src="checkout.js"></script>
  </div>
</body>
</html>