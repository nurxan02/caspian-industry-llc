    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <img src="<?php echo BASE_URL; ?>/assets/images/Font+Logo.svg" alt="<?php echo SITE_NAME; ?>" style="height: 78px; margin-bottom: 1rem;   filter: brightness(0) invert(1);">
                    <p><?php echo t('footer_about'); ?></p>
                    <div class="social-links">
                        <?php
                        $db = Database::getInstance()->getConnection();
                        $social_links = [
                            'facebook' => 'fab fa-facebook-f',
                            'linkedin' => 'fab fa-linkedin-in',
                            'instagram' => 'fab fa-instagram',
                            'twitter' => 'fab fa-twitter'
                        ];
                        foreach ($social_links as $platform => $icon) {
                            $stmt = $db->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
                            $stmt->execute([$platform . '_url']);
                            $url = $stmt->fetchColumn();
                            if ($url && $url != '#') {
                                echo "<a href='$url' target='_blank' rel='noopener'><i class='$icon'></i></a>";
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4><?php echo t('footer_quick_links'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo BASE_URL; ?>/index.php"><?php echo t('nav_home'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/pages/about.php"><?php echo t('nav_about'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/pages/news.php"><?php echo t('nav_news'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/pages/projects.php"><?php echo t('nav_projects'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4><?php echo t('nav_gallery'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo BASE_URL; ?>/pages/gallery.php"><?php echo t('nav_gallery'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/pages/partners.php"><?php echo t('nav_partners'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/pages/clients.php"><?php echo t('nav_clients'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/pages/contact.php"><?php echo t('nav_contact'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/pages/faq.php"><?php echo t('nav_faq'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4><?php echo t('footer_contact'); ?></h4>
                    <?php
                    $db = Database::getInstance()->getConnection();
                    $settings = ['contact_email', 'contact_phone', 'contact_address' . Language::getSuffix()];
                    foreach ($settings as $setting) {
                        $stmt = $db->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
                        $stmt->execute([$setting]);
                        $value = $stmt->fetchColumn();
                        if ($value) {
                            if (strpos($setting, 'email') !== false) {
                                echo "<p><i class='fas fa-envelope'></i> <a href='mailto:$value'>$value</a></p>";
                            } elseif (strpos($setting, 'phone') !== false) {
                                echo "<p><i class='fas fa-phone'></i> <a href='tel:$value'>$value</a></p>";
                            } else {
                                echo "<p><i class='fas fa-map-marker-alt'></i> $value</p>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <b><?php echo SITE_NAME; ?>.</b> <?php echo t('footer_rights'); ?>  Developed by <a href="https://nurkhanmasimzada.site" style="text-decoration: none; font-weight: bold;">Masimzada</a></p>
            </div>
        </div>
    </footer>
    <script src="<?php echo BASE_URL; ?>/assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>
