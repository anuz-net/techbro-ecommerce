<?php
require_once 'config.php';

try {
    // Add transaction_uuid and payment columns to orders table
    $pdo->exec("ALTER TABLE orders 
        ADD COLUMN IF NOT EXISTS transaction_uuid VARCHAR(100),
        ADD COLUMN IF NOT EXISTS transaction_code VARCHAR(100),
        ADD COLUMN IF NOT EXISTS payment_method VARCHAR(50)
    ");
    
    echo "✅ Payment columns added successfully!<br>";
    echo "<a href='checkout.php' style='background: #dc2626; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;'>Go to Checkout</a>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
