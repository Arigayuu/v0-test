# Migration Instructions

## Issue: Missing Carts Table

If you encounter the error:

\`\`\`
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'lia_testing.carts' doesn't exist
\`\`\`

This means that the database migrations for the cart system have not been run yet.

## Solution

### Option 1: Using Admin Panel (Recommended)

1. Log in as an admin user
2. Go to Admin Dashboard
3. Navigate to "Migration Status" in the sidebar
4. Click on "Run Missing Migrations" button

### Option 2: Using Command Line

Run the following commands in your terminal:

\`\`\`bash
php artisan migrate --path=database/migrations/2024_03_20_000001_create_carts_table.php
php artisan migrate --path=database/migrations/2024_03_20_000002_add_profile_image_to_users_table.php
\`\`\`

### Option 3: Using Custom Command

Run the following command in your terminal:

\`\`\`bash
php artisan setup:cart
\`\`\`

## Verifying the Fix

After running the migrations:

1. Log in to your account
2. Try accessing the cart page
3. Add products to your cart
4. The error should be resolved and cart functionality should work properly

## Additional Information

The cart system requires two migrations:

1. `2024_03_20_000001_create_carts_table.php` - Creates the carts table
2. `2024_03_20_000002_add_profile_image_to_users_table.php` - Adds profile image support

If you continue to experience issues after running the migrations, please contact support.
