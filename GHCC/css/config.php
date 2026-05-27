<?php
/**
 * Church Website Configuration File
 */

// Start session
session_start();

// Site Configuration
define('SITE_NAME', 'GHCC');
define('SITE_URL', 'https://tes.web.ghccng.org');
define('SITE_EMAIL', 'info@ghccng.org');
define('SITE_PHONE', '(+234) 703 090 7726');

// Church Address
define('CHURCH_ADDRESS', '7 Raimi Omole Street, Ilesa 233285, Osun');
define('CHURCH_LAT', '40.7128'); // Latitude for map
define('CHURCH_LNG', '-74.0060'); // Longitude for map

// Color Scheme
define('COLOR_PRIMARY', '#1E7A2B');
define('COLOR_SECONDARY', '#F6FB0D');
define('COLOR_LIGHT', '#FFFFFF');

// File upload paths
define('UPLOAD_PATH', dirname(__DIR__) . '/uploads/');
define('MESSAGES_PATH', UPLOAD_PATH . 'messages/');
define('MAX_FILE_SIZE', 104857600); // 100MB for messages

// Ensure upload directories exist
if (!file_exists(MESSAGES_PATH)) {
    mkdir(MESSAGES_PATH, 0777, true);
}

// Include database connection
require_once 'database.php';

// Include functions
require_once 'functions.php';

// Set default timezone
date_default_timezone_set('America/New_York');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>