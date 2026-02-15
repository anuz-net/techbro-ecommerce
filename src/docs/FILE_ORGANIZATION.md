# TechBro E-Commerce - File Organization

## 📁 Directory Structure

```
techbro/src/
├── 🔧 Core Configuration
│   ├── config.php              # Database configuration
│   ├── currency.php            # Currency conversion (USD to NPR)
│   └── auth.php                # Authentication handler
│
├── 🏠 Main Pages
│   ├── index.php               # Homepage with products
│   ├── product.php             # Single product details
│   ├── category.php            # Category listing
│   ├── search.php              # Search results
│   └── cart.php                # Shopping cart
│
├── 👤 User Pages
│   ├── login.php               # User login
│   ├── signup.php              # User registration
│   ├── profile.php             # User profile
│   ├── orders.php              # Order history
│   └── logout.php              # Logout handler
│
├── 💳 Checkout & Payment
│   ├── checkout.php            # Checkout page
│   ├── esewa_payment.php       # eSewa payment initiation
│   ├── esewa_success.php       # Payment success callback
│   ├── esewa_failure.php       # Payment failure handler
│   └── order_success.php       # Order confirmation
│
├── 🛒 Cart Operations (API)
│   ├── add_to_cart.php         # Add item to cart
│   ├── update_cart.php         # Update cart quantity
│   ├── remove_from_cart.php    # Remove from cart
│   ├── get_cart_count.php      # Get cart item count
│   └── get_cart_items.php      # Get all cart items
│
├── 👨‍💼 Admin Panel
│   ├── admin.php               # Admin dashboard
│   ├── admin_login.php         # Admin login
│   ├── manage_products.php     # Manage featured products
│   ├── manage_hot_deals.php    # Manage hot deals
│   ├── manage_all_products.php # Manage all products
│   ├── add_product.php         # Add new product
│   ├── view_users.php          # View registered users
│   └── get_product_categories.php # Get product categories
│
├── 📝 Reviews
│   └── submit_review.php       # Submit product review
│
├── 🔧 Setup Scripts (Run Once)
│   ├── setup_database.php      # Create database
│   ├── setup_products.php      # Create products table
│   ├── setup_categories.php    # Setup categories & products
│   ├── setup_orders.php        # Create orders tables
│   ├── setup_payment.php       # Add payment columns
│   ├── setup_reviews.php       # Create reviews table
│   ├── add_hot_deals_column.php
│   ├── add_product_type_column.php
│   ├── add_specs_columns.php
│   ├── add_user_profile_columns.php
│   └── fix_cart_foreign_key.php
│
├── 🧪 Testing & Utilities
│   ├── system_check.php        # System health check
│   ├── test_cart.php           # Test cart functionality
│   ├── test_currency.php       # Test currency conversion
│   └── update_currency.php     # Update files to NPR
│
├── 📂 Includes
│   └── includes/
│       └── header.php          # Shared header component
│
├── 🎨 Assets
│   ├── Image/                  # Product images & logos
│   ├── uploads/avatars/        # User profile pictures
│   ├── output.css              # Tailwind CSS output
│   ├── input.css               # Tailwind CSS input
│   ├── styles.css              # Custom styles
│   ├── dropdown-fix.css        # Dropdown fixes
│   └── script.js               # JavaScript utilities
│
└── 📄 Documentation
    ├── README.md               # Project documentation
    ├── FILE_ORGANIZATION.md    # This file
    └── update_prices.sql       # SQL for price updates
```

## 🔑 Key Files Explained

### Core Configuration
- **config.php**: Database connection (MySQL on port 3307)
- **currency.php**: Converts USD to NPR (1 USD = 100 NPR)
- **auth.php**: Handles login/signup validation

### Payment Flow
1. User adds items to cart → `add_to_cart.php`
2. Views cart → `cart.php`
3. Proceeds to checkout → `checkout.php`
4. Initiates payment → `esewa_payment.php`
5. eSewa redirects to → `esewa_success.php` or `esewa_failure.php`
6. Shows confirmation → `order_success.php`

### Admin Credentials
- Username: `admin`
- Password: `admin`
- Access: `admin_login.php`

## 🚀 Setup Order

1. Run `setup_database.php` - Creates database
2. Run `setup_categories.php` - Creates tables & adds 100 products
3. Run `setup_orders.php` - Creates order tables
4. Run `setup_payment.php` - Adds payment columns
5. Run `setup_reviews.php` - Creates review table
6. Run `system_check.php` - Verify everything works

## 📊 Database Tables

- **users** - User accounts
- **products** - Product catalog
- **categories** - Product categories
- **product_categories** - Product-category relationships
- **cart** - Shopping cart items
- **orders** - Order records
- **order_items** - Order line items
- **product_reviews** - Product reviews

## 🔒 Security Notes

- Passwords are hashed using `password_hash()`
- SQL injection protected with prepared statements
- Session-based authentication
- CSRF protection needed (future enhancement)

## 🌐 URLs

- Homepage: `http://localhost/techbro/src/index.php`
- Admin: `http://localhost/techbro/src/admin.php`
- System Check: `http://localhost/techbro/src/system_check.php`

## 💡 Tips

- Keep database prices in USD
- Display prices in NPR using `formatPrice()`
- Test mode uses eSewa sandbox
- Product images stored in `Image/` folder
