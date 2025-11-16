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
    <link rel="icon" type="image/svg+xml" href="<?php echo BASE_URL; ?>/assets/images/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <div class="mobile-language-dropdown">
                <button class="mobile-lang-toggle" id="mobile-lang-toggle" aria-label="Select language" aria-expanded="false">
                    <i class="fas fa-globe"></i>
                </button>
                <div class="mobile-lang-menu" id="mobile-lang-menu">
                    <a href="?lang=en" class="<?php echo Language::getCurrentLang() == 'en' ? 'active' : ''; ?>">EN</a>
                    <a href="?lang=ru" class="<?php echo Language::getCurrentLang() == 'ru' ? 'active' : ''; ?>">RU</a>
                    <a href="?lang=az" class="<?php echo Language::getCurrentLang() == 'az' ? 'active' : ''; ?>">AZ</a>
                </div>
            </div>
            
            <a href="<?php echo BASE_URL; ?>/index.php" class="navbar-logo">
                <picture>
                    <!-- <source media="(max-width: 768px)" srcset="<?php echo BASE_URL; ?>/assets/images/logo.svg"> -->
                    <img src="<?php echo BASE_URL; ?>/assets/images/Font+Logo.svg" alt="<?php echo SITE_NAME; ?>">
                </picture>
            </a>
            
            <button class="navbar-toggle" id="navbar-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <div class="navbar-center">
                <ul class="navbar-menu" id="navbar-menu">
                    <li><a href="<?php echo BASE_URL; ?>/index.php" class="<?php echo $current_page == 'index' ? 'active' : ''; ?>"><?php echo t('nav_home','Home'); ?></a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/news.php" class="<?php echo $current_page == 'news' ? 'active' : ''; ?>"><?php echo t('nav_news','News'); ?></a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/projects.php" class="<?php echo $current_page == 'projects' ? 'active' : ''; ?>"><?php echo t('nav_projects','Projects'); ?></a></li>
                    <li class="navbar-dropdown">
                        <a href="<?php echo BASE_URL; ?>/pages/about.php" class="<?php echo ($current_page == 'about' || $current_page == 'partners' || $current_page == 'clients' || $current_page == 'faq') ? 'active' : ''; ?>">
                            <?php echo t('nav_about','About'); ?>
                        </a>
                        <ul class="navbar-dropdown-menu">
                            <li><a href="<?php echo BASE_URL; ?>/pages/about.php"><?php echo t('nav_about','About'); ?></a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/careers.php"><?php echo t('nav_careers','Careers'); ?></a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/partners.php"><?php echo t('nav_partners','Partners'); ?></a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/clients.php"><?php echo t('nav_clients','Our Clients'); ?></a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/gallery.php"><?php echo t('nav_gallery','Gallery'); ?></a></li>
                            <li><a href="<?php echo BASE_URL; ?>/pages/faq.php"><?php echo t('nav_faq','FAQ'); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/contact.php" class="<?php echo $current_page == 'contact' ? 'active' : ''; ?>"><?php echo t('nav_contact','Contact'); ?></a></li>
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
    <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>
        <div class="mobile-menu-panel" role="dialog" aria-modal="true" aria-labelledby="mobile-menu-title">
            <ul class="mobile-menu-links">
                <li><a href="<?php echo BASE_URL; ?>/index.php"><?php echo t('nav_home','Home'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/news.php"><?php echo t('nav_news','News'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/projects.php"><?php echo t('nav_projects','Projects'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/about.php"><?php echo t('nav_about','About'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/careers.php"><?php echo t('nav_careers','Careers'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/clients.php"><?php echo t('nav_clients','Our Clients'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/partners.php"><?php echo t('nav_partners','Partners'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/gallery.php"><?php echo t('nav_gallery','Gallery'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/faq.php"><?php echo t('nav_faq','FAQ'); ?></a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/contact.php"><?php echo t('nav_contact','Contact'); ?></a></li>
            </ul>
        </div>
    </div>
