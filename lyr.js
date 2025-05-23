document.addEventListener('DOMContentLoaded', function() {
    const foodList = document.querySelector('.food-list');
    const restaurantName = 'LYR Speciality Coffee and Food';

    fetchFoods(restaurantName);

    function fetchFoods(restaurantName) {
        fetch(`/getFoods.php?restaurant_name=${encodeURIComponent(restaurantName)}`)
            .then(response => response.json())
            .then(data => {
                foodList.innerHTML = '';
                if (data.error) {
                    foodList.innerHTML = `<p>${data.error}</p>`;
                } else if (data.length > 0) {
                    data.forEach(food => {
                        const foodItem = document.createElement('div');
                        foodItem.classList.add('food-item');
                        const imageUrl = `LYR/${food.name.toLowerCase().replace(/ /g, '_')}.png`; // Kép URL generálása
                        foodItem.innerHTML = `
                            <img src="${imageUrl}" alt="${food.name}" class="food-image">
                            <h3>${food.name}</h3>
                            <p>Ár: ${food.price} Ft</p>
                            <p>Allergének: ${food.allergens}</p>
                            <div class="quantity-control">
                                <label for="quantity-${food.name}">Darabszám:</label>
                                <input type="number" id="quantity-${food.name}" name="quantity" min="1" value="1">
                            </div>
                            <button class="add-to-cart" data-food="${food.name}" data-price="${food.price}">Kosárba</button>
                            <button class="remove-from-cart" data-food="${food.name}" style="display:none;">Eltávolítás a kosárból</button>
                        `;
                        foodList.appendChild(foodItem);

                        const addToCartButton = foodItem.querySelector('.add-to-cart');
                        const removeFromCartButton = foodItem.querySelector('.remove-from-cart');
                        const quantityInput = foodItem.querySelector('input[name="quantity"]');

                        addToCartButton.addEventListener('click', function() {
                            const quantity = parseInt(quantityInput.value, 10);
                            addToCart(food.name, food.price, quantity);
                            removeFromCartButton.style.display = 'inline-block';
                            addToCartButton.style.display = 'none';
                        });

                        removeFromCartButton.addEventListener('click', function() {
                            removeFromCart(food.name);
                            removeFromCartButton.style.display = 'none';
                            addToCartButton.style.display = 'inline-block';
                            quantityInput.value = 1; // Alapértelmezett érték visszaállítása
                        });
                    });
                } else {
                    foodList.innerHTML = '<p>Nincs elérhető étel ebben az étteremben.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                foodList.innerHTML = '<p>Hiba történt az ételek lekérésekor.</p>';
            });
    }

    function addToCart(foodName, foodPrice, quantity) {
        fetch('/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: foodName,
                price: foodPrice,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Termék hozzáadva a kosárhoz!');
            } else {
                alert('Hiba történt: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function removeFromCart(foodName) {
        fetch('/remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: foodName
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Termék eltávolítva a kosárból!');
            } else {
                alert('Hiba történt: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});