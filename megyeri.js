document.addEventListener('DOMContentLoaded', function() {
    const foodList = document.querySelector('.food-list');
    const restaurantId = 15;

    fetchFoods(restaurantId);

    function fetchFoods(restaurantId) {
        fetch(`/getFoods.php?restaurant_id=${encodeURIComponent(restaurantId)}`)
            .then(response => response.json())
            .then(data => {
                foodList.innerHTML = '';
                if (data.error) {
                    foodList.innerHTML = `<p>${data.error}</p>`;
                } else if (data.length > 0) {
                    data.forEach(food => {
                        const foodItem = document.createElement('div');
                        foodItem.classList.add('food-item');
                        const imageUrl = `megyeri/${food.name.toLowerCase().replace(/ /g, '_')}.png`; // Kép URL generálása
                        foodItem.innerHTML = `
                            <img src="${imageUrl}" alt="${food.name}" class="food-image">
                            <h3>${food.name}</h3>
                            <p>Ár: ${food.price} Ft</p>
                            <p>Allergének: ${food.allergens}</p>
                            <div class="quantity-control">
                                <button class="decrease-quantity">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="increase-quantity">+</button>
                            </div>
                            <button class="add-to-cart" data-food="${food.name}" data-price="${food.price}">Kosárba</button>
                        `;
                        foodList.appendChild(foodItem);
                    });
                }
            })
            .catch(error => {
                foodList.innerHTML = `<p>Hiba történt az ételek lekérésekor: ${error.message}</p>`;
            });
    }
});