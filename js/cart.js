document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;

            fetch('/C:/MAMP/htdocs/CleanFood/add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ productId: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Termék hozzáadva a kosárhoz!');
                } else {
                    alert('Hiba történt a termék hozzáadása során.');
                }
            });
        });
    });
});
