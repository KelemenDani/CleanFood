document.addEventListener('DOMContentLoaded', function () {
  const deliveryType = document.getElementById('delivery-type'); // Szállítási mód választó
  const deliveryTimeSection = document.getElementById('delivery-time'); // Időpont választó szekció
  const form = document.getElementById('order-form'); // Űrlap
  const paymentStatus = document.querySelector('#payment-status'); // Fizetési státusz üzenet
  const modal = document.getElementById('success-modal');
  const closeBtn = document.getElementsByClassName('close')[0];

  // Szállítási mód változásának figyelése
  deliveryType.addEventListener('change', function () {
    if (deliveryType.value === 'preorder') {
      deliveryTimeSection.classList.remove('hidden'); // Időpont választó megjelenítése
    } else {
      deliveryTimeSection.classList.add('hidden'); // Időpont választó elrejtése
    }
  });

  // Űrlap elküldésének kezelése
  form.addEventListener('submit', function (e) {
    e.preventDefault(); // Alapértelmezett űrlap elküldés megakadályozása

    // Adatok összegyűjtése
    const deliveryTypeValue = deliveryType.value; // Szállítási mód

    const deliveryTime = document.getElementById('delivery-time')?.value; // Szállítási idő
    const paymentMethod = document.getElementById('payment-method').value; // Fizetési mód
    const shippingAddress = document.getElementById('shipping-address').value; // Szállítási cím
    const deliveryInstructions = document.getElementById('delivery-instructions').value; // Szállítási utasítások

    // Sikeres rendelés üzenet
    paymentStatus.textContent = 'Rendelés sikeresen leadva!';
    paymentStatus.style.color = 'green';

    // Adatok elküldése a szerverre (pl. fetch API-val)
    const orderData = {
      deliveryType: deliveryTypeValue,
     
      deliveryTime: deliveryTypeValue === 'preorder' ? deliveryTime : null, // Csak előrendelés esetén küldjük az időt
      paymentMethod: paymentMethod,
      shippingAddress: shippingAddress,
      deliveryInstructions: deliveryInstructions,
    };

    fetch('/submit-order.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(orderData),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          console.log('Rendelés sikeresen feldolgozva!');
          modal.style.display = 'block';
        } else {
          console.error('Hiba a rendelés feldolgozása során.');
        }
      })
      .catch((error) => {
        console.error('Hiba:', error);
      });
  });

  closeBtn.onclick = function() {
    modal.style.display = 'none';
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  }
});