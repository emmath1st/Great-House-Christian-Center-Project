<?php
// Start output buffering
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' : ''; ?><?php echo SITE_NAME; ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Styles -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="contact-info">
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo CHURCH_ADDRESS; ?></span>
                    <span><i class="fas fa-phone"></i> <?php echo CHURCH_PHONE; ?></span>
                    <span><i class="fas fa-envelope"></i> <?php echo CHURCH_EMAIL; ?></span>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Header & Navigation -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="logo">
                    <a href="index.php">
                        <div class="logo-icon">
                            <i class="fas fa-church"></i>
                        </div>
                        <div class="logo-text">
                            <h1><?php echo SITE_NAME; ?></h1>
                            <p>Where Faith Grows & Community Flourishes</p>
                        </div>
                    </a>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Navigation -->
                <nav class="main-nav" id="mainNav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="fas fa-home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="about.php" class="nav-link">
                                <i class="fas fa-info-circle"></i>
                                <span>About</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="connect.php" class="nav-link">
                                <i class="fas fa-handshake"></i>
                                <span>Connect</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="watch.php" class="nav-link">
                                <i class="fas fa-video"></i>
                                <span>Watch</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="care.php" class="nav-link">
                                <i class="fas fa-heart"></i>
                                <span>Care</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="give.php" class="nav-link">
                                <i class="fas fa-donate"></i>
                                <span>Give</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="blog.php" class="nav-link">
                                <i class="fas fa-blog"></i>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle">
                                <i class="fas fa-volume-up"></i>
                                <span>Messages</span>
                                <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="download-messages.php"><i class="fas fa-download"></i> Download</a></li>
                                <li><a href="upload-message.php"><i class="fas fa-upload"></i> Upload</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Page Banner -->
    <?php if (isset($page_title)): ?>
    <section class="page-banner">
        <div class="container">
            <h2><?php echo $page_title; ?></h2>
            <div class="breadcrumb">
                <a href="index.php">Home</a> / <span><?php echo $page_title; ?></span>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- Main Content Container -->
    <main class="main-content">