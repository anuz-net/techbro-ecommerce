<?php
$host = '127.0.0.1';
$port = '3307';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("USE techbro_db");
    
    // Create products table
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(255) NOT NULL,
        rating DECIMAL(2,1) DEFAULT 0,
        is_featured BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    
    // Create cart table
    $sql = "CREATE TABLE IF NOT EXISTS cart (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        quantity INT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (product_id) REFERENCES products(id)
    )";
    
    $pdo->exec($sql);
    
    // Insert sample products
    $products = [
        ['iPhone 15 Pro', 999.99, 'https://via.placeholder.com/300x300?text=iPhone+15', 4.8, 1],
        ['MacBook Pro M3', 1999.99, 'https://via.placeholder.com/300x300?text=MacBook+Pro', 4.9, 1],
        ['Gaming PC RTX 4080', 1599.99, 'https://via.placeholder.com/300x300?text=Gaming+PC', 4.7, 1],
        ['Sony WH-1000XM5', 399.99, 'https://via.placeholder.com/300x300?text=Sony+Headphones', 4.6, 1]
    ];
    
    foreach ($products as $product) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO products (name, price, image, rating, is_featured) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute($product);
    }
    
    echo "Products table created and sample data inserted!";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>