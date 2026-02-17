<?php
session_start();
require_once 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="./output.css" rel="stylesheet" />
    <link rel="shortcut icon" href="Image/favico.png" type="image/x-icon" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="dropdown-fix.css" />
</head>

<body class="font-sans flex flex-col min-h-screen" style="font-family: 'Inter', sans-serif;">
    <div id="mainContent" class="transition-all duration-300 flex-grow">
        <!-- Red Top Bar -->
        <div class="bg-red-600 text-white py-2 hidden md:block">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center text-sm">
                    <!-- Left Side Links -->
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-red-200">About Us</a>
                        <a href="#" class="hover:text-red-200">Frequently Asked Questions</a>
                        <a href="#" class="hover:text-red-200">Privacy Policy</a>
                    </div>

                    <!-- Right Side Services -->
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
            <div class="top-main font-bold ">
                <!-- navbar  -->

                <!-- component -->
                <nav
                    class="bg-white w-full flex relative justify-between items-center mx-auto px-8 h-20 border-b border-gray-200">
                    <!-- logo -->
                    <div class="inline-flex">
                        <a class="_o6689fn" href="/">
                            <div class="hidden md:block">
                                <img src="Image/logo.png" class="h-8 w-auto sm:h-10 md:h-12 lg:h-14" alt="Logo" />
                            </div>
                            <div class="block md:hidden">
                                <img src="Image/favico.png" class="h-8 w-auto sm:h-10 md:h-12 lg:h-14" alt="Logo" />
                            </div>
                        </a>
                    </div>

                    <!-- end logo -->

                    <!-- search bar -->
                    <div class="hidden sm:block flex-1 max-w-xl mx-8">
                        <form action="search.php" method="GET" class="flex items-center gap-3">
                            <input type="text" name="q" placeholder="Search for products..." required class="flex-1 px-6 py-2.5 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <button type="submit" class="flex items-center justify-center w-11 h-11 bg-red-600 hover:bg-red-700 rounded-full transition">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="3">
                                    <path d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <!-- end search bar -->

                    <!-- login -->
                    <div class="flex-initial">
                        <div class="flex justify-end items-center relative">
                            <div class="flex mr-4 items-center">
                                <button onclick="openCartModal()" class="py-2 px-3 hover:bg-gray-200 rounded-full">
                                    <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                        <span class=" flex items-center justify-center gap-2 font-medium relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                            <span
                                                class="cart-count absolute -top-0.5 -left-[3px]  bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-bold">0</span>
                                            My Cart</span>
                                    </div>
                                </button>
                            </div>

                            <!-- Mobile Hamburger -->
                            <div class="block md:hidden">
                                <button onclick="toggleMobileMenu()" class="p-2 rounded-md hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Desktop Profile Dropdown -->
                            <div class="hidden md:block dropdown-group">
                                <button class="flex items-center p-2 rounded-full hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>

                                <!-- Profile Dropdown Menu -->
                                <div
                                    class="dropdown-menu absolute right-0 w-48 bg-white shadow-lg rounded-md mt-1 font-normal z-50">
                                    <a href="profile.php" class="flex items-center px-4 py-2 hover:bg-gray-100 border-b">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        My Profile
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 border-b">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        My Orders
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 border-b">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                        Wishlist
                                    </a>
                                    <a href="logout.php" class="flex items-center px-4 py-2 hover:bg-gray-100 text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                        </svg>
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- end login -->
            </nav>

            <!-- submenu navigation -->
            <nav class="hidden md:block">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex items-center justify-between h-20">
                        <!-- Categories Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center px-4 py-2 hover:bg-gray-200 rounded-md">
                                <span>All Categories</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>

                            <div class="absolute invisible opacity-0 group-hover:visible group-hover:opacity-100 w-48 bg-white shadow-lg rounded-md mt-0 font-normal z-50 transition-all duration-200">
                                <a href="category.php?filter=trusted-brands" class="block px-4 py-2 hover:bg-gray-100">Trusted Brands</a>
                                <a href="category.php?filter=cheap-effective" class="block px-4 py-2 hover:bg-gray-100">Cheap But Effective</a>
                                <a href="category.php?filter=gift-products" class="block px-4 py-2 hover:bg-gray-100">Gift Products</a>
                                <a href="category.php?filter=old-products" class="block px-4 py-2 hover:bg-gray-100">Old Products</a>
                            </div>
                        </div>

                        <!-- Regular menu items -->
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
    </div>
    </div>

    <!-- Mobile Side Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>
        <div class="fixed right-0 top-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300"
            id="sideMenu">
            <div class="p-4 border-b">
                <div class="flex items-center justify-between">
                    <img src="Image/logo.png" class="h-8" alt="Logo" />
                    <button onclick="toggleMobileMenu()" class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <a href="profile.php" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    My Profile
                </a>
                <a href="cart.php" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    My Cart
                </a>
                <a href="category.php?slug=mobile" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                    Mobiles
                </a>
                <a href="category.php?slug=laptops" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                    Laptops
                </a>
                <a href="category.php?slug=computers" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                    Computers
                </a>
                <a href="category.php?slug=accessories" class="flex items-center py-3 px-2 hover:bg-gray-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 7.5l-2.25-1.313L16.5 7.5m0 2.25L14.25 8.438 12 9.75l-2.25-1.313L7.5 9.75l-2.25-1.313L3 7.5m6 4.125l2.25 1.313L13.5 11.25l2.25 1.313L18 11.25l2.25 1.313L22.5 11.25M12 18.75V21m-6-3v3m12-3v3" />
                    </svg>
                    Accessories
                </a>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-sec">

        <div class="max-w-7xl mx-auto px-4 py-8">
            <!-- Hero Banner -->
            <div class="bg-gradient-to-r from-red-600 to-red-800 rounded-lg p-8 md:p-12 text-white mb-8">
                <div class="max-w-2xl">
                    <h1 class="text-3xl md:text-5xl font-bold mb-4">Latest Tech Deals</h1>
                    <p class="text-lg md:text-xl mb-6 opacity-90">Discover amazing discounts on smartphones, laptops, and accessories</p>
                    <button class="bg-white text-red-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Shop Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Featured Categories -->
        <!-- Featured Categories Grid -->
        <div class="max-w-7xl mx-auto px-4 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Category 1 -->
                <div class="relative overflow-hidden rounded-lg group">
                    <img src="Image/Lapto.png" alt="Category 1" class="w-full h-100 object-cover transition duration-300 group-hover:scale-110">
                </div>

                <!-- Category 2 -->
                <div class="relative overflow-hidden rounded-lg group">
                    <img src="Image/gamingpc.png" alt="Category 2" class="w-full h-100 object-cover transition duration-300 group-hover:scale-110">
                </div>

                <!-- Category 3 -->
                <div class="relative overflow-hidden rounded-lg group">
                    <img src="Image/mubail.png" alt="Category 3" class="w-full h-100 object-cover transition duration-300 group-hover:scale-110">

                </div>
            </div>
        </div>
    </div>

    <!-- Shop By Category Section -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">Shop By Category</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Smartphones -->
            <a href="category.php?slug=smartphones" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                <div class="p-3 bg-blue-100 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-800">Smartphones</span>
            </a>

            <!-- Laptops -->
            <a href="category.php?slug=laptops" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                <div class="p-3 bg-green-100 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-800">Laptops</span>
            </a>

            <!-- Gaming PCs -->
            <a href="category.php?slug=gaming-pcs" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                <div class="p-3 bg-purple-100 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-purple-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-800">Gaming PCs</span>
            </a>

            <!-- Audio -->
            <a href="category.php?slug=audio" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                <div class="p-3 bg-red-100 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-800">Audio</span>
            </a>

            <!-- Cameras -->
            <a href="category.php?slug=cameras" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                <div class="p-3 bg-orange-100 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-orange-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-800">Cameras</span>
            </a>

            <!-- Smart Home -->
            <a href="category.php?slug=smart-home" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                <div class="p-3 bg-indigo-100 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-800">Smart Home</span>
            </a>
        </div>
    </div>
    <!-- Iamge Banner  -->
    <div class="max-w-7xl mx-auto my-10 ">
        <img src="Image/banner1.png" class="rounded-lg border" alt="">
    </div>

    <!-- Hot Deals Section -->
    <div class="bg-gradient-to-r from-orange-50 to-red-50 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-orange-600">🔥 Hot Deals</h2>

            <div class="products-slider-container">
                <div class="products-slider-content">
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM products WHERE is_hot_deal = 1 ORDER BY created_at DESC LIMIT 8");
                    $stmt->execute();
                    $hot_deals = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($hot_deals as $product):
                    ?>
                        <div class="product-card bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4 border-2 border-orange-200">
                            <a href="product.php?id=<?php echo $product['id']; ?>">
                                <div class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-bold">HOT</div>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                                <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                            </a>

                            <div class="flex items-center mb-2">
                                <span class="text-2xl font-bold text-orange-600"><?php echo formatPrice($product['price']); ?></span>
                            </div>

                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <svg class="w-4 h-4 <?php echo $i <= $product['rating'] ? 'fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">(<?php echo $product['rating']; ?>)</span>
                            </div>

                            <button onclick="addToCart(<?php echo $product['id']; ?>)" class="w-full bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    <?php endforeach; ?>

                    <!-- Duplicate set for seamless loop -->
                    <?php for ($j = 0; $j < 1; $j++): ?>
                        <?php foreach ($hot_deals as $product): ?>
                            <div class="product-card bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4 border-2 border-orange-200">
                                <div class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-bold">HOT</div>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-48 object-cover rounded-lg mb-4">

                                <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>

                                <div class="flex items-center mb-2">
                                    <span class="text-2xl font-bold text-orange-600">$<?php echo number_format($product['price'], 2); ?></span>
                                </div>

                                <div class="flex items-center mb-4">
                                    <div class="flex text-yellow-400">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <svg class="w-4 h-4 <?php echo $i <= $product['rating'] ? 'fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">(<?php echo $product['rating']; ?>)</span>
                                </div>

                                <button onclick="addToCart(<?php echo $product['id']; ?>)" class="w-full bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Featured Products</h2>

            <div class="products-slider-container">
                <div class="products-slider-content">
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM products WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 8");
                    $stmt->execute();
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product):
                    ?>
                        <div class="product-card bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4">
                            <a href="product.php?id=<?php echo $product['id']; ?>">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                                <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                            </a>

                            <div class="flex items-center mb-2">
                                <span class="text-2xl font-bold text-red-600"><?php echo formatPrice($product['price']); ?></span>
                            </div>

                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <svg class="w-4 h-4 <?php echo $i <= $product['rating'] ? 'fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">(<?php echo $product['rating']; ?>)</span>
                            </div>

                            <button onclick="addToCart(<?php echo $product['id']; ?>)" class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    <?php endforeach; ?>

                    <!-- Duplicate set for seamless loop -->
                    <?php for ($j = 0; $j < 1; $j++): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="product-card bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-48 object-cover rounded-lg mb-4">

                                <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>

                                <div class="flex items-center mb-2">
                                    <span class="text-2xl font-bold text-red-600">$<?php echo number_format($product['price'], 2); ?></span>
                                </div>

                                <div class="flex items-center mb-4">
                                    <div class="flex text-yellow-400">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <svg class="w-4 h-4 <?php echo $i <= $product['rating'] ? 'fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">(<?php echo $product['rating']; ?>)</span>
                                </div>

                                <button onclick="addToCart(<?php echo $product['id']; ?>)" class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>






        <style>
            .products-slider-container {
                width: 100%;
                overflow: hidden;
            }

            .products-slider-content {
                display: flex;
                animation: carousel-scroll 40s linear infinite;
                width: max-content;
                gap: 1.5rem;
            }

            .product-card {
                min-width: 280px;
                flex-shrink: 0;
                position: relative;
            }

            @keyframes carousel-scroll {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-50%);
                }
            }

            .products-slider-content:hover {
                animation-play-state: paused;
            }
        </style>

        <!-- Notification Toast -->
        <div id="notification" style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transform: translateX(400px); transition: transform 0.3s; z-index: 9999;">
            ✓ Added to cart successfully!
        </div>

        <script>
            function showNotification() {
                const notification = document.getElementById('notification');
                notification.style.transform = 'translateX(0)';
                setTimeout(() => {
                    notification.style.transform = 'translateX(400px)';
                }, 3000);
            }

            function addToCart(productId) {
                fetch('api/add_to_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'product_id=' + productId
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response:', data);
                        if (data.success) {
                            showNotification();
                            updateCartCount();
                        } else if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            alert('Failed: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error adding to cart');
                    });
            }

            function updateCartCount() {
                fetch('get_cart_count.php')
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('.cart-count').textContent = data.count;
                    });
            }

            // Update cart count on page load
            updateCartCount();

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
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
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
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
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

        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="script.js"></script>
        <div class="max-w-7xl mx-auto my-10 ">
            <img src="Image/banner1.png" class="rounded-lg border" alt="">
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- About -->
                    <div>
                        <img src="Image/logo.png" class="h-10 mb-4 brightness-0 invert" alt="Logo">
                        <p class="text-gray-400 text-sm">Your ultimate tech shopping destination for the latest gadgets and electronics.</p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Terms & Conditions</a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div>
                        <h3 class="font-semibold mb-4">Categories</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="category.php?slug=smartphones" class="text-gray-400 hover:text-white">Smartphones</a></li>
                            <li><a href="category.php?slug=laptops" class="text-gray-400 hover:text-white">Laptops</a></li>
                            <li><a href="category.php?slug=gaming-pcs" class="text-gray-400 hover:text-white">Gaming</a></li>
                            <li><a href="category.php?slug=accessories" class="text-gray-400 hover:text-white">Accessories</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h3 class="font-semibold mb-4">Contact Us</h3>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li>Email: info@techbro.com</li>
                            <li>Phone: +977 9800000000</li>
                            <li>Address: Kathmandu, Nepal</li>
                        </ul>
                        <div class="flex space-x-4 mt-4">
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                    <p>&copy; 2024 TechBro. All rights reserved.</p>
                </div>
            </div>
        </footer>
</body>

</html>