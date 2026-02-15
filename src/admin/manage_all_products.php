<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

require_once '../config.php';

// Handle product update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];
    $product_type = $_POST['product_type'] ?? 'Mobile';
    $service_provider = $_POST['service_provider'] ?? '';
    $cpu_model = $_POST['cpu_model'] ?? '';
    $front_camera = $_POST['front_camera'] ?? '';
    $ram = $_POST['ram'] ?? '';
    $screen_size = $_POST['screen_size'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $is_hot_deal = isset($_POST['is_hot_deal']) ? 1 : 0;
    $is_trusted_brand = isset($_POST['is_trusted_brand']) ? 1 : 0;
    $is_cheap_effective = isset($_POST['is_cheap_effective']) ? 1 : 0;
    $is_gift_product = isset($_POST['is_gift_product']) ? 1 : 0;
    $is_old_product = isset($_POST['is_old_product']) ? 1 : 0;
    $categories = $_POST['categories'] ?? [];
    
    $stmt = $pdo->prepare("UPDATE products SET name=?, price=?, image=?, rating=?, description=?, product_type=?, service_provider=?, cpu_model=?, front_camera=?, ram=?, screen_size=?, weight=?, is_featured=?, is_hot_deal=?, is_trusted_brand=?, is_cheap_effective=?, is_gift_product=?, is_old_product=? WHERE id=?");
    $stmt->execute([$name, $price, $image, $rating, $description, $product_type, $service_provider, $cpu_model, $front_camera, $ram, $screen_size, $weight, $is_featured, $is_hot_deal, $is_trusted_brand, $is_cheap_effective, $is_gift_product, $is_old_product, $id]);
    
    // Update categories
    $pdo->prepare("DELETE FROM product_categories WHERE product_id=?")->execute([$id]);
    $stmt = $pdo->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
    foreach ($categories as $cat_id) {
        $stmt->execute([$id, $cat_id]);
    }
    
    $success = "Product updated successfully!";
}

// Handle delete
if (isset($_POST['delete_product'])) {
    $pdo->prepare("DELETE FROM products WHERE id=?")->execute([$_POST['product_id']]);
    $success = "Product deleted successfully!";
}

// Get all products with categories
$stmt = $pdo->query("SELECT p.*, GROUP_CONCAT(c.name SEPARATOR ', ') as category_names 
                     FROM products p 
                     LEFT JOIN product_categories pc ON p.id = pc.product_id 
                     LEFT JOIN categories c ON pc.category_id = c.id 
                     GROUP BY p.id 
                     ORDER BY p.created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get all categories
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet">
    <title>Manage All Products</title>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Manage All Products</h1>
            <div class="flex space-x-2">
                <a href="add_product.php" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Add Product</a>
                <a href="admin.php" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Back to Admin</a>
            </div>
        </div>
        
        <?php if (isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categories</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tags</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <img class="h-12 w-12 rounded object-cover" src="<?php echo htmlspecialchars($product['image']); ?>" alt="">
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($product['name']); ?></div>
                                        <div class="text-xs text-gray-500">Rating: <?php echo $product['rating']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-900">$<?php echo number_format($product['price'], 2); ?></td>
                            <td class="px-4 py-4 text-sm text-gray-600"><?php echo $product['category_names'] ?: 'None'; ?></td>
                            <td class="px-4 py-4">
                                <div class="flex flex-wrap gap-1">
                                    <?php if ($product['is_featured']): ?><span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">Featured</span><?php endif; ?>
                                    <?php if ($product['is_hot_deal']): ?><span class="px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded">Hot Deal</span><?php endif; ?>
                                    <?php if ($product['is_trusted_brand']): ?><span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Trusted</span><?php endif; ?>
                                    <?php if ($product['is_cheap_effective']): ?><span class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded">Cheap</span><?php endif; ?>
                                    <?php if ($product['is_gift_product']): ?><span class="px-2 py-1 text-xs bg-pink-100 text-pink-800 rounded">Gift</span><?php endif; ?>
                                    <?php if ($product['is_old_product']): ?><span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded">Old</span><?php endif; ?>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm">
                                <button onclick="editProduct(<?php echo $product['id']; ?>)" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                <form method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" name="delete_product" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
                <form method="POST" id="editForm">
                    <input type="hidden" name="product_id" id="edit_id">
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Product Name</label>
                            <input type="text" name="name" id="edit_name" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Price</label>
                            <input type="number" name="price" id="edit_price" step="0.01" required class="w-full px-3 py-2 border rounded">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Image URL</label>
                        <input type="text" name="image" id="edit_image" required class="w-full px-3 py-2 border rounded">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Rating (1-5)</label>
                            <input type="number" name="rating" id="edit_rating" min="1" max="5" step="0.1" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Product Type</label>
                            <select name="product_type" id="edit_product_type" onchange="updateEditSpecFields()" class="w-full px-3 py-2 border rounded">
                                <option value="Mobile">Mobile</option>
                                <option value="PC">PC</option>
                                <option value="Camera">Camera</option>
                                <option value="Accessories">Accessories</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <input type="text" name="description" id="edit_description" class="w-full px-3 py-2 border rounded">
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-sm font-medium mb-2">Specifications</h3>
                        <div id="editSpecFields" class="grid grid-cols-2 gap-4">
                            <div class="spec-mobile">
                                <label class="block text-xs mb-1">Service Provider</label>
                                <input type="text" name="service_provider" id="edit_service_provider" class="w-full px-3 py-2 border rounded text-sm">
                            </div>
                            <div class="spec-mobile spec-pc">
                                <label class="block text-xs mb-1">CPU Model</label>
                                <input type="text" name="cpu_model" id="edit_cpu_model" class="w-full px-3 py-2 border rounded text-sm">
                            </div>
                            <div class="spec-mobile spec-camera">
                                <label class="block text-xs mb-1">Front Camera</label>
                                <input type="text" name="front_camera" id="edit_front_camera" class="w-full px-3 py-2 border rounded text-sm">
                            </div>
                            <div class="spec-mobile spec-pc">
                                <label class="block text-xs mb-1">RAM</label>
                                <input type="text" name="ram" id="edit_ram" class="w-full px-3 py-2 border rounded text-sm">
                            </div>
                            <div class="spec-mobile spec-pc">
                                <label class="block text-xs mb-1">Screen Size</label>
                                <input type="text" name="screen_size" id="edit_screen_size" class="w-full px-3 py-2 border rounded text-sm">
                            </div>
                            <div class="spec-mobile spec-camera spec-accessories">
                                <label class="block text-xs mb-1">Weight</label>
                                <input type="text" name="weight" id="edit_weight" class="w-full px-3 py-2 border rounded text-sm">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Categories (Select Multiple)</label>
                        <div class="grid grid-cols-3 gap-2">
                            <?php foreach ($categories as $cat): ?>
                                <label class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="<?php echo $cat['id']; ?>" class="category-checkbox mr-2">
                                    <span class="text-sm"><?php echo $cat['name']; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Special Tags</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_featured" id="edit_featured" class="mr-2">
                                <span class="text-sm">Featured</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_hot_deal" id="edit_hot" class="mr-2">
                                <span class="text-sm">Hot Deal</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_trusted_brand" id="edit_trusted" class="mr-2">
                                <span class="text-sm">Trusted Brand</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_cheap_effective" id="edit_cheap" class="mr-2">
                                <span class="text-sm">Cheap But Effective</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_gift_product" id="edit_gift" class="mr-2">
                                <span class="text-sm">Gift Product</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_old_product" id="edit_old" class="mr-2">
                                <span class="text-sm">Old Product</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" name="update_product" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        const products = <?php echo json_encode($products); ?>;
        
        function editProduct(id) {
            const product = products.find(p => p.id == id);
            if (!product) return;
            
            document.getElementById('edit_id').value = product.id;
            document.getElementById('edit_name').value = product.name;
            document.getElementById('edit_price').value = product.price;
            document.getElementById('edit_image').value = product.image;
            document.getElementById('edit_rating').value = product.rating;
            document.getElementById('edit_description').value = product.description || '';
            document.getElementById('edit_product_type').value = product.product_type || 'Mobile';
            document.getElementById('edit_service_provider').value = product.service_provider || '';
            document.getElementById('edit_cpu_model').value = product.cpu_model || '';
            document.getElementById('edit_front_camera').value = product.front_camera || '';
            document.getElementById('edit_ram').value = product.ram || '';
            document.getElementById('edit_screen_size').value = product.screen_size || '';
            document.getElementById('edit_weight').value = product.weight || '';
            document.getElementById('edit_featured').checked = product.is_featured == 1;
            document.getElementById('edit_hot').checked = product.is_hot_deal == 1;
            document.getElementById('edit_trusted').checked = product.is_trusted_brand == 1;
            document.getElementById('edit_cheap').checked = product.is_cheap_effective == 1;
            document.getElementById('edit_gift').checked = product.is_gift_product == 1;
            document.getElementById('edit_old').checked = product.is_old_product == 1;
            
            // Load categories
            fetch(`get_product_categories.php?id=${id}`)
                .then(r => r.json())
                .then(cats => {
                    document.querySelectorAll('.category-checkbox').forEach(cb => {
                        cb.checked = cats.includes(parseInt(cb.value));
                    });
                    updateEditSpecFields();
                });
            
            document.getElementById('editModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
        
        function updateEditSpecFields() {
            const type = document.getElementById('edit_product_type').value.toLowerCase();
            const allSpecs = document.querySelectorAll('#editSpecFields > div');
            
            allSpecs.forEach(spec => {
                if (spec.classList.contains('spec-' + type)) {
                    spec.style.display = 'block';
                } else {
                    spec.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
