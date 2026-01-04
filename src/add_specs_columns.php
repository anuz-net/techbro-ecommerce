<?php
require_once 'config.php';

try {
    $pdo->exec("ALTER TABLE products 
        ADD COLUMN IF NOT EXISTS service_provider VARCHAR(100) DEFAULT 'Unlocked',
        ADD COLUMN IF NOT EXISTS cpu_model VARCHAR(100) DEFAULT 'Snapdragon 8 Gen 3',
        ADD COLUMN IF NOT EXISTS front_camera VARCHAR(50) DEFAULT '12 MP',
        ADD COLUMN IF NOT EXISTS ram VARCHAR(50) DEFAULT '12 GB',
        ADD COLUMN IF NOT EXISTS screen_size VARCHAR(50) DEFAULT '6.8\"',
        ADD COLUMN IF NOT EXISTS weight VARCHAR(50) DEFAULT '233g'
    ");
    
    echo "✅ Specification columns added successfully!<br>";
    echo "<a href='add_product.php' style='background: #dc2626; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;'>Go to Add Product</a>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
