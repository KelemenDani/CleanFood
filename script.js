document.getElementById('registration-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const zip = document.getElementById('zipcode').value;
    const telepules = document.getElementById('city').value;
    const phonenumber = document.getElementById('phonenumber').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    const errorMessage = document.getElementById('error-message');
    errorMessage.textContent = '';

    if (zipcode.length != 4 || isNaN(zipcode)){
        errorMessage.textContent = 'Ilyen irányítószám nem létezik!';
        return;
    }

    if (password.length <= 5) {
        errorMessage.textContent = 'A jelszónak minimum 6 karakteresnek kell lennie!';
        return;
    }


    if (password !== confirmPassword) {
        errorMessage.textContent = 'A jelszavak nem egyeznek!';
        return;
    }

    if (phonenumber.length !== 11 || isNaN(phonenumber)) {
        errorMessage.textContent = 'A telefonszámnak pontosan 11 számjegyűnek kell lennie!';
        return;
    }

    alert(`Sikeres regisztráció!\nNév: ${name}\nE-mail: ${email}\nTelepülés: ${city}\nTelefonszám: ${phonenumber}`);


    document.getElementById('registration-form').submit();
});