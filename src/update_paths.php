<?php
// Update all files with new API paths
$files = ['index.php', 'product.php', 'category.php', 'search.php'];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $content = str_replace("fetch('add_to_cart.php'", "fetch('api/add_to_cart.php'", $content);
        $content = str_replace("fetch('submit_review.php'", "fetch('api/submit_review.php'", $content);
        file_put_contents($file, $content);
        echo "Updated: $file\n";
    }
}
echo "Done!";
?>
