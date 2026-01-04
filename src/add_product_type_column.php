<?php
require_once 'config.php';

try {
    $pdo->exec("ALTER TABLE products ADD COLUMN IF NOT EXISTS product_type VARCHAR(50) DEFAULT 'Mobile' AFTER description");
    echo "Column added successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
