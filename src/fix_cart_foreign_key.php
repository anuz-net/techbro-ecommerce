<?php
$host = '127.0.0.1';
$port = '3307';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("USE techbro_db");
    
    // Drop foreign keys
    $pdo->exec("ALTER TABLE cart DROP FOREIGN KEY cart_ibfk_1");
    $pdo->exec("ALTER TABLE cart DROP FOREIGN KEY cart_ibfk_2");
    
    echo "Foreign keys removed! Cart should work now.";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
