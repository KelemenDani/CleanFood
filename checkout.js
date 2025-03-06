document.addEventListener('DOMContentLoaded', function () {
  const deliveryType = document.getElementById('delivery-type'); // Szállítási mód választó
  const deliveryTimeSection = document.getElementById('delivery-time'); // Időpont választó szekció
  const form = document.querySelector('form'); // Űrlap
  const paymentStatus = document.querySelector('#payment-status'); // Fizetési státusz üzenet

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

    // Validáció
    if (deliveryTypeValue === 'preorder' && ( !deliveryTime)) {
      paymentStatus.textContent = 'Kérjük, válassza ki az időt!';
      paymentStatus.style.color = 'red';
      return;
    }

    if (!shippingAddress) {
      paymentStatus.textContent = 'Kérjük, adja meg a szállítási címet!';
      paymentStatus.style.color = 'red';
      return;
    }

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
        } else {
          console.error('Hiba a rendelés feldolgozása során.');
        }
      })
      .catch((error) => {
        console.error('Hiba:', error);
      });
  });
});