<?php
/**
 * Configuration for Stripe and Mail
 * 
 * TODO: 実際のキーとメールアドレスに書き換えてください。
 */

// Stripe API Key (Test mode)
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_YOUR_PUBLISHABLE_KEY');
define('STRIPE_SECRET_KEY', 'sk_test_YOUR_SECRET_KEY');

// Product Settings
define('PRODUCT_NAME', '自律思考AIエージェント体験会');
define('PRODUCT_PRICE', 3000); // JPY
define('CURRENCY', 'jpy');

// Email Settings
define('ADMIN_EMAIL', 'admin@example.com'); // 管理者通知先
define('FROM_EMAIL', 'no-reply@example.com'); // 送信元
define('FROM_NAME', '自律思考AIエージェント事務局');

// Site URL (Automatically detect for redirects)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']));
