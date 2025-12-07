<?php
session_start();
require_once 'config.php';

echo "User ID: " . ($_SESSION['user_id'] ?? 'Not logged in') . "<br>";

try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'cart'");
    if ($stmt->rowCount() > 0) {
        echo "Cart table exists<br>";
        
        $stmt = $pdo->query("DESCRIBE cart");
        echo "<pre>";
        print_r($stmt->fetchAll());
        echo "</pre>";
    } else {
        echo "Cart table does NOT exist - run setup_products.php";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
