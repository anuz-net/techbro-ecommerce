<?php
require_once 'config.php';

try {
    // Drop existing tables if they exist
    $pdo->exec("DROP TABLE IF EXISTS product_categories");
    $pdo->exec("DROP TABLE IF EXISTS products");
    $pdo->exec("DROP TABLE IF EXISTS categories");
    
    // Create categories table
    $pdo->exec("CREATE TABLE categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) NOT NULL UNIQUE,
        type ENUM('main', 'shop') DEFAULT 'main',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create products table with special tags
    $pdo->exec("CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(500) NOT NULL,
        rating DECIMAL(2,1) DEFAULT 4.5,
        description TEXT,
        is_featured TINYINT(1) DEFAULT 0,
        is_hot_deal TINYINT(1) DEFAULT 0,
        is_trusted_brand TINYINT(1) DEFAULT 0,
        is_cheap_effective TINYINT(1) DEFAULT 0,
        is_gift_product TINYINT(1) DEFAULT 0,
        is_old_product TINYINT(1) DEFAULT 0,
        stock INT DEFAULT 100,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create product_categories junction table
    $pdo->exec("CREATE TABLE product_categories (
        product_id INT,
        category_id INT,
        PRIMARY KEY (product_id, category_id),
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
    )");
    
    // Insert main categories
    $categories = [
        ['Mobile', 'mobile', 'main'],
        ['Laptops', 'laptops', 'main'],
        ['Computers', 'computers', 'main'],
        ['Accessories', 'accessories', 'main'],
        ['Smartphones', 'smartphones', 'shop'],
        ['Gaming PCs', 'gaming-pcs', 'shop'],
        ['Audio', 'audio', 'shop'],
        ['Cameras', 'cameras', 'shop'],
        ['Smart Home', 'smart-home', 'shop']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO categories (name, slug, type) VALUES (?, ?, ?)");
    foreach ($categories as $cat) {
        $stmt->execute($cat);
    }
    
    // Insert 100 sample products
    $products = [
        // Smartphones (30 products)
        ['iPhone 15 Pro Max', 1199, 'Image/15pro.jpg', 4.9, 'Latest iPhone with A17 Pro chip', 1, 0, 1, 0, 0, 0],
        ['Samsung Galaxy S24 Ultra', 1099, 'Image/mobile.png', 4.8, 'Premium Android flagship', 1, 1, 1, 0, 0, 0],
        ['Google Pixel 8 Pro', 899, 'Image/mubail.png', 4.7, 'Best camera phone', 1, 0, 1, 0, 0, 0],
        ['OnePlus 12', 799, 'Image/mobile.png', 4.6, 'Fast charging flagship', 0, 1, 0, 1, 0, 0],
        ['Xiaomi 14 Pro', 699, 'Image/mubail.png', 4.5, 'Value flagship phone', 0, 0, 0, 1, 1, 0],
        ['iPhone 14 Pro', 999, 'Image/15pro.jpg', 4.8, 'Previous gen iPhone', 0, 0, 1, 0, 0, 1],
        ['Samsung Galaxy S23', 799, 'Image/mobile.png', 4.6, 'Last year flagship', 0, 1, 1, 0, 0, 1],
        ['Nothing Phone 2', 599, 'Image/mubail.png', 4.4, 'Unique design phone', 0, 0, 0, 1, 1, 0],
        ['Realme GT 5', 499, 'Image/mobile.png', 4.3, 'Budget gaming phone', 0, 0, 0, 1, 0, 0],
        ['Oppo Find X6 Pro', 899, 'Image/mubail.png', 4.5, 'Camera focused phone', 0, 0, 0, 0, 1, 0],
        ['Vivo X100 Pro', 849, 'Image/mobile.png', 4.6, 'Photography phone', 0, 0, 0, 0, 1, 0],
        ['Asus ROG Phone 7', 999, 'Image/mubail.png', 4.7, 'Gaming smartphone', 0, 0, 0, 0, 0, 0],
        ['Sony Xperia 1 V', 1099, 'Image/mobile.png', 4.5, 'Pro camera phone', 0, 0, 1, 0, 0, 0],
        ['Motorola Edge 40 Pro', 699, 'Image/mubail.png', 4.4, 'Clean Android experience', 0, 0, 0, 1, 0, 0],
        ['Honor Magic 6 Pro', 799, 'Image/mobile.png', 4.5, 'AI powered phone', 0, 0, 0, 0, 1, 0],
        ['iPhone 13', 699, 'Image/15pro.jpg', 4.7, 'Reliable iPhone', 0, 1, 1, 0, 1, 1],
        ['Samsung Galaxy A54', 449, 'Image/mobile.png', 4.3, 'Mid-range Samsung', 0, 0, 0, 1, 1, 0],
        ['Google Pixel 7a', 499, 'Image/mubail.png', 4.4, 'Budget Pixel phone', 0, 1, 1, 1, 1, 0],
        ['Xiaomi Redmi Note 13 Pro', 349, 'Image/mobile.png', 4.2, 'Budget friendly', 0, 0, 0, 1, 1, 0],
        ['OnePlus Nord 3', 399, 'Image/mubail.png', 4.3, 'Mid-range OnePlus', 0, 0, 0, 1, 0, 0],
        ['Realme 11 Pro+', 379, 'Image/mobile.png', 4.2, 'Affordable flagship killer', 0, 0, 0, 1, 1, 0],
        ['Poco F5 Pro', 429, 'Image/mubail.png', 4.3, 'Performance phone', 0, 0, 0, 1, 0, 0],
        ['Samsung Galaxy Z Flip 5', 999, 'Image/mobile.png', 4.6, 'Foldable phone', 1, 0, 1, 0, 1, 0],
        ['Samsung Galaxy Z Fold 5', 1799, 'Image/mubail.png', 4.7, 'Premium foldable', 1, 0, 1, 0, 1, 0],
        ['iPhone SE 2022', 429, 'Image/15pro.jpg', 4.5, 'Compact iPhone', 0, 1, 1, 1, 1, 0],
        ['Asus Zenfone 10', 699, 'Image/mobile.png', 4.4, 'Compact flagship', 0, 0, 0, 0, 1, 0],
        ['Nokia XR21', 549, 'Image/mubail.png', 4.2, 'Rugged phone', 0, 0, 0, 0, 1, 0],
        ['Motorola Razr 40', 699, 'Image/mobile.png', 4.3, 'Flip phone', 0, 0, 0, 0, 1, 0],
        ['Huawei P60 Pro', 899, 'Image/mubail.png', 4.5, 'Camera flagship', 0, 0, 0, 0, 0, 0],
        ['ZTE Axon 50 Ultra', 599, 'Image/mobile.png', 4.2, 'Value flagship', 0, 0, 0, 1, 0, 0],
        
        // Laptops (25 products)
        ['MacBook Pro 16" M3', 2499, 'Image/macm3.webp', 4.9, 'Professional laptop', 1, 0, 1, 0, 0, 0],
        ['MacBook Air M2', 1199, 'Image/Lapto.png', 4.8, 'Thin and light', 1, 1, 1, 0, 1, 0],
        ['Dell XPS 15', 1799, 'Image/macm3.webp', 4.7, 'Premium Windows laptop', 1, 0, 1, 0, 0, 0],
        ['HP Spectre x360', 1499, 'Image/Lapto.png', 4.6, 'Convertible laptop', 0, 0, 1, 0, 1, 0],
        ['Lenovo ThinkPad X1 Carbon', 1699, 'Image/macm3.webp', 4.7, 'Business laptop', 0, 0, 1, 0, 0, 0],
        ['Asus ROG Zephyrus G14', 1599, 'Image/Lapto.png', 4.6, 'Gaming laptop', 1, 0, 0, 0, 0, 0],
        ['Razer Blade 15', 2199, 'Image/macm3.webp', 4.7, 'Premium gaming', 1, 0, 1, 0, 0, 0],
        ['MSI Stealth 15', 1399, 'Image/Lapto.png', 4.5, 'Slim gaming laptop', 0, 1, 0, 0, 0, 0],
        ['Acer Swift 3', 699, 'Image/macm3.webp', 4.3, 'Budget laptop', 0, 0, 0, 1, 1, 0],
        ['Asus Vivobook 15', 549, 'Image/Lapto.png', 4.2, 'Everyday laptop', 0, 1, 0, 1, 1, 0],
        ['HP Pavilion 15', 649, 'Image/macm3.webp', 4.3, 'All-purpose laptop', 0, 0, 0, 1, 0, 0],
        ['Lenovo IdeaPad 5', 599, 'Image/Lapto.png', 4.2, 'Student laptop', 0, 0, 0, 1, 1, 0],
        ['Microsoft Surface Laptop 5', 1299, 'Image/macm3.webp', 4.6, 'Premium Windows', 0, 0, 1, 0, 1, 0],
        ['LG Gram 17', 1599, 'Image/Lapto.png', 4.5, 'Ultra-light laptop', 0, 0, 1, 0, 0, 0],
        ['Samsung Galaxy Book 3', 899, 'Image/macm3.webp', 4.4, 'Portable laptop', 0, 0, 0, 0, 1, 0],
        ['Alienware m15 R7', 1999, 'Image/Lapto.png', 4.6, 'High-end gaming', 1, 0, 1, 0, 0, 0],
        ['Gigabyte Aero 16', 1799, 'Image/macm3.webp', 4.5, 'Creator laptop', 0, 0, 0, 0, 0, 0],
        ['Asus TUF Gaming A15', 899, 'Image/Lapto.png', 4.4, 'Budget gaming', 0, 1, 0, 1, 0, 0],
        ['Acer Predator Helios 300', 1199, 'Image/macm3.webp', 4.5, 'Gaming laptop', 0, 0, 0, 0, 0, 0],
        ['HP Envy 13', 899, 'Image/Lapto.png', 4.4, 'Compact laptop', 0, 0, 0, 0, 1, 0],
        ['Dell Inspiron 15', 549, 'Image/macm3.webp', 4.1, 'Basic laptop', 0, 1, 0, 1, 1, 0],
        ['Lenovo Legion 5', 1099, 'Image/Lapto.png', 4.5, 'Gaming laptop', 0, 0, 0, 0, 0, 0],
        ['MacBook Pro 14" M3', 1999, 'Image/macm3.webp', 4.9, 'Pro laptop', 1, 0, 1, 0, 1, 0],
        ['Asus Zenbook 14', 799, 'Image/Lapto.png', 4.4, 'Ultrabook', 0, 0, 0, 0, 1, 0],
        ['HP Omen 16', 1299, 'Image/macm3.webp', 4.5, 'Gaming laptop', 0, 0, 0, 0, 0, 0],
        
        // Gaming PCs & Computers (20 products)
        ['Custom Gaming PC RTX 4090', 3499, 'Image/gamingpc.png', 4.9, 'Ultimate gaming rig', 1, 0, 1, 0, 0, 0],
        ['Alienware Aurora R15', 2999, 'Image/gamingpc.png', 4.8, 'Pre-built gaming PC', 1, 0, 1, 0, 0, 0],
        ['HP Omen 45L', 2499, 'Image/gamingpc.png', 4.7, 'High-end gaming', 1, 0, 1, 0, 0, 0],
        ['CyberPowerPC Gamer Xtreme', 1299, 'Image/gamingpc.png', 4.5, 'Mid-range gaming', 0, 1, 0, 1, 0, 0],
        ['iBUYPOWER Gaming PC', 1099, 'Image/gamingpc.png', 4.4, 'Budget gaming PC', 0, 1, 0, 1, 1, 0],
        ['Corsair Vengeance i7200', 2799, 'Image/gamingpc.png', 4.7, 'Premium gaming', 1, 0, 1, 0, 0, 0],
        ['NZXT Player Three', 1799, 'Image/gamingpc.png', 4.6, 'Streaming PC', 0, 0, 0, 0, 0, 0],
        ['Skytech Archangel', 999, 'Image/gamingpc.png', 4.3, 'Entry gaming PC', 0, 1, 0, 1, 1, 0],
        ['MSI Aegis RS', 2199, 'Image/gamingpc.png', 4.6, 'Compact gaming', 0, 0, 0, 0, 0, 0],
        ['Asus ROG Strix GA35', 2599, 'Image/gamingpc.png', 4.7, 'RGB gaming PC', 1, 0, 1, 0, 0, 0],
        ['iMac 24" M3', 1499, 'Image/gamingpc.png', 4.8, 'All-in-one desktop', 1, 0, 1, 0, 1, 0],
        ['Mac Mini M2', 599, 'Image/gamingpc.png', 4.6, 'Compact desktop', 0, 1, 1, 1, 1, 0],
        ['Dell OptiPlex 7000', 899, 'Image/gamingpc.png', 4.4, 'Business desktop', 0, 0, 0, 0, 0, 0],
        ['HP EliteDesk 800', 1099, 'Image/gamingpc.png', 4.5, 'Professional PC', 0, 0, 1, 0, 0, 0],
        ['Lenovo ThinkCentre M90', 799, 'Image/gamingpc.png', 4.3, 'Office desktop', 0, 0, 0, 1, 0, 0],
        ['Acer Aspire TC', 549, 'Image/gamingpc.png', 4.1, 'Home desktop', 0, 1, 0, 1, 1, 0],
        ['Custom Workstation PC', 2999, 'Image/gamingpc.png', 4.8, 'Content creation', 1, 0, 1, 0, 0, 0],
        ['Gaming PC RTX 4070', 1899, 'Image/gamingpc.png', 4.6, 'High performance', 0, 0, 0, 0, 0, 0],
        ['Budget Gaming Build', 799, 'Image/gamingpc.png', 4.2, 'Entry level gaming', 0, 1, 0, 1, 1, 0],
        ['Mini ITX Gaming PC', 1599, 'Image/gamingpc.png', 4.5, 'Compact gaming', 0, 0, 0, 0, 1, 0],
        
        // Accessories (15 products)
        ['Logitech MX Master 3S', 99, 'Image/mobile.png', 4.8, 'Premium mouse', 1, 0, 1, 0, 1, 0],
        ['Razer BlackWidow V4', 179, 'Image/mobile.png', 4.7, 'Mechanical keyboard', 1, 0, 1, 0, 0, 0],
        ['Apple Magic Keyboard', 149, 'Image/mobile.png', 4.6, 'Wireless keyboard', 0, 0, 1, 0, 1, 0],
        ['SteelSeries Arctis Nova Pro', 349, 'Image/mobile.png', 4.8, 'Gaming headset', 1, 0, 1, 0, 0, 0],
        ['Anker USB-C Hub', 49, 'Image/mobile.png', 4.5, 'Multi-port adapter', 0, 1, 0, 1, 1, 0],
        ['Samsung T7 SSD 1TB', 129, 'Image/mobile.png', 4.7, 'Portable storage', 0, 0, 1, 0, 1, 0],
        ['Logitech C920 Webcam', 79, 'Image/mobile.png', 4.6, 'HD webcam', 0, 1, 1, 1, 0, 0],
        ['Blue Yeti Microphone', 129, 'Image/mobile.png', 4.7, 'USB microphone', 0, 0, 1, 0, 1, 0],
        ['Elgato Stream Deck', 149, 'Image/mobile.png', 4.6, 'Content creator tool', 0, 0, 0, 0, 1, 0],
        ['Cable Management Kit', 19, 'Image/mobile.png', 4.3, 'Desk organizer', 0, 0, 0, 1, 1, 0],
        ['RGB LED Strip 5m', 29, 'Image/mobile.png', 4.4, 'Gaming lights', 0, 1, 0, 1, 1, 0],
        ['Laptop Stand Aluminum', 39, 'Image/mobile.png', 4.5, 'Ergonomic stand', 0, 0, 0, 1, 1, 0],
        ['Wireless Charging Pad', 25, 'Image/mobile.png', 4.4, 'Fast charging', 0, 1, 0, 1, 1, 0],
        ['Phone Case Premium', 29, 'Image/mobile.png', 4.3, 'Protective case', 0, 0, 0, 1, 1, 0],
        ['Screen Protector Pack', 15, 'Image/mobile.png', 4.2, 'Tempered glass', 0, 1, 0, 1, 1, 0],
        
        // Audio & Cameras & Smart Home (10 products)
        ['Sony WH-1000XM5', 399, 'Image/mobile.png', 4.9, 'Noise cancelling', 1, 0, 1, 0, 1, 0],
        ['AirPods Pro 2', 249, 'Image/mobile.png', 4.8, 'Apple earbuds', 1, 0, 1, 0, 1, 0],
        ['JBL Flip 6', 129, 'Image/mobile.png', 4.6, 'Portable speaker', 0, 1, 1, 0, 1, 0],
        ['Bose QuietComfort 45', 329, 'Image/mobile.png', 4.7, 'Premium headphones', 0, 0, 1, 0, 1, 0],
        ['Canon EOS R6', 2499, 'Image/mobile.png', 4.8, 'Mirrorless camera', 1, 0, 1, 0, 0, 0],
        ['Sony A7 IV', 2499, 'Image/mobile.png', 4.9, 'Full frame camera', 1, 0, 1, 0, 0, 0],
        ['GoPro Hero 12', 399, 'Image/mobile.png', 4.7, 'Action camera', 0, 0, 1, 0, 1, 0],
        ['Amazon Echo Dot 5', 49, 'Image/mobile.png', 4.6, 'Smart speaker', 0, 1, 1, 1, 1, 0],
        ['Google Nest Hub', 99, 'Image/mobile.png', 4.5, 'Smart display', 0, 0, 1, 0, 1, 0],
        ['Philips Hue Starter Kit', 199, 'Image/mobile.png', 4.7, 'Smart lighting', 0, 0, 1, 0, 1, 0]
    ];
    
    $stmt = $pdo->prepare("INSERT INTO products (name, price, image, rating, description, is_featured, is_hot_deal, is_trusted_brand, is_cheap_effective, is_gift_product, is_old_product) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    foreach ($products as $product) {
        $stmt->execute($product);
    }
    
    // Assign categories to products
    // Mobile category (1) - products 1-30
    for ($i = 1; $i <= 30; $i++) {
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 1)"); // Mobile
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 5)"); // Smartphones
    }
    
    // Laptops category (2) - products 31-55
    for ($i = 31; $i <= 55; $i++) {
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 2)"); // Laptops
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 5)"); // Laptops shop
    }
    
    // Computers/Gaming PCs (3) - products 56-75
    for ($i = 56; $i <= 75; $i++) {
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 3)"); // Computers
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 6)"); // Gaming PCs
    }
    
    // Accessories (4) - products 76-90
    for ($i = 76; $i <= 90; $i++) {
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 4)"); // Accessories
    }
    
    // Audio (7) - products 91-94
    for ($i = 91; $i <= 94; $i++) {
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 4)"); // Accessories
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 7)"); // Audio
    }
    
    // Cameras (8) - products 95-97
    for ($i = 95; $i <= 97; $i++) {
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 4)"); // Accessories
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 8)"); // Cameras
    }
    
    // Smart Home (9) - products 98-100
    for ($i = 98; $i <= 100; $i++) {
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 4)"); // Accessories
        $pdo->exec("INSERT INTO product_categories VALUES ($i, 9)"); // Smart Home
    }
    
    echo "✅ Database setup complete!<br>";
    echo "✅ Categories created<br>";
    echo "✅ 100 products added<br>";
    echo "✅ Product-category relationships established<br>";
    echo "<br><a href='index.php' style='background: #dc2626; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;'>Go to Homepage</a>";
    echo " <a href='admin.php' style='background: #2563eb; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; margin-left: 10px;'>Go to Admin</a>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
