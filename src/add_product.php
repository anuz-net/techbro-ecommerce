<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $rating = $_POST['rating'];
    $description = $_POST['description'] ?? '';
    $product_type = $_POST['product_type'] ?? 'Mobile';
    $service_provider = $_POST['service_provider'] ?? 'Unlocked';
    $cpu_model = $_POST['cpu_model'] ?? 'Snapdragon 8 Gen 3';
    $front_camera = $_POST['front_camera'] ?? '12 MP';
    $ram = $_POST['ram'] ?? '12 GB';
    $screen_size = $_POST['screen_size'] ?? '6.8"';
    $weight = $_POST['weight'] ?? '233g';
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $is_hot_deal = isset($_POST['is_hot_deal']) ? 1 : 0;
    $is_trusted_brand = isset($_POST['is_trusted_brand']) ? 1 : 0;
    $is_cheap_effective = isset($_POST['is_cheap_effective']) ? 1 : 0;
    $is_gift_product = isset($_POST['is_gift_product']) ? 1 : 0;
    $is_old_product = isset($_POST['is_old_product']) ? 1 : 0;
    $categories = $_POST['categories'] ?? [];
    
    $stmt = $pdo->prepare("INSERT INTO products (name, price, image, rating, description, product_type, service_provider, cpu_model, front_camera, ram, screen_size, weight, is_featured, is_hot_deal, is_trusted_brand, is_cheap_effective, is_gift_product, is_old_product) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $price, $image, $rating, $description, $product_type, $service_provider, $cpu_model, $front_camera, $ram, $screen_size, $weight, $is_featured, $is_hot_deal, $is_trusted_brand, $is_cheap_effective, $is_gift_product, $is_old_product])) {
        $product_id = $pdo->lastInsertId();
        
        // Add categories
        $stmt = $pdo->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
        foreach ($categories as $cat_id) {
            $stmt->execute([$product_id, $cat_id]);
        }
        
        header('Location: manage_all_products.php?success=Product added successfully');
        exit();
    } else {
        $error = "Failed to add product";
    }
}

// Get all categories
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Add New Product</title>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Add New Product</h1>
            <a href="manage_products.php" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Back</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="number" name="price" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating (1-5)</label>
                        <input type="number" name="rating" min="1" max="5" step="0.1" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
                    <input type="text" name="image" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500"></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Type</label>
                    <select name="product_type" id="productType" onchange="updateSpecFields()" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                        <option value="Mobile">Mobile</option>
                        <option value="PC">PC</option>
                        <option value="Camera">Camera</option>
                        <option value="Accessories">Accessories</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-3">Product Specifications</h3>
                    <div id="specFields" class="grid grid-cols-2 gap-4">
                        <!-- Mobile Specs -->
                        <div class="spec-mobile">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service Provider</label>
                            <input type="text" name="service_provider" value="Unlocked" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div class="spec-mobile spec-pc">
                            <label class="block text-sm font-medium text-gray-700 mb-2">CPU Model</label>
                            <input type="text" name="cpu_model" value="Snapdragon 8 Gen 3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div class="spec-mobile spec-camera">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Front Camera</label>
                            <input type="text" name="front_camera" value="12 MP" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div class="spec-mobile spec-pc">
                            <label class="block text-sm font-medium text-gray-700 mb-2">RAM</label>
                            <input type="text" name="ram" value="12 GB" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div class="spec-mobile spec-pc">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Screen Size</label>
                            <input type="text" name="screen_size" value="6.8&quot;" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div class="spec-mobile spec-camera spec-accessories">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Weight</label>
                            <input type="text" name="weight" value="233g" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories (Select Multiple)</label>
                    <div class="grid grid-cols-3 gap-2 p-3 border rounded">
                        <?php foreach ($categories as $cat): ?>
                            <label class="flex items-center">
                                <input type="checkbox" name="categories[]" value="<?php echo $cat['id']; ?>" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                <span class="ml-2 text-sm"><?php echo htmlspecialchars($cat['name']); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Tags</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-700">Featured Product</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_hot_deal" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-700">Hot Deal</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_trusted_brand" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-700">Trusted Brand</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_cheap_effective" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-700">Cheap But Effective</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_gift_product" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-700">Gift Product</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_old_product" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-700">Old Product</span>
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 font-semibold">
                    Add Product
                </button>
            </form>
        </div>
    </div>

    <script>
        function updateSpecFields() {
            const type = document.getElementById('productType').value.toLowerCase();
            const allSpecs = document.querySelectorAll('#specFields > div');
            
            allSpecs.forEach(spec => {
                if (spec.classList.contains('spec-' + type)) {
                    spec.style.display = 'block';
                } else {
                    spec.style.display = 'none';
                }
            });
        }
        
        updateSpecFields();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>