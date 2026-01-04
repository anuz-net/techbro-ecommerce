<?php
require_once 'config.php';

try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS product_reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        user_id INT NOT NULL,
        rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
        comment TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY unique_user_product (user_id, product_id)
    )");
    
    echo "✅ Reviews table created successfully!<br>";
    echo "<a href='product.php?id=1' style='background: #dc2626; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;'>View Product</a>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
