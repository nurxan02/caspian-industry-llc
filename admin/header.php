<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../includes/database.php';

if (isset($_GET['logout'])) {
    adminLogout();
    header('Location: ' . BASE_URL . '/admin/login.php');
    exit;
}

requireAdmin();

$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?php echo SITE_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/admin.css">
</head>
<body>
    <div class="admin-wrapper">

        <aside class="admin-sidebar">
            <div class="admin-logo">
                <img src="<?php echo BASE_URL; ?>/assets/images/logo.svg" alt="<?php echo SITE_NAME; ?>" style="height: 40px;  filter: brightness(0) invert(1);">
                <span>Admin Panel</span>
            </div>
            
            <nav class="admin-nav">
                <a href="<?php echo BASE_URL; ?>/admin/index.php" class="admin-nav-item <?php echo $current_page == 'index' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/contacts.php" class="admin-nav-item <?php echo $current_page == 'contacts' ? 'active' : ''; ?>">
                    <i class="fas fa-envelope"></i> Contact Forms
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/news.php" class="admin-nav-item <?php echo $current_page == 'news' ? 'active' : ''; ?>">
                    <i class="fas fa-newspaper"></i> News
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/projects.php" class="admin-nav-item <?php echo $current_page == 'projects' ? 'active' : ''; ?>">
                    <i class="fas fa-project-diagram"></i> Projects
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/gallery.php" class="admin-nav-item <?php echo $current_page == 'gallery' ? 'active' : ''; ?>">
                    <i class="fas fa-images"></i> Gallery
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/partners.php" class="admin-nav-item <?php echo $current_page == 'partners' ? 'active' : ''; ?>">
                    <i class="fas fa-handshake"></i> Partners
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/clients.php" class="admin-nav-item <?php echo $current_page == 'clients' || $current_page == 'clients-edit' ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i> Clients
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/faq.php" class="admin-nav-item <?php echo $current_page == 'faq' ? 'active' : ''; ?>">
                    <i class="fas fa-question-circle"></i> FAQ
                </a>
                <a href="<?php echo BASE_URL; ?>/admin/settings.php" class="admin-nav-item <?php echo $current_page == 'settings' ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </nav>
            
            <div class="admin-user">
                <div style="margin-bottom: 1rem;">
                    <i class="fas fa-user-circle" style="font-size: 2rem;"></i>
                    <div style="margin-top: 0.5rem; font-weight: 600;"><?php echo $_SESSION['admin_username']; ?></div>
                </div>
                <a href="?logout=1" class="btn btn-outline" style="width: 100%; font-size: 0.875rem;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </aside>
        
        <main class="admin-main">
            <div class="admin-header">
                <h1><?php echo ucfirst(str_replace('-', ' ', $current_page)); ?></h1>
                <div>
                    <a href="<?php echo BASE_URL; ?>/" target="_blank" class="btn btn-outline">
                        <i class="fas fa-external-link-alt"></i> View Site
                    </a>
                </div>
            </div>
            
            <div class="admin-content">
