document.addEventListener('DOMContentLoaded', function() {
    const foodList = document.querySelector('.food-list');
    const restaurantName = 'Pékinas Pékség';

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
                        const imageUrl = `pekinas/${food.name.toLowerCase().replace(/ /g, '_')}.png`; // Kép URL generálása
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
                            removeFromCartButton.style.display = 'inline-block';
                            // Itt hozzáadhatod a kosárhoz a terméket a darabszámmal
                            console.log(`Added ${quantityInput.value} of ${food.name} to cart`);
                        });

                        removeFromCartButton.addEventListener('click', function() {
                            removeFromCartButton.style.display = 'none';
                            quantityInput.value = 1; // Alapértelmezett érték visszaállítása
                            // Itt eltávolíthatod a terméket a kosárból
                            console.log(`Removed ${food.name} from cart`);
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