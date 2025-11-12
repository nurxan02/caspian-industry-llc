<?php
// Database configuration
define('DB_PATH', __DIR__ . '/../database/caspian_industry.db');

// Site configuration
define('SITE_NAME', 'Caspian Industry');
define('DEFAULT_LANG', 'en');
define('AVAILABLE_LANGS', ['en', 'ru', 'az']);

// Base URL configuration - PHP built-in server
define('BASE_URL', '');

// Upload directories
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Admin credentials (in production, use hashed passwords)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD_HASH', password_hash('admin123', PASSWORD_DEFAULT));

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
session_start();

// Timezone
date_default_timezone_set('Asia/Baku');
