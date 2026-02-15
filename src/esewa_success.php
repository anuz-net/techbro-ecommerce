<?php
session_start();
require_once 'config.php';

$transaction_uuid = $_GET['transaction_uuid'] ?? '';
$transaction_code = $_GET['transaction_code'] ?? '';

if ($transaction_uuid && $transaction_code) {
    // Verify payment with eSewa
    $url = "https://rc-epay.esewa.com.np/api/epay/transaction/status/?product_code=EPAYTEST&total_amount=" . $_GET['total_amount'] . "&transaction_uuid=" . $transaction_uuid;
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    
    $result = json_decode($response, true);
    
    if ($result && $result['status'] == 'COMPLETE') {
        // Update order status
        $stmt = $pdo->prepare("UPDATE orders SET status = 'processing', payment_method = 'esewa', transaction_code = ? WHERE transaction_uuid = ?");
        $stmt->execute([$transaction_code, $transaction_uuid]);
        
        // Clear cart
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        
        header('Location: order_success.php?order=' . $transaction_uuid);
        exit();
    }
}

header('Location: esewa_failure.php');
exit();
?>
