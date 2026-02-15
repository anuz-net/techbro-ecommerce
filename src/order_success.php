<?php
session_start();
require_once 'config.php';
require_once 'currency.php';

$transaction_uuid = $_GET['order'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM orders WHERE transaction_uuid = ? AND user_id = ?");
$stmt->execute([$transaction_uuid, $_SESSION['user_id']]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - TechBro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <div class="max-w-2xl mx-auto px-4 py-16 text-center">
        <div class="bg-white rounded-xl shadow-sm p-12">
            <svg class="w-24 h-24 mx-auto text-green-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Successful!</h1>
            <p class="text-gray-600 mb-2">Thank you for your order</p>
            <p class="text-sm text-gray-500 mb-8">Order ID: #<?php echo $order['id']; ?></p>
            
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-bold text-xl text-green-600"><?php echo formatPrice($order['total']); ?></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Payment Method:</span>
                    <span class="font-semibold">eSewa</span>
                </div>
            </div>

            <div class="flex gap-4 justify-center">
                <a href="orders.php" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-semibold">View Orders</a>
                <a href="index.php" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 font-semibold">Continue Shopping</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
