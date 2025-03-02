document.addEventListener('DOMContentLoaded', function() {
    const foodList = document.querySelector('.food-list');
    const restaurantSelect = document.getElementById('restaurant-select');

    restaurantSelect.addEventListener('change', function() {
        const restaurantAddress = this.value;
        if (restaurantAddress) {
            fetchFoods(restaurantAddress);
        } else {
            foodList.innerHTML = '<p>Kérlek válassz egy éttermet!</p>';
        }
    });

    function fetchFoods(restaurantAddress) {
        fetch(`/getFoods.php?restaurant_address=${encodeURIComponent(restaurantAddress)}`)
            .then(response => response.json())
            .then(data => {
                foodList.innerHTML = '';
                if (data.error) {
                    foodList.innerHTML = `<p>${data.error}</p>`;
                } else if (data.length > 0) {
                    data.forEach(food => {
                        const foodItem = document.createElement('div');
                        foodItem.classList.add('food-item');
                        const imageUrl = `burgerking/${food.name.toLowerCase().replace(/ /g, '_')}.png`; // Kép URL generálása
                        foodItem.innerHTML = `
                            <img src="${imageUrl}" alt="${food.name}" class="food-image">
                            <h3>${food.name}</h3>
                            <p>Ár: ${food.price} Ft</p>
                            <p>Allergének: ${food.allergens}</p>
                            <div class="quantity-control">
                                <label for="quantity-${food.name}">Darabszám:</label>
                                <input type="number" id="quantity-${food.name}" name="quantity" min="1" value="1">
                            </div>
                            <button class="add-to-cart" data-food="${food.id}" data-price="${food.price}">Kosárba</button>
                            <button class="remove-from-cart" data-food="${food.id}" style="display:none;">Eltávolítás a kosárból</button>
                        `;
                        foodList.appendChild(foodItem);

                        const addToCartButton = foodItem.querySelector('.add-to-cart');
                        const removeFromCartButton = foodItem.querySelector('.remove-from-cart');
                        const quantityInput = foodItem.querySelector('input[name="quantity"]');

                        addToCartButton.addEventListener('click', function() {
                            const foodId = this.dataset.food;
                            const quantity = parseInt(quantityInput.value);

                            fetch('/add_to_cart.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ foodId, quantity })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Étel hozzáadva a kosárhoz!');
                                    removeFromCartButton.style.display = 'inline-block';
                                } else {
                                    alert('Hiba történt az étel hozzáadásakor.');
                                }
                            });
                        });

                        removeFromCartButton.addEventListener('click', function() {
                            const foodId = this.dataset.food;

                            fetch('/remove_from_cart.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ foodId })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Étel eltávolítva a kosárból!');
                                    removeFromCartButton.style.display = 'none';
                                    quantityInput.value = 1;
                                } else {
                                    alert('Hiba történt az étel eltávolításakor.');
                                }
                            });
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
});