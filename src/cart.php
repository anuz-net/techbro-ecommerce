<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';
require_once 'currency.php';

// Handle remove item
if (isset($_POST['remove_item'])) {
    $cart_id = $_POST['cart_id'];
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $_SESSION['user_id']]);
}

// Handle update quantity
if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = max(1, intval($_POST['quantity']));
    $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$quantity, $cart_id, $_SESSION['user_id']]);
}

// Get cart items
$stmt = $pdo->prepare("
    SELECT c.id as cart_id, c.quantity, p.id, p.name, p.price, p.image 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet" />
    <link rel="shortcut icon" href="Image/favico.png" type="image/x-icon" />
    <title>My Cart</title>
</head>

<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">My Cart</h1>
            <a href="index.php" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Continue Shopping</a>
        </div>

        <?php if (empty($cart_items)): ?>
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-500 mb-4">Your cart is empty</p>
                <a href="index.php" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">Start Shopping</a>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <?php foreach ($cart_items as $item): ?>
                    <div class="flex items-center p-6 border-b border-gray-200">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-16 h-16 object-cover rounded-lg">
                        
                        <div class="flex-1 ml-4">
                            <h3 class="font-semibold"><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p class="text-red-600 font-bold"><?php echo formatPrice($item['price']); ?></p>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <form method="POST" class="flex items-center">
                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="w-16 px-2 py-1 border rounded">
                                <button type="submit" name="update_quantity" class="ml-2 text-blue-600 hover:text-blue-800">Update</button>
                            </form>
                            
                            <form method="POST" class="inline">
                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                <button type="submit" name="remove_item" class="text-red-600 hover:text-red-800">Remove</button>
                            </form>
                        </div>
                        
                        <div class="ml-4 font-bold">
                            <?php echo formatPrice($item['price'] * $item['quantity']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="p-6 bg-gray-50">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-bold">Total: <?php echo formatPrice($total); ?></span>
                        <a href="checkout.php" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-semibold">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>