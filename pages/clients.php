<?php require_once '../includes/header.php'; ?>

<style>
.clients-hero {
    padding-top: 120px;
    padding-bottom: var(--spacing-lg);
    background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.85)), url('<?php echo BASE_URL; ?>/assets/images/clients-back.jpg');
    background-size: cover;
    background-position: center;
}

.clients-hero .section-header {
    text-align: center;
}

.clients-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: var(--spacing-md);

    margin-top:1rem;
}

.client-card {
    background: var(--bg-secondary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    text-align: center;
    transition: all var(--transition-normal);
}

.client-card:hover {
    background: var(--bg-tertiary);
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--color-primary);
}

.client-logo {
    max-width: 100%;
    max-height: 100px;
    object-fit: contain;
    margin-bottom: var(--spacing-md);
    filter: grayscale(1) contrast(0.3);
    opacity: 0.7;
    transition: all var(--transition-normal);
}

.client-card:hover .client-logo {
    filter: grayscale(0);
    opacity: 1;
}

.client-name {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: var(--spacing-xs);
    color: var(--text-white);
}

.client-website {
    font-size: 0.875rem;
    color: var(--color-primary);
}
</style>

<!-- Hero Section -->
<section class="page-hero clients-hero">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('nav_clients_tag','OUR CLIENTS'); ?></span>
            <h1 class="section-title"><?php echo t('clients_title','Our Clients'); ?></h1>
            <p class="section-description"><?php echo t('clients_description','We are proud to serve leading business clients'); ?></p>
        </div>
    </div>
</section>

<!-- Clients Grid -->
<section class="section">
    <div class="container">
        <div class="clients-grid">
            <?php
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT * FROM clients ORDER BY sort_order ASC");
            $clients = $stmt->fetchAll();
            
            if (count($clients) > 0) {
                foreach ($clients as $client) {
                    $logo = BASE_URL . '/assets/uploads/' . $client['logo'];
                    ?>
                    <div class="client-card">
                        <img src="<?php echo $logo; ?>" alt="<?php echo htmlspecialchars($client['name']); ?>" class="client-logo">
                        <div class="client-name"><?php echo htmlspecialchars($client['name']); ?></div>
                        <?php if ($client['website']): ?>
                            <a href="<?php echo htmlspecialchars($client['website']); ?>" target="_blank" rel="noopener" class="client-website">
                                <i class="fas fa-external-link-alt"></i> <?php echo t('visit_website','Visit Website'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align: center; padding: var(--spacing-xl);">';
                echo '<i class="fas fa-users" style="font-size: 4rem; color: var(--color-primary); margin-bottom: var(--spacing-md);"></i>';
                echo '<p style="color: var(--text-secondary);">' . t('clients_no_items','No clients have been added yet.') . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>
