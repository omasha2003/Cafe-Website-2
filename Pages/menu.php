<?php
session_start();
include("../Components/db.php");

// Fetch distinct categories and cousin types from the database
$category_query = "SELECT DISTINCT category FROM menu";
$category_result = mysqli_query($con, $category_query);

$cousin_type_query = "SELECT DISTINCT cousin_type FROM menu";
$cousin_type_result = mysqli_query($con, $cousin_type_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <title>Menu</title>
    <style>

body {
    font-family: 'Lato', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #fff;
}

.container {
    width: 95%;
    margin: 0 auto;
    margin-top: 30px;
}

.filter-search-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.filter-container select {
    padding: 10px;
    margin-left: 13px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 3px;
}


.search-bar {
    position: relative;
}

.search-bar input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    width: 250px;
}

.search-bar img {
    position: absolute;
    color: #4CAF50;
    top: 10px;
    left: -30px;
    width: 20px;
    height: 20px;
}

.filter-container {
            display: flex;
            gap: 10px;
        }

        .filter-container select,
        .filter-container button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fff;
        }

        .filter-container button {
            background-color: #0e0d0d;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-container button:hover {
            background-color: #d8d8d4;
        }

    .title h2 {
        font-family: "Museo Sans Rounded", sans-serif;
        margin: 0;
        font-size: 2.5rem;
    }

    .intro {
        text-align: center;
        margin-bottom: 30px;
    }

    h2 {
        font-family: "Museo Sans Rounded", sans-serif;
        font-weight: 700;
    }

    .category-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #405c45;
        margin-bottom: 10px;
        margin-top: 20px;
        margin-left: 40px;
    }

    .food-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
}

.food-item {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}

.food-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
}

.food-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.food-item-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.food-item-title {
    font-size: 1.4rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.food-item-description {
    font-family: "Museo Sans Rounded", sans-serif;
    font-weight: 300;
    font-size: 1rem;
    color: #666;
    line-height: 1.5;
    margin-bottom: 15px;
}

.food-item-price {
    font-size: 1.4rem;
    color: #333;
    font-weight: bold;
    margin-bottom: 10px;
}

.food-item-details {
    margin-bottom: 15px;
    font-size: 0.9rem;
    color: #555;
}

.food-item-type,
.food-item-category {
    margin-bottom: 5px;
}

.add-to-cart-btn {
    background-color: #0e0d0d;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.add-to-cart-btn:hover {
    background-color: #d8d8d4;
}


    .add-to-cart-btn {
        bottom: 3px;
        padding: 8px 20px;
        background-color: #0e0d0d;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s
    }

    .add-to-cart-btn:hover {
        background-color: #d8d8d4;
    }
    .my-cart-button {
    position: fixed;
    bottom: 20px; 
    right: 20px;  
    z-index: 999;
}

.my-cart-button .my-cart-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 0px;
    height: 60px; 
    border-radius: 10px; 
    background-color: #0e0d0d; 
    color: #fff;
    border: 2px solid #fff; 
    cursor: pointer;
    font-size: 20px; 
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 12px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;

}
.my-cart-button .my-cart-icon:hover {
    background-color: #555; 
    transform: scale(1.1); 
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.4), 0 8px 16px rgba(0, 0, 0, 0.3);
}

.my-cart-button .my-cart-icon i {
    margin-right: 8px; 
}

.my-cart-button .my-cart-icon p {
    margin: 0;
    font-size: 13px; 
    color: #fff;
    line-height: 1;
}

.cart-notification {
    position: absolute;
    top: -5px; 
    right: -5px; 
    background-color: #f00; 
    color: white;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 0.9rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
}

    .cart-sidebar {
        position: fixed;
        right: 0;
        top: 0;
        width: 400px;
        height: 100%;
        background-color: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        transform: translateX(100%);
        transition: transform 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    .cart-sidebar.active {
        transform: translateX(0);
    }

    .cart-sidebar-header {
        height: 50px;
        background-color: #0e0d0d;
        position: relative;
    }

    .cart-sidebar-header h1 {
        background-color: #0e0d0d;
        align-items: center;
        font-family: "Museo Sans Rounded", sans-serif;
        font-weight: 400;
        padding: 20px;
        color: #fffcda;
        text-align: center;
        font-size: 1.5rem;
    }

    .close-cart {
        position: absolute;
        top: 34px;
        right: 24px;
        font-size: 1.5rem;
        cursor: pointer;
        color: #fffcda;
    }

    .cart-sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 25px;
        margin-top: 10px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .cart-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }

    .cart-item-details {
        flex: 1;
        margin-left: 10px;
    }

    .cart-item-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #405c45;
    }

    .cart-item-price {
        font-size: 0.8rem;
        color: #999;
    }

    .cart-item-total-price {
        margin-top: 2px;
    }

    .qty-controls {
        display: flex;
        align-items: center;
    }

    .qty-controls button {
        background-color: #0e0d0d;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 1rem;
        border-radius: 3%;
    }

    .qty-controls span {
        margin: 0 10px;
        font-size: 1rem;
    }

    .qty-controls button:hover {
        background-color: #4e724f;
    }

    .remove-btn {
        color: #999;
        cursor: pointer;
        font-size: 1rem;
        margin-left: 20px;
    }

    .remove-btn:hover {
        color: #0e0d0d;
    }

    .cart-sidebar-footer {
        padding: 20px;
        border-top: 1px solid #ddd;
        display: flex;
        flex-direction: column;
        gap: 10px;
        /* Add spacing between elements */
    }

    .cart-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.2rem;
        font-weight: bold;
        color: #405c45;
        margin-bottom: 10px;
        
    }

    .checkout-btn {
        display: block;
        margin-top: 20px;
        width: 100%;
        padding: 10px;
        background-color: #0e0d0d;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .checkout-btn:hover {
        background-color: #0e0d0d;
    }
    </style>
</head>

<body>
    <?php include("../Components/navbar.php"); ?>

    <div class="container">
        <div class="filter-search-bar">
            <div class="filter-container">
                <button onclick="filterByType('')">All Types</button>
                <button onclick="filterByType('Sri Lankan')">Sri Lankan</button>
                <button onclick="filterByType('Chinese')">Chinese</button>
                <button onclick="filterByType('Italian')">Italian</button>
            </div>
            <div class="filter-container">
                <select id="category-filter" onchange="filterByCategory()">
                    <option value="">All Categories</option>
                    <option value="Main Dishes">Main Dishes</option>
                    <option value="Desserts">Desserts</option>
                    <option value="Beverages">Beverages</option>
                </select>
                <div class="search-bar">
                    <input type="text" id="search-input" onkeyup="searchTable()" placeholder="Search Food...">
                </div>

                <div class="my-cart-button">
                <a href="javascript:void(0);" onclick="toggleCart()" class="my-cart-icon btn btn-primary btn-lg">
                <i class="fas fa-shopping-cart"></i>
                <p>My Cart</p>
                <span id="cartNotification" class="cart-notification" style="display:none;"></span>
                </a>
                </div>
    </div>

            </div>
        </div>

        <div id="food-container" class="food-container">
            <?php
            // Fetch all food items
            $food_query = "SELECT * FROM menu";
            $food_result = mysqli_query($con, $food_query);

            // Display food items
            while ($row = mysqli_fetch_assoc($food_result)) :
            ?>
            <div class="food-item" data-type="<?php echo $row['cousin_type']; ?>" data-category="<?php echo $row['category']; ?>">
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <div class="food-item-content">
                    <div class="food-item-title"><?php echo $row['name']; ?></div>
                    <div class="food-item-description"><?php echo $row['description']; ?></div>
                    <div class="food-item-price">LKR <?php echo $row['price']; ?></div>
                    <div class="food-item-details">
                        <div class="food-item-type">Cuisine: <?php echo $row['cousin_type']; ?></div>
                        <div class="food-item-category">Category: <?php echo $row['category']; ?></div>
                    </div>
                    <a href="#" class="add-to-cart-btn">Add to Cart</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
      

        <div class="my-cart-button">
            <a href="javascript:void(0);" onclick="toggleCart()" class="my-cart-icon btn btn-primary btn-lg">
                <i class="fas fa-shopping-cart"></i>
                <p>My Cart</p>
                <span id="cartNotification" class="cart-notification" style="display:none;"></span>
            </a>
        </div>
    </div>

    <script>
    function filterByType(type) {
        const items = document.querySelectorAll('.food-item');
        items.forEach(item => {
            if (type === '' || item.getAttribute('data-type') === type) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function filterByCategory() {
        const category = document.getElementById('category-filter').value;
        const items = document.querySelectorAll('.food-item');
        items.forEach(item => {
            if (category === '' || item.getAttribute('data-category') === category) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function searchTable() {
        const input = document.getElementById('search-input').value.toLowerCase();
        const items = document.querySelectorAll('.food-item');
        items.forEach(item => {
            const name = item.querySelector('.food-item-title').textContent.toLowerCase();
            const description = item.querySelector('.food-item-description').textContent.toLowerCase();
            if (name.includes(input) || description.includes(input)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
    </script>

   
    <div id="cartSidebar" class="cart-sidebar">
        <div class="cart-sidebar-header">
            <h1>Your Basket</h1>
            <span class="close-cart" onclick="toggleCart()">&times;</span>
        </div>

        <div class="cart-sidebar-content" id="cartContent">
     
            <div id="emptyCartMessage" class="empty-cart-message"
                style="display: none; margin-top: 46px; size:12px; color:#999">
                Your basket looks a little empty. Why not check out some of our unbeatable deals?
            </div>
            

        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span id="cartTotal"></span>
            </div>
            <button id="checkoutBtn" class="checkout-btn" onclick="abc()">Checkout</button>
        </div>
    </div>

    <?php include("../Components/footer.php"); ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                addToCart(this);
            });
        });
    });

    function toggleCart() {
        const cartSidebar = document.getElementById('cartSidebar');
        if (cartSidebar) {
            cartSidebar.classList.toggle('active');
            updateCartTotal();
        }
    }

    function updateCartTotal() {
        const cartItems = document.querySelectorAll('.cart-item');
        const emptyCartMessage = document.getElementById('emptyCartMessage');
        const cartFooter = document.querySelector('.cart-sidebar-footer');
        let total = 0;
        let itemCount = cartItems.length; 

        cartItems.forEach(item => {
            const price = parseFloat(item.querySelector('.cart-item-price').getAttribute('data-price'));
            const qty = parseInt(item.querySelector('.qty-controls span').innerText);
            const itemTotal = price * qty;
            item.querySelector('.cart-item-total-price').innerText = `LKR ${itemTotal.toFixed(2)}`;
            total += itemTotal;
        });

        const cartTotal = document.getElementById('cartTotal');
        if (cartTotal) {
            cartTotal.innerText = `LKR ${total.toFixed(2)}`;
        }

        if (emptyCartMessage && cartFooter) {
            if (itemCount > 0) {
                emptyCartMessage.style.display = 'none';
                cartFooter.style.display = 'block';
            } else {
                emptyCartMessage.style.display = 'block';
                cartFooter.style.display = 'none';
            }
        }

        updateCartNotification(itemCount);
    }

    function increaseQty(button) {
        const qtySpan = button.previousElementSibling;
        let qty = parseInt(qtySpan.innerText);
        qtySpan.innerText = ++qty;
        updateCartTotal();
    }

    function decreaseQty(button) {
        const qtySpan = button.nextElementSibling;
        let qty = parseInt(qtySpan.innerText);
        if (qty > 1) {
            qtySpan.innerText = --qty;
            updateCartTotal();
        }
    }

    function removeItem(button) {
        const cartItem = button.closest('.cart-item');
        if (cartItem) {
            cartItem.remove();
            updateCartTotal();
        }
    }

    function addToCart(button) {
        const foodItem = button.closest('.food-item');
        const itemTitle = foodItem.querySelector('.food-item-title').innerText;
        const itemPrice = parseFloat(foodItem.querySelector('.food-item-price').innerText.replace('LKR', ''));
        const cartContent = document.querySelector('.cart-sidebar-content');

        let existingItem = null;
        const cartItems = document.querySelectorAll('.cart-item');
        cartItems.forEach(item => {
            if (item.querySelector('.cart-item-title').innerText === itemTitle) {
                existingItem = item;
            }
        });

        if (existingItem) {
            // Increase quantity if item exists
            const qtySpan = existingItem.querySelector('.qty-controls span');
            let qty = parseInt(qtySpan.innerText);
            qtySpan.innerText = ++qty;
        } else {
            // Add new item to cart
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
        <img src="${foodItem.querySelector('img').src}" alt="${itemTitle}" style="margin-top: 46px;">
        <div class="cart-item-details" style="margin-top: 46px;">
            <div class="cart-item-title">${itemTitle}</div>
            <div class="cart-item-price" data-price="${itemPrice}">LKR ${itemPrice.toFixed(2)}</div>
            <div class="cart-item-total-price">LKR ${itemPrice.toFixed(2)}</div>
        </div>
        <div class="qty-controls" style="margin-top: 46px;">
            <button onclick="decreaseQty(this)">-</button>
            <span>1</span>
            <button onclick="increaseQty(this)">+</button>
        </div>
        <div class="cart-item-remove" style="margin-top: 46px;">
            <span class="remove-btn" onclick="removeItem(this)">&times;</span>
        </div>
    `;
            cartContent.appendChild(cartItem);
        }
        updateCartTotal();
    }

    function updateCartNotification(count) {
        const cartNotification = document.getElementById('cartNotification');
        if (cartNotification) {
            if (count > 0) {
                cartNotification.innerText = count;
                cartNotification.style.display = 'block';
            } else {
                cartNotification.style.display = 'none';
            }
        }
    }

    document.getElementById('checkoutBtn').addEventListener('click', function(event) {
        event.preventDefault(); 
        const cartItems = document.querySelectorAll('.cart-item');
        let cartData = [];

        cartItems.forEach(item => {
            const title = item.querySelector('.cart-item-title').innerText;
            const price = parseFloat(item.querySelector('.cart-item-price').getAttribute('data-price'));
            const quantity = parseInt(item.querySelector('.qty-controls span').innerText);

            cartData.push({
                title: title,
                price: price,
                quantity: quantity
            });
        });

        if (cartData.length > 0) {
            // Send the data to the server
            fetch('save_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        order: cartData
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        
                        window.location.href = 'checkout_success.php';
                    } else {
                        alert('There was an error processing your order: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            alert('Your cart is empty.');
        }
    });
    </script>
</body>

</html>
<?php 
mysqli_close($con);
?>