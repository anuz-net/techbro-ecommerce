<?php
session_start();
require_once 'config.php';
require_once 'currency.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$transaction_uuid = $_GET['order'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM orders WHERE transaction_uuid = ? AND user_id = ?");
$stmt->execute([$transaction_uuid, $_SESSION['user_id']]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    header('Location: index.php');
    exit();
}

// Get order items
$stmt = $pdo->prepare("
    SELECT oi.*, p.name, p.image 
    FROM order_items oi 
    JOIN products p ON oi.product_id = p.id 
    WHERE oi.order_id = ?
");
$stmt->execute([$order['id']]);
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - TechBro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
    <link rel="shortcut icon" href="Image/favico.png" type="image/x-icon">
    <style>
        @keyframes checkmark {
            0% { stroke-dashoffset: 100; }
            100% { stroke-dashoffset: 0; }
        }
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
        .checkmark-circle { animation: scaleIn 0.5s ease-out; }
        .checkmark-check { stroke-dasharray: 100; animation: checkmark 0.6s 0.3s ease-out forwards; }
    </style>
</head>
<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-12 text-center text-white">
                <div class="mb-6">
                    <svg class="w-24 h-24 mx-auto checkmark-circle" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="white"/>
                        <path class="checkmark-check" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" d="M14 27l7 7 16-16"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold mb-3">Payment Successful!</h1>
                <p class="text-green-50 text-lg">Your order has been confirmed</p>
            </div>

            <!-- Order Details -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Order ID</div>
                        <div class="text-xl font-bold text-gray-900">#<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Payment Method</div>
                        <div class="text-xl font-bold text-gray-900">eSewa</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Order Date</div>
                        <div class="text-xl font-bold text-gray-900"><?php echo date('M d, Y', strtotime($order['created_at'])); ?></div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        Order Items
                    </h2>
                    <div class="space-y-4">
                        <?php foreach ($order_items as $item): ?>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900"><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <p class="text-sm text-gray-600">Quantity: <?php echo $item['quantity']; ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-red-600"><?php echo formatPrice($item['price'] * $item['quantity']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Total -->
                <div class="border-t-2 border-gray-200 pt-6 mb-8">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold text-gray-700">Total Amount Paid</span>
                        <span class="text-3xl font-bold text-green-600"><?php echo formatPrice($order['total']); ?></span>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-blue-900 mb-2">What's Next?</h3>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• Your order is being processed</li>
                                <li>• You'll receive a confirmation email shortly</li>
                                <li>• Track your order status in "My Orders"</li>
                                <li>• Estimated delivery: 2-3 business days</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="orders.php" class="flex-1 bg-red-600 text-white px-6 py-4 rounded-xl hover:bg-red-700 font-semibold text-center transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        View My Orders
                    </a>
                    <a href="index.php" class="flex-1 bg-gray-100 text-gray-700 px-6 py-4 rounded-xl hover:bg-gray-200 font-semibold text-center transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>

        <!-- Support Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 text-center">
            <h3 class="font-semibold text-gray-900 mb-2">Need Help?</h3>
            <p class="text-sm text-gray-600 mb-4">Our customer support team is here to assist you</p>
            <div class="flex justify-center gap-6 text-sm">
                <div class="flex items-center text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    info@techbro.com
                </div>
                <div class="flex items-center text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    +977 9800000000
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
