<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';
require_once 'currency.php';

$amount_usd = $_POST['amount'];
$amount = convertToNPR($amount_usd);
$transaction_uuid = $_POST['transaction_uuid'];
$product_code = "EPAYTEST"; // Test merchant code

// Store order in database
$stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status, transaction_uuid) VALUES (?, ?, 'pending', ?)");
$stmt->execute([$_SESSION['user_id'], $amount_usd, $transaction_uuid]);
$order_id = $pdo->lastInsertId();

// Store order items
$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) SELECT ?, product_id, quantity, (SELECT price FROM products WHERE id = product_id) FROM cart WHERE user_id = ?");
$stmt->execute([$order_id, $_SESSION['user_id']]);

// eSewa parameters
$success_url = "http://localhost/techbro/src/esewa_success.php";
$failure_url = "http://localhost/techbro/src/esewa_failure.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to eSewa...</title>
</head>
<body>
    <form id="esewaForm" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
        <input type="hidden" name="tax_amount" value="0">
        <input type="hidden" name="total_amount" value="<?php echo $amount; ?>">
        <input type="hidden" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>">
        <input type="hidden" name="product_code" value="<?php echo $product_code; ?>">
        <input type="hidden" name="product_service_charge" value="0">
        <input type="hidden" name="product_delivery_charge" value="0">
        <input type="hidden" name="success_url" value="<?php echo $success_url; ?>">
        <input type="hidden" name="failure_url" value="<?php echo $failure_url; ?>">
        <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
        <input type="hidden" name="signature" value="<?php echo base64_encode(hash_hmac('sha256', "total_amount=$amount,transaction_uuid=$transaction_uuid,product_code=$product_code", '8gBm/:&EnhH.1/q', true)); ?>">
        <p style="text-align: center; padding: 50px;">Redirecting to eSewa payment gateway...</p>
    </form>
    <script>document.getElementById('esewaForm').submit();</script>
</body>
</html>
