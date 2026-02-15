# TechBro - Updated File Structure

## ✅ Changes Applied

### 📁 New Directory Structure
```
techbro/src/
├── api/                    # Cart & API operations
│   ├── add_to_cart.php
│   ├── get_cart_count.php
│   ├── get_cart_items.php
│   ├── remove_from_cart.php
│   ├── update_cart.php
│   └── submit_review.php
│
├── admin/                  # Admin panel
│   ├── admin.php
│   ├── admin_login.php
│   ├── add_product.php
│   ├── manage_all_products.php
│   ├── manage_hot_deals.php
│   ├── view_users.php
│   └── get_product_categories.php
│
├── includes/               # Shared components
│   └── header.php
│
├── Image/                  # Product images
├── uploads/                # User uploads
│
└── Root Files (Main Pages)
    ├── config.php
    ├── currency.php
    ├── auth.php
    ├── index.php
    ├── product.php
    ├── category.php
    ├── search.php
    ├── cart.php
    ├── checkout.php
    ├── login.php
    ├── signup.php
    ├── profile.php
    ├── orders.php
    ├── logout.php
    ├── esewa_payment.php
    ├── esewa_success.php
    ├── esewa_failure.php
    └── order_success.php
```

## 🔧 Path Updates Applied

### API Files (api/)
- All require `require_once '../config.php';`
- Called from main pages as `api/add_to_cart.php`

### Admin Files (admin/)
- All require `require_once '../config.php';`
- CSS: `<link href="../output.css">`
- Images: `<img src="../Image/logo.png">`
- Links: `<a href="../index.php">`, `<a href="../logout.php">`

### Header File (includes/header.php)
- API calls updated to `api/` prefix
- `fetch('api/get_cart_count.php')`
- `fetch('api/get_cart_items.php')`
- `fetch('api/update_cart.php')`
- `fetch('api/remove_from_cart.php')`

### Main Pages (Root)
- API calls: `fetch('api/add_to_cart.php')`
- API calls: `fetch('api/submit_review.php')`

## 🌐 URLs After Organization

- Homepage: `http://localhost/techbro/src/index.php`
- Admin: `http://localhost/techbro/src/admin/admin.php`
- Admin Login: `http://localhost/techbro/src/admin/admin_login.php`
- API Endpoints: `http://localhost/techbro/src/api/add_to_cart.php`

## ✅ All Files Updated
- ✓ api/add_to_cart.php
- ✓ api/get_cart_count.php
- ✓ api/get_cart_items.php
- ✓ api/remove_from_cart.php
- ✓ api/update_cart.php
- ✓ api/submit_review.php
- ✓ admin/admin.php
- ✓ admin/admin_login.php
- ✓ admin/add_product.php
- ✓ admin/manage_all_products.php
- ✓ admin/manage_hot_deals.php
- ✓ admin/view_users.php
- ✓ admin/get_product_categories.php
- ✓ includes/header.php
- ✓ index.php
- ✓ product.php
- ✓ category.php
- ✓ search.php

## 🚀 Ready to Use
Your TechBro e-commerce site is now organized and all paths are updated correctly!
