<?php require_once '../includes/header.php'; ?>

<style>
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: var(--spacing-md);
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: var(--radius-lg);
    cursor: pointer;
    aspect-ratio: 1;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-normal);
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    padding: var(--spacing-md);
    opacity: 0;
    transition: opacity var(--transition-normal);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}
</style>

<!-- Hero Section -->
<section class="page-hero" style="padding-top: 120px; padding-bottom: var(--spacing-lg); background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('nav_gallery'); ?></span>
            <h1 class="section-title"><?php echo t('gallery_title'); ?></h1>
            <p class="section-description">Browse through our collection of images</p>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="section">
    <div class="container">
        <div class="gallery-grid">
            <?php
            $db = Database::getInstance()->getConnection();
            $lang_suffix = Language::getSuffix();
            $stmt = $db->query("SELECT * FROM gallery ORDER BY sort_order ASC");
            $images = $stmt->fetchAll();
            
            if (count($images) > 0) {
                foreach ($images as $item) {
                    $title = $item['title' . $lang_suffix] ?: 'Gallery Image';
                    $image = '/assets/uploads/' . $item['image'];
                    ?>
                    <div class="gallery-item">
                        <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>">
                        <div class="gallery-overlay">
                            <h4><?php echo htmlspecialchars($title); ?></h4>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align: center; padding: var(--spacing-xl);">';
                echo '<i class="fas fa-images" style="font-size: 4rem; color: var(--color-secondary); margin-bottom: var(--spacing-md);"></i>';
                echo '<p style="color: var(--text-secondary);">' . t('gallery_no_items') . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initGallery();
});
</script>

<?php require_once '../includes/footer.php'; ?>
