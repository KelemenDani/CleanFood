document.addEventListener('DOMContentLoaded', function() {
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const foodItems = document.querySelectorAll('.food-carousel .food-item');
    const foodDisplay = document.querySelector('.food-display');
    let currentIndex = 0;

    function showFoodItem(index) {
        const foodItem = foodItems[index];
        foodDisplay.innerHTML = `
            <div class="food-item" data-recipe="${foodItem.getAttribute('data-recipe')}">
                <img src="${foodItem.querySelector('img').src}" alt="${foodItem.querySelector('img').alt}">
                <div class="food-name">${foodItem.querySelector('.food-name').textContent}</div>
                <div class="food-recipe">${foodItem.getAttribute('data-recipe')}</div>
            </div>
        `;
    }

    nextButton.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % foodItems.length;
        showFoodItem(currentIndex);
    });

    prevButton.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + foodItems.length) % foodItems.length;
        showFoodItem(currentIndex);
    });

    // Show the first food item initially
    showFoodItem(currentIndex);
});