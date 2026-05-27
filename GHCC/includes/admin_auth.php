<?php
// Admin authentication functions
session_start();

// Check if admin is logged in
function isAdminLoggedIn() {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        // Check session expiration
        if (isset($_SESSION['admin_session_expire']) && $_SESSION['admin_session_expire'] > time()) {
            return true;
        } else {
            // Session expired
            adminLogout();
            return false;
        }
    }
    return false;
}

// Require admin login
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Admin logout
function adminLogout() {
    $_SESSION = array();
    
    // Destroy the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
}

// Get admin username
function getAdminUsername() {
    return isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin';
}

// Get admin last login time
function getAdminLastLogin() {
    return isset($_SESSION['admin_last_login']) ? date('F j, Y g:i A', $_SESSION['admin_last_login']) : 'Never';
}

// Check admin permissions (for future role-based access)
function checkAdminPermission($permission) {
    // For now, all admins have all permissions
    // In a real application, you would check against user roles/permissions
    return isAdminLoggedIn();
}
?>