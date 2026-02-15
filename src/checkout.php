<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';
require_once 'currency.php';

$stmt = $pdo->prepare("SELECT c.*, p.name, p.image, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($cart_items)) {
    header('Location: cart.php');
    exit();
}

$total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart_items));
$transaction_uuid = uniqid('TXN');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - TechBro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                <div class="space-y-4">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="flex gap-4 pb-4 border-b">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <h3 class="font-semibold"><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="text-sm text-gray-600">Qty: <?php echo $item['quantity']; ?></p>
                                <p class="text-red-600 font-bold"><?php echo formatPrice($item['price'] * $item['quantity']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-6 pt-6 border-t">
                    <div class="flex justify-between text-xl font-bold">
                        <span>Total:</span>
                        <span class="text-red-600"><?php echo formatPrice($total); ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold mb-4">Payment Method</h2>
                
                <form action="esewa_payment.php" method="POST">
                    <input type="hidden" name="amount" value="<?php echo $total; ?>">
                    <input type="hidden" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>">
                    
                    <div class="mb-6">
                        <label class="flex items-center p-4 border-2 border-green-500 rounded-lg cursor-pointer bg-green-50">
                            <input type="radio" name="payment_method" value="esewa" checked class="mr-3">
                            <img src="https://esewa.com.np/common/images/esewa_logo.png" alt="eSewa" class="h-8">
                            <span class="ml-auto font-semibold text-green-700">Pay with eSewa</span>
                        </label>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <p class="text-sm text-blue-800">
                            <strong>Test Mode:</strong> You'll be redirected to eSewa payment gateway.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition">
                        Proceed to Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
