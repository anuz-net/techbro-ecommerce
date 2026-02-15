<?php
$host = '127.0.0.1';
$port = '3307';
$username = 'root';
$password = '';

try {
    // Create database
    $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("DROP DATABASE IF EXISTS techbro_db");
    $pdo->exec("CREATE DATABASE techbro_db");
    $pdo->exec("USE techbro_db");
    
    // Create users table
    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    
    echo "Database and table created successfully!<br>";
    echo "You can now use the signup and login system.";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>