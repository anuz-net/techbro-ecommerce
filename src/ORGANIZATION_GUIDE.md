# TechBro E-Commerce - Organized File Structure

## 📁 New Directory Structure

```
techbro/src/
│
├── 📂 api/                     # API & Cart Operations
│   ├── add_to_cart.php
│   ├── update_cart.php
│   ├── remove_from_cart.php
│   ├── get_cart_count.php
│   ├── get_cart_items.php
│   └── submit_review.php
│
├── 📂 admin/                   # Admin Panel
│   ├── admin.php
│   ├── admin_login.php
│   ├── manage_all_products.php
│   ├── manage_hot_deals.php
│   ├── add_product.php
│   ├── view_users.php
│   └── get_product_categories.php
│
├── 📂 setup/                   # Setup Scripts (Run Once)
│   ├── setup_database.php
│   ├── setup_categories.php
│   ├── setup_orders.php
│   ├── setup_payment.php
│   └── setup_reviews.php
│
├── 📂 tests/                   # Testing & Utilities
│   ├── test_cart.php
│   ├── test_currency.php
│   └── system_check.php
│
├── 📂 includes/                # Shared Components
│   └── header.php
│
├── 📂 assets/                  # Static Assets
│   ├── css/
│   │   ├── output.css
│   │   ├── styles.css
│   │   └── dropdown-fix.css
│   └── js/
│       └── script.js
│
├── 📂 Image/                   # Product Images
│   ├── logo.png
│   ├── favico.png
│   └── [product images]
│
├── 📂 uploads/                 # User Uploads
│   └── avatars/
│
├── 📂 docs/                    # Documentation
│   ├── README.md
│   ├── FILE_ORGANIZATION.md
│   └── update_prices.sql
│
├── 🔧 Core Files (Root)
│   ├── config.php              # Database config
│   ├── currency.php            # Currency helper
│   ├── auth.php                # Authentication
│   ├── paths.php               # Path configuration
│   │
│   ├── index.php               # Homepage
│   ├── product.php             # Product details
│   ├── category.php            # Category page
│   ├── search.php              # Search results
│   ├── cart.php                # Shopping cart
│   │
│   ├── login.php               # User login
│   ├── signup.php              # User signup
│   ├── profile.php             # User profile
│   ├── orders.php              # Order history
│   ├── logout.php              # Logout
│   │
│   ├── checkout.php            # Checkout
│   ├── esewa_payment.php       # Payment init
│   ├── esewa_success.php       # Payment success
│   ├── esewa_failure.php       # Payment failure
│   └── order_success.php       # Order confirm
│
└── organize_files.bat          # Organization script
```

## 🚀 How to Organize

### Option 1: Automatic (Recommended)
Run the batch script:
```bash
cd c:\xampp\htdocs\techbro\src
organize_files.bat
```

### Option 2: Manual
Create folders and move files according to the structure above.

## 📝 After Organization

### Update Include Paths
After moving files, update these references:

**In admin files:**
```php
require_once '../config.php';
require_once '../currency.php';
```

**In API files:**
```php
require_once '../config.php';
```

**In main files (CSS/JS):**
```html
<link href="assets/css/output.css" rel="stylesheet">
<script src="assets/js/script.js"></script>
```

## 🔗 Updated URLs

- Homepage: `http://localhost/techbro/src/index.php`
- Admin: `http://localhost/techbro/src/admin/admin.php`
- System Check: `http://localhost/techbro/src/tests/system_check.php`

## ✅ Benefits

- ✨ Clean root directory
- 📁 Logical file grouping
- 🔍 Easy to find files
- 🛡️ Better security (separate admin)
- 📦 Easier deployment
- 🧹 Professional structure

## 🎯 Quick Access

**Admin Panel:**
- Dashboard: `/admin/admin.php`
- Login: `/admin/admin_login.php`
- Products: `/admin/manage_all_products.php`

**Setup (First Time):**
1. `/setup/setup_database.php`
2. `/setup/setup_categories.php`
3. `/setup/setup_payment.php`
4. `/tests/system_check.php`

**Testing:**
- System Check: `/tests/system_check.php`
- Currency Test: `/tests/test_currency.php`
