<?php
require_once '../../includes/config.php';
require_once '../../includes/admin_auth.php';
requireAdminLogin();

$page_title = isset($page_title) ? $page_title : 'Admin Dashboard';
$admin_username = getAdminUsername();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - <?php echo SITE_NAME; ?> Admin</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Bootstrap CSS (for modals and components) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary-green: #1E7A2B;
            --accent-yellow: #F6FB0D;
            --pure-white: #FFFFFF;
            --light-gray: #F8F9FA;
            --medium-gray: #6C757D;
            --dark-gray: #343A40;
            --admin-sidebar: #155d20;
            --admin-sidebar-hover: #0f4718;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-gray);
            overflow-x: hidden;
        }
        
        /* Admin Layout */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .admin-sidebar {
            width: 250px;
            background-color: var(--admin-sidebar);
            color: var(--pure-white);
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .sidebar-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 5px;
        }
        
        .sidebar-header p {
            font-size: 0.8rem;
            opacity: 0.8;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .sidebar-menu ul {
            list-style: none;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu a:hover {
            background-color: var(--admin-sidebar-hover);
            color: var(--pure-white);
            border-left-color: var(--accent-yellow);
        }
        
        .sidebar-menu a.active {
            background-color: var(--admin-sidebar-hover);
            color: var(--pure-white);
            border-left-color: var(--accent-yellow);
        }
        
        .sidebar-menu i {
            width: 25px;
            font-size: 1.1rem;
            margin-right: 10px;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 0.8rem;
            opacity: 0.7;
        }
        
        /* Main Content */
        .admin-main {
            flex: 1;
            margin-left: 250px;
            transition: all 0.3s ease;
        }
        
        .admin-header {
            background-color: var(--pure-white);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .header-left h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            color: var(--primary-green);
            margin-bottom: 5px;
        }
        
        .header-left p {
            font-size: 0.9rem;
            color: var(--medium-gray);
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: var(--primary-green);
            color: var(--pure-white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .user-info h4 {
            font-size: 0.95rem;
            margin-bottom: 2px;
        }
        
        .user-info p {
            font-size: 0.8rem;
            color: var(--medium-gray);
        }
        
        .logout-btn {
            background-color: var(--primary-green);
            color: var(--pure-white);
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .logout-btn:hover {
            background-color: var(--accent-yellow);
            color: var(--dark-gray);
        }
        
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--primary-green);
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        /* Content Area */
        .admin-content {
            padding: 25px;
            min-height: calc(100vh - 80px);
        }
        
        /* Cards */
        .admin-card {
            background-color: var(--pure-white);
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border-top: 4px solid var(--primary-green);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .card-header h3 {
            font-family: 'Montserrat', sans-serif;
            color: var(--dark-gray);
            font-size: 1.3rem;
            margin: 0;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: var(--pure-white);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }
        
        .stat-icon.users { background-color: rgba(30, 122, 43, 0.1); color: var(--primary-green); }
        .stat-icon.posts { background-color: rgba(246, 251, 13, 0.1); color: var(--accent-yellow); }
        .stat-icon.messages { background-color: rgba(52, 152, 219, 0.1); color: #3498db; }
        .stat-icon.donations { background-color: rgba(155, 89, 182, 0.1); color: #9b59b6; }
        
        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 5px;
            color: var(--dark-gray);
        }
        
        .stat-info p {
            font-size: 0.9rem;
            color: var(--medium-gray);
        }
        
        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--pure-white);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .data-table thead {
            background-color: var(--primary-green);
            color: var(--pure-white);
        }
        
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .data-table tbody tr:hover {
            background-color: rgba(30, 122, 43, 0.05);
        }
        
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: var(--primary-green);
            color: var(--pure-white);
            border: none;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
        
        .btn:hover {
            background-color: var(--accent-yellow);
            color: var(--dark-gray);
        }
        
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
        }
        
        .btn-danger {
            background-color: #e74c3c;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            color: var(--pure-white);
        }
        
        .btn-warning {
            background-color: #f39c12;
        }
        
        .btn-warning:hover {
            background-color: #d35400;
            color: var(--pure-white);
        }
        
        .btn-success {
            background-color: #27ae60;
        }
        
        .btn-success:hover {
            background-color: #229954;
            color: var(--pure-white);
        }
        
        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-green);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 122, 43, 0.2);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        /* Alerts */
        .alert {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.active {
                transform: translateX(0);
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .admin-content {
                padding: 15px;
            }
            
            .admin-header {
                padding: 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .header-right {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-church"></i> <?php echo SITE_NAME; ?></h2>
                <p>Administration Panel</p>
            </div>
            
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="blog-posts.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog-posts.php' ? 'active' : ''; ?>">
                            <i class="fas fa-blog"></i> Blog Posts
                        </a>
                    </li>
                    <li>
                        <a href="messages.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'active' : ''; ?>">
                            <i class="fas fa-volume-up"></i> Messages
                        </a>
                    </li>
                    <li>
                        <a href="events.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : ''; ?>">
                            <i class="fas fa-calendar-alt"></i> Events
                        </a>
                    </li>
                    <li>
                        <a href="users.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="donations.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'donations.php' ? 'active' : ''; ?>">
                            <i class="fas fa-donate"></i> Donations
                        </a>
                    </li>
                    <li>
                        <a href="prayer-requests.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'prayer-requests.php' ? 'active' : ''; ?>">
                            <i class="fas fa-pray"></i> Prayer Requests
                        </a>
                    </li>
                    <li>
                        <a href="contact-submissions.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact-submissions.php' ? 'active' : ''; ?>">
                            <i class="fas fa-envelope"></i> Contact Submissions
                        </a>
                    </li>
                    <li>
                        <a href="settings.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a href="backup.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'backup.php' ? 'active' : ''; ?>">
                            <i class="fas fa-database"></i> Backup
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="sidebar-footer">
                <p>Admin Panel v1.0</p>
                <p><?php echo date('Y'); ?> &copy; <?php echo SITE_NAME; ?></p>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-left">
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1><?php echo $page_title; ?></h1>
                    <p>Welcome back, <?php echo $admin_username; ?>! Last login: <?php echo getAdminLastLogin(); ?></p>
                </div>
                
                <div class="header-right">
                    <div class="admin-user">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($admin_username, 0, 1)); ?>
                        </div>
                        <div class="user-info">
                            <h4><?php echo $admin_username; ?></h4>
                            <p>Administrator</p>
                        </div>
                    </div>
                    
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </header>
            
            <!-- Content -->
            <div class="admin-content">