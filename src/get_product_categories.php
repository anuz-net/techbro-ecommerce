<?php
require_once 'config.php';

$product_id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT category_id FROM product_categories WHERE product_id = ?");
$stmt->execute([$product_id]);
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

header('Content-Type: application/json');
echo json_encode($categories);
?>
