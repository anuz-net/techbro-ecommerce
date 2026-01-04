<?php
// Navigation component - included on all pages
?>
<!-- Red Top Bar -->
<div class="bg-red-600 text-white py-2 hidden md:block">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center text-sm">
            <div class="flex space-x-6">
                <a href="#" class="hover:text-red-200">About Us</a>
                <a href="#" class="hover:text-red-200">Frequently Asked Questions</a>
                <a href="#" class="hover:text-red-200">Privacy Policy</a>
            </div>
            <div class="flex space-x-6 items-center">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                    <span>Warranty</span>
                </div>
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <span>Pickup Location</span>
                </div>
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <span>Customer Service +97798000000000</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4">
    <nav class="bg-white w-full flex relative justify-between items-center mx-auto px-8 h-20 border-b border-gray-200">
        <div class="inline-flex">
            <a href="index.php">
                <div class="hidden md:block">
                    <img src="Image/logo.png" class="h-8 w-auto sm:h-10 md:h-12 lg:h-14" alt="Logo" />
                </div>
                <div class="block md:hidden">
                    <img src="Image/favico.png" class="h-8 w-auto sm:h-10 md:h-12 lg:h-14" alt="Logo" />
                </div>
            </a>
        </div>

        <div class="hidden sm:block flex-1 max-w-xl mx-8">
            <form action="search.php" method="GET" class="flex items-center">
                <input type="text" name="q" placeholder="Search for products..." required class="flex-1 px-6 py-2.5 border border-gray-300 rounded-l-full focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <button type="submit" class="flex items-center justify-center px-6 py-2.5 bg-red-600 hover:bg-red-700 rounded-r-full transition">
                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="3">
                        <path d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex-initial">
            <div class="flex justify-end items-center relative">
                <div class="flex mr-4 items-center">
                    <button onclick="openCartModal()" class="py-2 px-3 hover:bg-gray-200 rounded-full">
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                            <span class="flex items-center justify-center gap-2 font-medium relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span class="cart-count absolute -top-0.5 -left-[3px] bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-bold">0</span>
                                My Cart
                            </span>
                        </div>
                    </button>
                </div>

                <div class="block md:hidden">
                    <button onclick="toggleMobileMenu()" class="p-2 rounded-md hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <div class="hidden md:block dropdown-group">
                    <button class="flex items-center p-2 rounded-full hover:bg-gray-200">
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            $stmt = $pdo->prepare("SELECT avatar FROM users WHERE id = ?");
                            $stmt->execute([$_SESSION['user_id']]);
                            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($user_data && $user_data['avatar']) {
                                echo '<img src="' . htmlspecialchars($user_data['avatar']) . '" alt="Avatar" class="w-8 h-8 rounded-full object-cover">';
                            } else {
                                echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
                            }
                        } else {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
                        }
                        ?>
                    </button>
                    <div class="dropdown-menu absolute right-0 w-48 bg-white shadow-lg rounded-md mt-1 font-normal z-50">
                        <a href="profile.php" class="flex items-center px-4 py-2 hover:bg-gray-100 border-b">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            My Profile
                        </a>
                        <a href="orders.php" class="flex items-center px-4 py-2 hover:bg-gray-100 border-b">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            My Orders
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 border-b">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            Wishlist
                        </a>
                        <a href="logout.php" class="flex items-center px-4 py-2 hover:bg-gray-100 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <nav class="hidden md:block">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <div class="relative group">
                    <button class="flex items-center px-4 py-2 hover:bg-gray-200 rounded-md">
                        <span>All Categories</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute invisible opacity-0 group-hover:visible group-hover:opacity-100 w-48 bg-white shadow-lg rounded-md mt-0 font-normal z-50 transition-all duration-200">
                        <a href="category.php?filter=trusted-brands" class="block px-4 py-2 hover:bg-gray-100">Trusted Brands</a>
                        <a href="category.php?filter=cheap-effective" class="block px-4 py-2 hover:bg-gray-100">Cheap But Effective</a>
                        <a href="category.php?filter=gift-products" class="block px-4 py-2 hover:bg-gray-100">Gift Products</a>
                        <a href="category.php?filter=old-products" class="block px-4 py-2 hover:bg-gray-100">Old Products</a>
                    </div>
                </div>
                <div class="flex space-x-8 ml-8">
                    <a href="category.php?slug=mobile" class="hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-200">Mobiles</a>
                    <a href="category.php?slug=laptops" class="hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-200">Laptops</a>
                    <a href="category.php?slug=computers" class="hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-200">Computers</a>
                    <a href="category.php?slug=accessories" class="hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-200">Accessories</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<div id="mobileMenu" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>
    <div class="fixed right-0 top-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300" id="sideMenu">
        <div class="p-4 border-b">
            <div class="flex items-center justify-between">
                <img src="Image/logo.png" class="h-8" alt="Logo" />
                <button onclick="toggleMobileMenu()" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-4">
            <a href="profile.php" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                My Profile
            </a>
            <a href="orders.php" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                My Orders
            </a>
            <a href="category.php?slug=mobile" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
                Mobiles
            </a>
            <a href="category.php?slug=laptops" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                </svg>
                Laptops
            </a>
            <a href="category.php?slug=computers" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                </svg>
                Computers
            </a>
            <a href="category.php?slug=accessories" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313L16.5 7.5m0 2.25L14.25 8.438 12 9.75l-2.25-1.313L7.5 9.75l-2.25-1.313L3 7.5m6 4.125l2.25 1.313L13.5 11.25l2.25 1.313L18 11.25l2.25 1.313L22.5 11.25M12 18.75V21m-6-3v3m12-3v3" />
                </svg>
                Accessories
            </a>
        </div>
    </div>
</div>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const sideMenu = document.getElementById('sideMenu');
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        setTimeout(() => sideMenu.classList.remove('translate-x-full'), 10);
    } else {
        sideMenu.classList.add('translate-x-full');
        setTimeout(() => menu.classList.add('hidden'), 300);
    }
}

function updateCartCount() {
    fetch('get_cart_count.php')
        .then(response => response.json())
        .then(data => {
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) cartCount.textContent = data.count;
        })
        .catch(error => console.error('Error:', error));
}

updateCartCount();

function openCartModal() {
    const modal = document.getElementById('cartModal');
    const popup = document.getElementById('cartPopup');
    modal.classList.remove('hidden');
    setTimeout(() => {
        popup.classList.remove('scale-95', 'opacity-0');
        popup.classList.add('scale-100', 'opacity-100');
    }, 10);
    loadCartItems();
}

function closeCartModal() {
    const modal = document.getElementById('cartModal');
    const popup = document.getElementById('cartPopup');
    popup.classList.remove('scale-100', 'opacity-100');
    popup.classList.add('scale-95', 'opacity-0');
    setTimeout(() => modal.classList.add('hidden'), 300);
}

function loadCartItems() {
    fetch('get_cart_items.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('cartItems');
            if (data.items.length === 0) {
                container.innerHTML = '<div class="text-center py-8 text-gray-500">Your cart is empty</div>';
            } else {
                container.innerHTML = data.items.map(item => `
                    <div class="flex gap-4 mb-4 pb-4 border-b last:border-0">
                        <img src="${item.image}" alt="${item.name}" class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold">${item.name}</h3>
                            <p class="text-red-600 font-bold mt-1">$${parseFloat(item.price).toFixed(2)}</p>
                            <div class="flex items-center gap-3 mt-2">
                                <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})" class="w-8 h-8 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition">-</button>
                                <span class="font-semibold">${item.quantity}</span>
                                <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})" class="w-8 h-8 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition">+</button>
                                <button onclick="removeFromCart(${item.id})" class="ml-auto text-red-600 hover:text-red-700 font-medium">Remove</button>
                            </div>
                        </div>
                    </div>
                `).join('');
            }
            document.getElementById('cartTotal').textContent = '$' + parseFloat(data.total).toFixed(2);
        });
}

function updateQuantity(cartId, quantity) {
    if (quantity < 1) return;
    fetch('update_cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `cart_id=${cartId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadCartItems();
            updateCartCount();
        }
    });
}

function removeFromCart(cartId) {
    fetch('remove_from_cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `cart_id=${cartId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadCartItems();
            updateCartCount();
        }
    });
}
</script>

<!-- Cart Modal -->
<div id="cartModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black bg-opacity-30" onclick="closeCartModal()"></div>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform scale-95 opacity-0 transition-all duration-300 relative z-10" id="cartPopup">
        <div class="flex flex-col max-h-[80vh]">
            <div class="flex items-center justify-between p-6 border-b">
                <h2 class="text-2xl font-bold">My Cart</h2>
                <button onclick="closeCartModal()" class="p-2 hover:bg-gray-100 rounded-full transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="cartItems" class="flex-1 overflow-y-auto p-6"></div>
            <div class="border-t p-6">
                <div class="flex justify-between mb-4">
                    <span class="font-semibold text-lg">Total:</span>
                    <span id="cartTotal" class="font-bold text-2xl text-red-600">$0.00</span>
                </div>
                <button onclick="window.location.href='cart.php'" class="w-full bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</div>
