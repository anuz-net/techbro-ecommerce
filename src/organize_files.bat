@echo off
echo ========================================
echo TechBro File Organization Script
echo ========================================
echo.

REM Create directory structure
echo Creating folders...
mkdir api 2>nul
mkdir admin 2>nul
mkdir setup 2>nul
mkdir tests 2>nul
mkdir assets\css 2>nul
mkdir assets\js 2>nul
mkdir docs 2>nul

REM Move API files
echo Moving API files...
move add_to_cart.php api\ 2>nul
move update_cart.php api\ 2>nul
move remove_from_cart.php api\ 2>nul
move get_cart_count.php api\ 2>nul
move get_cart_items.php api\ 2>nul
move submit_review.php api\ 2>nul

REM Move Admin files
echo Moving Admin files...
move admin.php admin\ 2>nul
move admin_login.php admin\ 2>nul
move manage_products.php admin\ 2>nul
move manage_hot_deals.php admin\ 2>nul
move manage_all_products.php admin\ 2>nul
move add_product.php admin\ 2>nul
move view_users.php admin\ 2>nul
move get_product_categories.php admin\ 2>nul

REM Move Setup files
echo Moving Setup files...
move setup_database.php setup\ 2>nul
move setup_products.php setup\ 2>nul
move setup_categories.php setup\ 2>nul
move setup_orders.php setup\ 2>nul
move setup_payment.php setup\ 2>nul
move setup_reviews.php setup\ 2>nul
move add_hot_deals_column.php setup\ 2>nul
move add_product_type_column.php setup\ 2>nul
move add_specs_columns.php setup\ 2>nul
move add_user_profile_columns.php setup\ 2>nul
move fix_cart_foreign_key.php setup\ 2>nul

REM Move Test files
echo Moving Test files...
move test_cart.php tests\ 2>nul
move test_currency.php tests\ 2>nul
move update_currency.php tests\ 2>nul

REM Move CSS files
echo Moving CSS files...
move output.css assets\css\ 2>nul
move input.css assets\css\ 2>nul
move styles.css assets\css\ 2>nul
move dropdown-fix.css assets\css\ 2>nul

REM Move JS files
echo Moving JS files...
move script.js assets\js\ 2>nul

REM Move Documentation
echo Moving Documentation...
move README.md docs\ 2>nul
move FILE_ORGANIZATION.md docs\ 2>nul
move update_prices.sql docs\ 2>nul

echo.
echo ========================================
echo File organization complete!
echo ========================================
echo.
echo New structure:
echo - api/          (Cart and API operations)
echo - admin/        (Admin panel files)
echo - setup/        (Database setup scripts)
echo - tests/        (Testing utilities)
echo - assets/css/   (Stylesheets)
echo - assets/js/    (JavaScript files)
echo - docs/         (Documentation)
echo - includes/     (Shared components)
echo - Image/        (Product images)
echo - uploads/      (User uploads)
echo.
pause
