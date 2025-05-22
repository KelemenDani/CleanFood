<!DOCTYPE html>
<html>
<head>
  <title>CleanFood</title>
  <link rel="stylesheet" href="check.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <header>
      <h1 class="logo">CleanFood</h1>
    </header>
    <div class="cart">
    </div>
    <div class="payment-form">
      <h2>Fizetési és szállítási adatok</h2>
      <form id="order-form">
        <label for="delivery-type">Szállítási mód:</label>
        <select id="delivery-type" name="delivery-type" required>
          <option value="asap">Kiszállítás amint lehetséges</option>
          <option value="preorder">Átveszem az étteremnél</option>
        </select>

        <label for="payment-method">Fizetési mód:</label>
        <select id="payment-method" name="payment-method" required>
          <option value="cash">Készpénz (futárnál)</option>
          <option value="card">Bankkártya (futárnál)</option>
        </select>

        <label for="delivery-instructions">Szállítási utasítások:</label>
        <input type="text" id="delivery-instructions" name="delivery-instructions">
        <label for="shipping-address">Szállítási cím:</label>
        <input type="text" id="shipping-address" name="shipping-address" required placeholder="Írd be a szállítási címed">
        <button type="submit">Rendelés leadása</button>
      </form>
      <a href="main.php" class="back-link">Vissza a főoldalra</a>
      <p id="payment-status"></p>
    </div>
  </div>

  <!-- Modal ablak -->
  <div id="success-modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Rendelés sikeresen leadva!</p>
    </div>
  </div>

  <script src="checkout.js"></script>
</body>
</html>