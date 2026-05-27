<?php
require_once '../includes/admin_auth.php';

adminLogout();

// Redirect to login page
header('Location: login.php');
exit;
?>