<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed - TechBro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <div class="max-w-2xl mx-auto px-4 py-16 text-center">
        <div class="bg-white rounded-xl shadow-sm p-12">
            <svg class="w-24 h-24 mx-auto text-red-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Failed</h1>
            <p class="text-gray-600 mb-8">Your payment was not completed. Please try again.</p>
            <div class="flex gap-4 justify-center">
                <a href="checkout.php" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-semibold">Try Again</a>
                <a href="index.php" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 font-semibold">Go Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
