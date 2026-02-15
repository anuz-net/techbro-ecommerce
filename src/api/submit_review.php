<?php
session_start();
require_once '../config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Please login to submit a review']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit();
}

$product_id = $_POST['product_id'] ?? 0;
$rating = $_POST['rating'] ?? 0;
$comment = trim($_POST['comment'] ?? '');
$user_id = $_SESSION['user_id'];

if ($rating < 1 || $rating > 5) {
    echo json_encode(['success' => false, 'error' => 'Rating must be between 1 and 5']);
    exit();
}

if (empty($comment)) {
    echo json_encode(['success' => false, 'error' => 'Comment is required']);
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO product_reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE rating = ?, comment = ?");
    $stmt->execute([$product_id, $user_id, $rating, $comment, $rating, $comment]);
    
    // Update product average rating
    $stmt = $pdo->prepare("UPDATE products SET rating = (SELECT AVG(rating) FROM product_reviews WHERE product_id = ?) WHERE id = ?");
    $stmt->execute([$product_id, $product_id]);
    
    echo json_encode(['success' => true, 'message' => 'Review submitted successfully']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Failed to submit review']);
}
?>
