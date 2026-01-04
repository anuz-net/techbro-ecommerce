<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'items' => [], 'total' => 0]);
    exit();
}

$stmt = $pdo->prepare("SELECT c.*, p.name, p.image, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = array_sum(array_map(function($item) {
    return $item['price'] * $item['quantity'];
}, $items));

echo json_encode(['success' => true, 'items' => $items, 'total' => $total]);
?>
