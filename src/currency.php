<?php
// Currency conversion: 1 USD = 100 NPR
define('USD_TO_NPR', 100);

function formatPrice($usd_price) {
    $npr_price = $usd_price * USD_TO_NPR;
    return 'NPR ' . number_format($npr_price, 2);
}

function convertToNPR($usd_price) {
    return $usd_price * USD_TO_NPR;
}
?>
