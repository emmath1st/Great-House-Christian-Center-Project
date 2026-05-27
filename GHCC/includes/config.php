<?php
// Database configuration
define('DB_HOST', 'localhost:3306');
define('DB_USER', 'ghcc_emma');
define('DB_PASS', 'Ghcc_web');
define('DB_NAME', 'ghccmain');

// Website configuration
define('SITE_NAME', 'Grate House');
define('SITE_URL', 'https://tes.web.ghccng.org//');
define('CHURCH_ADDRESS', '123 Faith Avenue, Springfield, ST 12345');
define('CHURCH_PHONE', '(555) 123-4567');
define('CHURCH_EMAIL', 'info@gracecommunitychurch.org');

// File upload configuration
define('MAX_UPLOAD_SIZE', 50 * 1024 * 1024); // 50MB
define('ALLOWED_FILE_TYPES', ['mp3', 'wav', 'pdf', 'doc', 'docx', 'txt']);
define('UPLOAD_PATH', 'uploads/');

// Google Maps API Key (Replace with your own)
define('GOOGLE_MAPS_API_KEY', 'YOUR_GOOGLE_MAPS_API_KEY_HERE');

// Admin configuration
define('ADMIN_PATH', 'admin/');
define('ADMIN_SESSION_TIMEOUT', 8 * 3600); // 8 hours in seconds
define('ADMIN_LOGIN_ATTEMPTS', 5);
define('ADMIN_LOCKOUT_TIME', 15 * 60); // 15 minutes in seconds

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>