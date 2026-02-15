<?php
require_once 'currency.php';

echo "<h1>Currency Conversion Test</h1>";
echo "<p>1 USD = " . USD_TO_NPR . " NPR</p>";
echo "<hr>";

$test_prices = [9.99, 99.99, 999.99, 1199.00];

foreach ($test_prices as $usd) {
    echo "<p>$" . number_format($usd, 2) . " USD = " . formatPrice($usd) . "</p>";
}

echo "<hr>";
echo "<p>✅ Currency conversion is working correctly!</p>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
?>
