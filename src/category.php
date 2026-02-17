<?php
session_start();
require_once 'config.php';

$category_slug = $_GET['slug'] ?? '';
$special_filter = $_GET['filter'] ?? '';

// Get category info
if ($category_slug) {
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
    $stmt->execute([$category_slug]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($category) {
        // Get products for this category
        $stmt = $pdo->prepare("
            SELECT DISTINCT p.* FROM products p
            INNER JOIN product_categories pc ON p.id = pc.product_id
            WHERE pc.category_id = ?
            ORDER BY p.is_featured DESC, p.created_at DESC
        ");
        $stmt->execute([$category['id']]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $page_title = $category['name'];
    }
} elseif ($special_filter) {
    // Handle special filters
    $filters = [
        'trusted-brands' => ['is_trusted_brand = 1', 'Trusted Brands'],
        'cheap-effective' => ['is_cheap_effective = 1', 'Cheap But Effective'],
        'gift-products' => ['is_gift_product = 1', 'Gift Products'],
        'old-products' => ['is_old_product = 1', 'Old Products']
    ];
    
    if (isset($filters[$special_filter])) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE {$filters[$special_filter][0]} ORDER BY created_at DESC");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $page_title = $filters[$special_filter][1];
    }
}

if (!isset($products)) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - TechBro</title>
    <link rel="shortcut icon" href="Image/favico.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="dropdown-fix.css">
</head>
<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <!-- Page Header -->
    <div class="bg-white border-b py-6">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="index.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2"><?php echo htmlspecialchars($page_title); ?></span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-bold mt-4"><?php echo htmlspecialchars($page_title); ?></h1>
            <p class="mt-2 text-gray-600"><?php echo count($products); ?> products found</p>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <?php if (empty($products)): ?>
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="mt-4 text-xl font-semibold text-gray-700">No products found</h3>
                <p class="mt-2 text-gray-500">Check back later for new products</p>
                <a href="index.php" class="mt-6 inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">Back to Home</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition duration-300 overflow-hidden">
                        <a href="product.php?id=<?php echo $product['id']; ?>">
                            <div class="relative">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-64 object-cover">
                                <?php if ($product['is_featured']): ?>
                                    <span class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded">Featured</span>
                                <?php endif; ?>
                                <?php if ($product['is_hot_deal']): ?>
                                    <span class="absolute top-2 right-2 bg-orange-500 text-white text-xs px-2 py-1 rounded">🔥 Hot</span>
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2"><?php echo htmlspecialchars($product['description']); ?></p>
                            <div class="flex items-center mb-3">
                                <div class="flex">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <svg class="w-4 h-4 <?php echo $i <= $product['rating'] ? 'text-yellow-400 fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">(<?php echo $product['rating']; ?>)</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-red-600"><?php echo formatPrice($product['price']); ?></span>
                            </div>
                            <button onclick="addToCart(<?php echo $product['id']; ?>)" class="mt-3 w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <img src="Image/logo.png" class="h-10 mb-4 brightness-0 invert" alt="Logo">
                    <p class="text-gray-400 text-sm">Your ultimate tech shopping destination</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="index.php" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="category.php?filter=trusted-brands" class="text-gray-400 hover:text-white">Trusted Brands</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Categories</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="category.php?slug=mobile" class="text-gray-400 hover:text-white">Mobile</a></li>
                        <li><a href="category.php?slug=laptops" class="text-gray-400 hover:text-white">Laptops</a></li>
                        <li><a href="category.php?slug=computers" class="text-gray-400 hover:text-white">Computers</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Email: info@techbro.com</li>
                        <li>Phone: +977 9800000000</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

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
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'product_id=' + productId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification();
                    updateCartCount();
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
