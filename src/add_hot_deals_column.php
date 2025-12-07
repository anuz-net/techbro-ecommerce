<?php
$host = 'localhost';
$port = '3306';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("USE techbro_db");
    
    // Add is_hot_deal column to products table
    $sql = "ALTER TABLE products ADD COLUMN IF NOT EXISTS is_hot_deal BOOLEAN DEFAULT FALSE";
    $pdo->exec($sql);
    
    echo "Hot Deals column added successfully! You can now manage hot deals from the admin panel.";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
