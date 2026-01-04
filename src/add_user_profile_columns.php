<?php
require_once 'config.php';

try {
    $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS avatar VARCHAR(255) DEFAULT NULL");
    $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS phone VARCHAR(20) DEFAULT NULL");
    $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS address TEXT DEFAULT NULL");
    echo "User profile columns added successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
