<?php
session_start();
require_once 'config.php';

$product_id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: index.php');
    exit();
}

// Get reviews
$stmt = $pdo->prepare("SELECT r.*, u.name as user_name FROM product_reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = ? ORDER BY r.created_at DESC");
$stmt->execute([$product_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get review count
$review_count = count($reviews);

// Calculate average rating
$avg_rating = $review_count > 0 ? array_sum(array_column($reviews, 'rating')) / $review_count : 0;

$brand = explode(' ', $product['name'])[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - TechBro</title>
    <link rel="shortcut icon" href="Image/favico.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="dropdown-fix.css">
</head>
<body class="font-sans bg-white" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <div class="bg-gray-50 py-4">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="flex text-sm">
                <a href="index.php" class="text-gray-600 hover:text-gray-900">Home</a>
                <span class="mx-2 text-gray-400">/</span>
                <a href="category.php?slug=mobile" class="text-gray-600 hover:text-gray-900">Products</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-gray-900"><?php echo htmlspecialchars($product['name']); ?></span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left: Image Section -->
            <div>
                <div class="bg-gray-50 rounded-2xl p-8 shadow-sm relative">
                    <?php if ($product['is_trusted_brand']): ?>
                        <div class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-md">GENUINE</div>
                    <?php endif; ?>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-96 object-contain">
                </div>
                <div class="flex gap-3 mt-4 overflow-x-auto">
                    <div class="bg-gray-100 rounded-xl p-3 min-w-[80px] cursor-pointer border-2 border-blue-600">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Thumbnail" class="w-full h-16 object-contain">
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3 min-w-[80px] cursor-pointer hover:border-2 hover:border-gray-300">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Thumbnail" class="w-full h-16 object-contain">
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3 min-w-[80px] cursor-pointer hover:border-2 hover:border-gray-300">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Thumbnail" class="w-full h-16 object-contain">
                    </div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div>
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2"><?php echo strtoupper($brand); ?></div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"><?php echo htmlspecialchars($product['name']); ?></h1>
                
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <svg class="w-5 h-5 <?php echo $i <= $avg_rating ? 'text-yellow-400 fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="text-sm text-gray-600"><?php echo $review_count > 0 ? number_format($avg_rating, 1) . " ($review_count reviews)" : 'No ratings yet'; ?></span>
                </div>

                <div class="mb-6">
                    <div class="text-sm text-gray-600 mb-2">Color</div>
                    <div class="flex gap-3">
                        <button class="w-10 h-10 rounded-full bg-purple-600 border-2 border-gray-900 shadow-md"></button>
                        <button class="w-10 h-10 rounded-full bg-green-600 border-2 border-gray-300 hover:border-gray-400 shadow-md"></button>
                        <button class="w-10 h-10 rounded-full bg-black border-2 border-gray-300 hover:border-gray-400 shadow-md"></button>
                        <button class="w-10 h-10 rounded-full bg-yellow-400 border-2 border-gray-300 hover:border-gray-400 shadow-md"></button>
                        <button class="w-10 h-10 rounded-full bg-gray-400 border-2 border-gray-300 hover:border-gray-400 shadow-md"></button>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="text-4xl font-bold text-gray-900 mb-2">$<?php echo number_format($product['price'], 2); ?></div>
                    <div class="text-sm text-gray-600">or $<?php echo number_format($product['price'] / 12, 2); ?>/month for 12 months</div>
                </div>

                <button onclick="addToCart(<?php echo $product['id']; ?>)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-xl text-lg mb-4 transition">
                    Add to Cart
                </button>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                            <span class="font-semibold text-sm">Free Shipping</span>
                        </div>
                        <div class="text-xs text-gray-600">Delivery in 2-3 days</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="font-semibold text-sm">Pickup Available</span>
                        </div>
                        <div class="text-xs text-gray-600">Ready in 1 hour</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Specifications -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Specifications</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <?php 
                $type = $product['product_type'] ?? 'Mobile';
                
                // Mobile specs
                if ($type == 'Mobile'): ?>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Service Provider</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['service_provider'] ?? 'Unlocked'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">CPU Model</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['cpu_model'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Front Camera</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['front_camera'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">RAM</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['ram'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Screen Size</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['screen_size'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Weight</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['weight'] ?? 'N/A'); ?></div>
                    </div>
                <?php endif; ?>
                
                <?php // PC specs
                if ($type == 'PC'): ?>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">CPU Model</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['cpu_model'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">RAM</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['ram'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Screen Size</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['screen_size'] ?? 'N/A'); ?></div>
                    </div>
                <?php endif; ?>
                
                <?php // Camera specs
                if ($type == 'Camera'): ?>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Front Camera</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['front_camera'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Weight</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['weight'] ?? 'N/A'); ?></div>
                    </div>
                <?php endif; ?>
                
                <?php // Accessories specs
                if ($type == 'Accessories'): ?>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="text-gray-500 text-sm mb-2">Weight</div>
                        <div class="font-semibold"><?php echo htmlspecialchars($product['weight'] ?? 'N/A'); ?></div>
                    </div>
                <?php endif; ?>
            </div>
            <a href="#" class="inline-block mt-6 text-blue-600 hover:text-blue-700 font-semibold">View all specifications →</a>
        </div>

        <!-- Reviews Section -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Customer Reviews</h2>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <h3 class="text-lg font-semibold mb-4">Write a Review</h3>
                    <form id="reviewForm" class="space-y-4">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                            <div class="flex gap-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <button type="button" onclick="setRating(<?php echo $i; ?>)" class="rating-star text-gray-300 hover:text-yellow-400 transition">
                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                            <textarea name="comment" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition">Submit Review</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="bg-gray-50 rounded-xl p-6 mb-8 text-center">
                    <p class="text-gray-600">Please <a href="login.php" class="text-blue-600 hover:text-blue-700 font-semibold">login</a> to write a review</p>
                </div>
            <?php endif; ?>

            <div class="space-y-6">
                <?php if (empty($reviews)): ?>
                    <div class="bg-gray-50 rounded-xl p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        <p class="text-gray-500 text-lg">No reviews yet</p>
                        <p class="text-gray-400 text-sm mt-2">Be the first to review this product</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <div class="font-semibold text-gray-900"><?php echo htmlspecialchars($review['user_name']); ?></div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="flex">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <svg class="w-4 h-4 <?php echo $i <= $review['rating'] ? 'text-yellow-400 fill-current' : 'text-gray-300'; ?>" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="text-sm text-gray-500"><?php echo date('M d, Y', strtotime($review['created_at'])); ?></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700"><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-12 mt-16">
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
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Categories</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="category.php?slug=mobile" class="text-gray-400 hover:text-white">Mobile</a></li>
                        <li><a href="category.php?slug=laptops" class="text-gray-400 hover:text-white">Laptops</a></li>
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
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 TechBro. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div id="notification" style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transform: translateX(400px); transition: transform 0.3s; z-index: 9999;">
        ✓ Added to cart successfully!
    </div>

    <script>
        let selectedRating = 0;

        function setRating(rating) {
            selectedRating = rating;
            document.getElementById('ratingInput').value = rating;
            document.querySelectorAll('.rating-star').forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        document.getElementById('reviewForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (selectedRating === 0) {
                alert('Please select a rating');
                return;
            }

            const formData = new FormData(this);
            
            fetch('api/submit_review.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Review submitted successfully!');
                    location.reload();
                } else {
                    alert(data.error || 'Failed to submit review');
                }
            })
            .catch(error => {
                alert('Error submitting review');
            });
        });

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
