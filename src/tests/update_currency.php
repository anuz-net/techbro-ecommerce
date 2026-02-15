#!/usr/bin/env php
<?php
// This script updates all PHP files to use NPR currency

$files = [
    'index.php',
    'product.php',
    'category.php',
    'search.php',
    'orders.php'
];

foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    if (file_exists($path)) {
        $content = file_get_contents($path);
        
        // Add currency.php include after config.php
        if (strpos($content, "require_once 'currency.php';") === false) {
            $content = str_replace(
                "require_once 'config.php';",
                "require_once 'config.php';\nrequire_once 'currency.php';",
                $content
            );
        }
        
        // Replace all $...number_format with formatPrice
        $content = preg_replace(
            '/\$\<\?php echo number_format\(\$([a-zA-Z_\[\]\']+), 2\); \?\>/',
            '<?php echo formatPrice($\1); ?>',
            $content
        );
        
        file_put_contents($path, $content);
        echo "Updated: $file\n";
    }
}

echo "Done! All files updated to use NPR currency.\n";
?>
