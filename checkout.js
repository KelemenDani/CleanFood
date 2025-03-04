const expirationDateInput = document.querySelector('#expiration-date');

expirationDateInput.addEventListener('input', () => {
  const value = expirationDateInput.value;
  if (value.length === 2) {
    expirationDateInput.value += '/';
  }
});

const cardNumberInput = document.querySelector('#card-number');

cardNumberInput.addEventListener('input', () => {
  const value = cardNumberInput.value.replace(/\s+/g, '');
  const formattedValue = value.match(/.{1,4}/g).join(' ');
  cardNumberInput.value = formattedValue;
});

const form = document.querySelector('form');
const paymentStatus = document.querySelector('#payment-status');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const cardNumber = document.querySelector('#card-number').value.replace(/\s+/g, '');
  const cvc = document.querySelector('#cvc').value;
  const expirationDate = document.querySelector('#expiration-date').value;

  if (cardNumber.length === 16 && cvc.length === 3 && expirationDate.length === 5) {
    alert('Sikeres fizetés!');
    
    // Send email to the user
    fetch('/send-email.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ message: 'Sikeres fizetés cleanfood' })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        console.log('Email sent successfully');
      } else {
        console.error('Failed to send email');
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  } else {
    paymentStatus.textContent = 'Nem sikerült a fizetés!';
    paymentStatus.style.color = 'red';
  }
});