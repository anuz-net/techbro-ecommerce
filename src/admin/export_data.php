<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

require_once '../config.php';

// Set headers for Excel download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="techbro_data_' . date('Y-m-d_H-i-s') . '.xls"');
header('Pragma: no-cache');
header('Expires: 0');

echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
echo "<head><meta charset=\"UTF-8\"></head>";
echo "<body>";

// Users Data
echo "<h2>Users</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Created At</th></tr>";
$stmt = $pdo->query("SELECT id, name, email, created_at FROM users ORDER BY id");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['created_at']}</td>";
    echo "</tr>";
}
echo "</table><br><br>";

// Products Data
echo "<h2>Products</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Rating</th><th>Featured</th><th>Hot Deal</th><th>Stock</th></tr>";
$stmt = $pdo->query("SELECT id, name, price, rating, is_featured, is_hot_deal, stock FROM products ORDER BY id");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>\${$row['price']}</td>";
    echo "<td>{$row['rating']}</td>";
    echo "<td>" . ($row['is_featured'] ? 'Yes' : 'No') . "</td>";
    echo "<td>" . ($row['is_hot_deal'] ? 'Yes' : 'No') . "</td>";
    echo "<td>{$row['stock']}</td>";
    echo "</tr>";
}
echo "</table><br><br>";

// Orders Data
echo "<h2>Orders</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>User ID</th><th>Total</th><th>Status</th><th>Payment Method</th><th>Created At</th></tr>";
$stmt = $pdo->query("SELECT id, user_id, total, status, payment_method, created_at FROM orders ORDER BY id DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['user_id']}</td>";
    echo "<td>\${$row['total']}</td>";
    echo "<td>{$row['status']}</td>";
    echo "<td>{$row['payment_method']}</td>";
    echo "<td>{$row['created_at']}</td>";
    echo "</tr>";
}
echo "</table><br><br>";

// Categories Data
echo "<h2>Categories</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Slug</th><th>Type</th></tr>";
$stmt = $pdo->query("SELECT id, name, slug, type FROM categories ORDER BY id");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['slug']}</td>";
    echo "<td>{$row['type']}</td>";
    echo "</tr>";
}
echo "</table>";

echo "</body></html>";
exit();
?>
