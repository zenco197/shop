
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Shop - Stationery Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2A2A2A;
            --accent-color: #FF6B6B;
            --light-bg: #F8F9FA;
            --dark-text: #2D3436;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: var(--primary-color);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            transition: var(--transition);
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: var(--transition);
        }
        .back-btn{
            color: white;
            background: var(--primary-color);

        }
        .nav-link:hover {
            background: rgba(255,255,255,0.1);
        }

        .cart-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cart-count {
            background: var(--accent-color);
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            padding: 2rem 0;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: var(--transition);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            padding: 1rem;
            background: #fff;
        }

        .product-info {
            padding: 1.5rem;
            border-top: 1px solid #eee;
        }

        .product-price {
            color: var(--accent-color);
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .add-to-cart {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .add-to-cart:hover {
            background: var(--accent-color);
        }

        .cart-modal {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            max-width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0 15px rgba(0,0,0,0.1);
            transition: right 0.3s ease-in-out;
            padding: 1.5rem;
            overflow-y: auto;
        }

        .cart-modal.active {
            right: 0;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .checkout-form {
            display: grid;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-input {
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
        }

        .form-input:focus {
            outline: 2px solid var(--accent-color);
            border-color: transparent;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <a href="#" class="logo">Mini Shop</a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.html" class="nav-link">Log out</a></li>                
                    <li><a href="homepage.html" class="nav-link">Home</a></li>
                    <li><a href="#" class="nav-link">Products</a></li>
                    <li><a href="#" class="nav-link">About</a></li>
                    <li><a href="#" class="nav-link cart-link" onclick="toggleCart()">
                        <i class="fas fa-shopping-cart"></i>               
                        <span class="cart-count" id="cart-count">0</span>
                    </a></li>
                </ul>           
            </nav>
        </div>
    </header>

    <main class="container">
        <h1 class="page-title">Featured Stationery</h1>
            <h2>Featured Products</h2>
        <div class="products-grid">
            <article class="product-card">
                <img src="ballpen.webp" alt="Premium Ballpens" class="product-image">
                <div class="product-info">
                    <h3>Premium Ballpens</h3>
                    <p class="product-price">₱25.00</p>
                    <button class="add-to-cart" onclick="addToCart('Premium Ballpens', 25)">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </div>
            </article>

<article class="product-card">
    <img src="pencil set.jpg" alt="Pencil Set" class="product-image">
    <div class="product-info">
        <h3>Pencil Set</h3>
        <p class="product-price">₱350.00</p>
        <button class="add-to-cart" onclick="addToCart('Pencil Set', 350)">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
    </div>
</article>

<article class="product-card">
    <img src="notebook.webp" alt="Notebooks" class="product-image">
    <div class="product-info">
        <h3>Notebooks</h3>
        <p class="product-price">₱40.00</p>
        <button class="add-to-cart" onclick="addToCart('Notebooks', 40)">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
    </div>
</article>

<article class="product-card">
    <img src="scie cal.jpg" alt="Scientific Calculator" class="product-image">
    <div class="product-info">
        <h3>Scientific Calculator</h3>
        <p class="product-price">₱1000.00</p>
        <button class="add-to-cart" onclick="addToCart('Scientific Calculator', 1000)">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
    </div>
</article>

<article class="product-card">
    <img src="flashdrive.jpg" alt="Flash Drive" class="product-image">
    <div class="product-info">
        <h3>Flash Drive</h3>
        <p class="product-price">₱230.00</p>
        <button class="add-to-cart" onclick="addToCart('Flash Drive', 230)">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
        
    </div>
</article>

        </div>
    </main>

    <!-- Cart Modal -->
    <div class="cart-modal" id="cartModal">
        <div class="cart-header">
            <h2>Your Cart</h2>
            <button class="close-cart" onclick="toggleCart()">&times;</button>
        </div>
        <div class="cart-items" id="cartItems"></div>
        <div class="cart-summary">
            <p>Total: <span id="cartTotal">₱0.00</span></p>
            <button class="checkout-btn" onclick="showCheckout()">Proceed to Checkout</button>
        </div>
    </div>

    <!-- Checkout Form Modal -->
    <div class="checkout-modal" id="checkoutModal">
        <h2>Checkout</h2>
        <form id="checkoutForm" class="checkout-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="payment">Payment Method:</label>
                <select id="payment" class="form-input" required>
                    <option value="credit">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cod">Cash on Delivery</option>
                    <option value="gcash">Gcash</option>
                    </select>
            </div>
            <button type="submit" class="checkout-btn">Complete Purchase</button>
        </form>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function addToCart(name, price) {
            const existingItem = cart.find(item => item.name === name);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            updateCart();
        }

        function updateCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
            document.getElementById('cart-count').textContent = cart.length;
            renderCartItems();
        }

        function renderCartItems() {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            let total = 0;
            cartItems.innerHTML = '';
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                cartItems.innerHTML += `
                    <div class="cart-item">
                        <span>${item.name} (${item.quantity})</span>
                        <span>₱${itemTotal.toFixed(2)}</span>
                        <button onclick="removeFromCart(${index})">Remove</button>
                    </div>
                `;
            });
            cartTotal.textContent = `₱${total.toFixed(2)}`;
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCart();
        }

        function toggleCart() {
            document.getElementById('cartModal').classList.toggle('active');
        }

        function showCheckout() {
            document.getElementById('checkoutModal').style.display = 'block';
        }

        document.getElementById('checkoutForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const order = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                address: document.getElementById('address').value,
                payment: document.getElementById('payment').value,
                cart
            };

            const response = await fetch('save_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(order)
            });

            if (response.ok) {
                alert('Order placed successfully!');
                cart = [];
                updateCart();
                document.getElementById('checkoutModal').style.display = 'none';
            } else {
                alert('Failed to place order.');
            }
        });
    </script>
</body>
</html>