<?php
$host = '127.0.0.1';
$dbname = 'techbro_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3307;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed. Please make sure XAMPP MySQL is running. Error: " . $e->getMessage());
}
?>