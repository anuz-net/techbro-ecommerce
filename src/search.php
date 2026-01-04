<?php
session_start();
require_once 'config.php';

$query = $_GET['q'] ?? '';
$products = [];

if ($query) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? ORDER BY created_at DESC");
    $searchTerm = "%$query%";
    $stmt->execute([$searchTerm, $searchTerm]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search: <?php echo htmlspecialchars($query); ?> - TechBro</title>
    <link rel="shortcut icon" href="Image/favico.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="dropdown-fix.css">
</head>
<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold mb-2">Search Results</h1>
            <p class="text-gray-600">Found <?php echo count($products); ?> results for "<?php echo htmlspecialchars($query); ?>"</p>
        </div>

        <?php if (empty($products)): ?>
            <div class="bg-white rounded-xl p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">No products found</h2>
                <p class="text-gray-600 mb-6">Try searching with different keywords</p>
                <a href="index.php" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">Back to Home</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4">
                        <a href="product.php?id=<?php echo $product['id']; ?>">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                            <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                        </a>
                        <div class="flex items-center mb-2">
                            <span class="text-2xl font-bold text-red-600">$<?php echo number_format($product['price'], 2); ?></span>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <svg class="w-4 h-4 <?php echo $i <= $product['rating'] ? 'fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <span class="ml-2 text-sm text-gray-600">(<?php echo $product['rating']; ?>)</span>
                        </div>
                        <button onclick="addToCart(<?php echo $product['id']; ?>)" class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition">
                            Add to Cart
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
