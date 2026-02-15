<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechBro System Check</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #dc2626; }
        .section { margin: 20px 0; padding: 15px; border-left: 4px solid #dc2626; background: #fef2f2; }
        .success { border-left-color: #10b981; background: #f0fdf4; }
        .error { border-left-color: #ef4444; background: #fef2f2; }
        .warning { border-left-color: #f59e0b; background: #fffbeb; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f9fafb; font-weight: 600; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-error { background: #fee2e2; color: #991b1b; }
        .badge-warning { background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 TechBro System Check</h1>
        
        <?php
        require_once 'config.php';
        
        $errors = [];
        $warnings = [];
        $success = [];
        
        // Check database connection
        try {
            $pdo->query("SELECT 1");
            $success[] = "Database connection successful";
        } catch (PDOException $e) {
            $errors[] = "Database connection failed: " . $e->getMessage();
        }
        
        // Check required tables
        $required_tables = ['users', 'products', 'cart', 'orders', 'order_items', 'categories', 'product_categories', 'product_reviews'];
        echo '<div class="section"><h2>📊 Database Tables</h2><table><tr><th>Table</th><th>Status</th><th>Rows</th></tr>';
        
        foreach ($required_tables as $table) {
            try {
                $stmt = $pdo->query("SELECT COUNT(*) as count FROM $table");
                $count = $stmt->fetch()['count'];
                echo "<tr><td>$table</td><td><span class='badge badge-success'>✓ Exists</span></td><td>$count</td></tr>";
            } catch (PDOException $e) {
                echo "<tr><td>$table</td><td><span class='badge badge-error'>✗ Missing</span></td><td>-</td></tr>";
                $errors[] = "Table '$table' is missing";
            }
        }
        echo '</table></div>';
        
        // Check required columns in orders table
        echo '<div class="section"><h2>🔧 Orders Table Columns</h2><table><tr><th>Column</th><th>Status</th></tr>';
        $required_columns = ['id', 'user_id', 'total', 'status', 'transaction_uuid', 'transaction_code', 'payment_method'];
        
        try {
            $stmt = $pdo->query("DESCRIBE orders");
            $existing_columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            foreach ($required_columns as $col) {
                if (in_array($col, $existing_columns)) {
                    echo "<tr><td>$col</td><td><span class='badge badge-success'>✓ Exists</span></td></tr>";
                } else {
                    echo "<tr><td>$col</td><td><span class='badge badge-error'>✗ Missing</span></td></tr>";
                    $errors[] = "Column '$col' missing in orders table";
                }
            }
        } catch (PDOException $e) {
            $errors[] = "Cannot check orders table: " . $e->getMessage();
        }
        echo '</table></div>';
        
        // Check required files
        echo '<div class="section"><h2>📁 Required Files</h2><table><tr><th>File</th><th>Status</th><th>Size</th></tr>';
        $required_files = [
            'config.php', 'currency.php', 'auth.php', 'add_to_cart.php', 
            'checkout.php', 'esewa_payment.php', 'esewa_success.php', 'esewa_failure.php',
            'order_success.php', 'cart.php', 'index.php', 'product.php', 'category.php',
            'login.php', 'signup.php', 'profile.php', 'orders.php', 'admin.php'
        ];
        
        foreach ($required_files as $file) {
            if (file_exists($file)) {
                $size = round(filesize($file) / 1024, 2);
                echo "<tr><td>$file</td><td><span class='badge badge-success'>✓ Exists</span></td><td>{$size} KB</td></tr>";
            } else {
                echo "<tr><td>$file</td><td><span class='badge badge-error'>✗ Missing</span></td><td>-</td></tr>";
                $errors[] = "File '$file' is missing";
            }
        }
        echo '</table></div>';
        
        // Check currency conversion
        echo '<div class="section"><h2>💱 Currency Conversion</h2>';
        if (file_exists('currency.php')) {
            require_once 'currency.php';
            echo "<p>1 USD = " . USD_TO_NPR . " NPR</p>";
            echo "<p>Test: $100 USD = " . formatPrice(100) . "</p>";
            $success[] = "Currency conversion working";
        } else {
            $errors[] = "currency.php file missing";
        }
        echo '</div>';
        
        // Check products
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM products");
            $product_count = $stmt->fetch()['count'];
            echo '<div class="section success"><h2>📦 Products</h2>';
            echo "<p>Total products: <strong>$product_count</strong></p>";
            
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE is_featured = 1");
            $featured = $stmt->fetch()['count'];
            echo "<p>Featured products: <strong>$featured</strong></p>";
            
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE is_hot_deal = 1");
            $hot_deals = $stmt->fetch()['count'];
            echo "<p>Hot deals: <strong>$hot_deals</strong></p>";
            echo '</div>';
        } catch (PDOException $e) {
            $errors[] = "Cannot check products: " . $e->getMessage();
        }
        
        // Summary
        echo '<div class="section">';
        echo '<h2>📋 Summary</h2>';
        
        if (count($errors) > 0) {
            echo '<div class="error"><h3>❌ Errors Found (' . count($errors) . ')</h3><ul>';
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul></div>';
        }
        
        if (count($warnings) > 0) {
            echo '<div class="warning"><h3>⚠️ Warnings (' . count($warnings) . ')</h3><ul>';
            foreach ($warnings as $warning) {
                echo "<li>$warning</li>";
            }
            echo '</ul></div>';
        }
        
        if (count($errors) == 0 && count($warnings) == 0) {
            echo '<div class="success"><h3>✅ All Systems Operational!</h3>';
            echo '<p>Your TechBro e-commerce system is properly configured and ready to use.</p>';
            echo '<p><a href="index.php" style="background: #dc2626; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block; margin-top: 10px;">Go to Homepage</a></p>';
            echo '</div>';
        } else {
            echo '<div class="error"><h3>🔧 Action Required</h3>';
            echo '<p>Please fix the errors above before using the system.</p>';
            if (in_array("Column 'transaction_uuid' missing in orders table", $errors)) {
                echo '<p><a href="setup_payment.php" style="background: #dc2626; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block; margin-top: 10px;">Run Payment Setup</a></p>';
            }
            echo '</div>';
        }
        echo '</div>';
        ?>
    </div>
</body>
</html>
