<?php require_once '../includes/header.php'; ?>

<style>
.partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: var(--spacing-md);
}

.partner-card {
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    text-align: center;
    transition: all var(--transition-normal);
}

.partner-card:hover {
    background: var(--bg-card-hover);
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(107, 168, 214, 0.3);
}

.partner-logo {
    max-width: 100%;
    max-height: 100px;
    object-fit: contain;
    margin-bottom: var(--spacing-md);
    filter: grayscale(1) contrast(0.3);
    opacity: 0.7;
    transition: all var(--transition-normal);
}

.partner-card:hover .partner-logo {
    filter: grayscale(0);
    opacity: 1;
}

.partner-name {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: var(--spacing-xs);
}

.partner-website {
    font-size: 0.875rem;
    color: var(--color-secondary);
}
</style>


<section class="page-hero" style="padding-top: 120px; padding-bottom: var(--spacing-lg); background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.85)), url('<?php echo BASE_URL; ?>/assets/images/partner-back.jpg'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('nav_partners_tag','PARTNERS'); ?></span>
            <h1 class="section-title"><?php echo t('partners_title'); ?></h1>
            <p class="section-description"><?php echo t('partners_description','We are proud to work with industry-leading partners'); ?></p>
        </div>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="partners-grid">
            <?php
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT * FROM partners ORDER BY sort_order ASC");
            $partners = $stmt->fetchAll();
            
            if (count($partners) > 0) {
                foreach ($partners as $partner) {
                    $logo = BASE_URL . '/assets/uploads/' . $partner['logo'];
                    ?>
                    <div class="partner-card">
                        <img src="<?php echo $logo; ?>" alt="<?php echo htmlspecialchars($partner['name']); ?>" class="partner-logo">
                        <div class="partner-name"><?php echo htmlspecialchars($partner['name']); ?></div>
                        <?php if ($partner['website']): ?>
                            <a href="<?php echo htmlspecialchars($partner['website']); ?>" target="_blank" rel="noopener" class="partner-website">
                                <i class="fas fa-external-link-alt"></i> <?php echo t('visit_website','Visit Website'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align: center; padding: var(--spacing-xl);">';
                echo '<i class="fas fa-handshake" style="font-size: 4rem; color: var(--color-secondary); margin-bottom: var(--spacing-md);"></i>';
                echo '<p style="color: var(--text-secondary);">' . t('partners_no_items') . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>
