<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/language.php';

$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="<?php echo Language::getCurrentLang(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo t('nav_' . $current_page, ucfirst($current_page)); ?></title>
    <meta name="description" content="<?php echo t('hero_subtitle'); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo BASE_URL; ?>/assets/images/logo.svg">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    
    <!-- Three.js for 3D effects -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    
    <!-- Vanta.js NET Effect -->
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="<?php echo BASE_URL; ?>/index.php" class="navbar-logo">
                <img src="<?php echo BASE_URL; ?>/assets/images/Font+Logo.svg" alt="<?php echo SITE_NAME; ?>">
            </a>
            
            <button class="navbar-toggle" id="navbar-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <div class="navbar-center">
                <ul class="navbar-menu" id="navbar-menu">
                    <li><a href="<?php echo BASE_URL; ?>/index.php" class="<?php echo $current_page == 'index' ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/news.php" class="<?php echo $current_page == 'news' ? 'active' : ''; ?>">News</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/projects.php" class="<?php echo $current_page == 'projects' ? 'active' : ''; ?>">Projects</a></li>
                    <li class="navbar-dropdown">
                        <a href="<?php echo BASE_URL; ?>/pages/about.php" class="<?php echo ($current_page == 'about' || $current_page == 'partners' || $current_page == 'faq') ? 'active' : ''; ?>">
                            About
                        </a>
                        <ul class="navbar-dropdown-menu">
                            <li><a href="<?php echo BASE_URL; ?>/pages/about.php">Company Info</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/partners.php">Partners</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/gallery.php">Gallery</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/faq.php">FAQ</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/contact.php" class="<?php echo $current_page == 'contact' ? 'active' : ''; ?>">Contact</a></li>
                </ul>
            </div>
            
            <div class="navbar-actions">
                <div class="language-switcher">
                    <a href="?lang=en" class="<?php echo Language::getCurrentLang() == 'en' ? 'active' : ''; ?>">EN</a>
                    <a href="?lang=ru" class="<?php echo Language::getCurrentLang() == 'ru' ? 'active' : ''; ?>">RU</a>
                    <a href="?lang=az" class="<?php echo Language::getCurrentLang() == 'az' ? 'active' : ''; ?>">AZ</a>
                </div>
            </div>
        </div>
    </nav>
