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

    function updateTime() {
        const now = new Date();
        
        const formattedTime = 
            now.getFullYear() + "-" + 
            String(now.getMonth()+1).padStart(2, '0') + "-" + 
            String(now.getDate()).padStart(2, '0') + " " + 
            String(now.getHours()).padStart(2, '0') + ":" + 
            String(now.getMinutes()).padStart(2, '0') + ":" + 
            String(now.getSeconds()).padStart(2, '0');
        
        document.getElementById('currentTime').textContent = formattedTime;
    }
    setInterval(updateTime, 1000);
    updateTime();

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

    // Search functionality
    const searchBtn = document.getElementById('searchBtn');
    const searchText = document.getElementById('searchText');

    searchBtn.addEventListener('click', function() {
        const query = searchText.value.toLowerCase();
        console.log('Search query:', query); // Debugging log
        const foodItems = document.querySelectorAll('.food-item');

        let found = false;
        foodItems.forEach(item => {
            const foodNameElement = item.querySelector('.food-name a');
            if (foodNameElement) {
                const foodName = foodNameElement.textContent.toLowerCase();
                console.log('Checking food item:', foodName); // Debugging log
                if (foodName.includes(query)) {
                    item.scrollIntoView({ behavior: 'smooth' });
                    found = true;
                }
            }
        });

        if (!found) {
            alert('Nincs találat az adott keresésre.');
        }
    });

    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const foodId = this.dataset.foodId;
            const quantity = 1; // Default quantity

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
                } else {
                    alert('Hiba történt az étel hozzáadásakor.');
                }
            });
        });
    });
});