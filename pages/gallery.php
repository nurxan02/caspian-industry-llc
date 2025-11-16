<?php require_once '../includes/header.php'; ?>

<style>
.gallery-board {
    background: transparent;
    padding: 0;
    border-radius: 0;
    box-shadow: none;
}

.gallery-grid {
    column-count: 3;
    column-gap: clamp(10px, 1.5vw, 18px);
}

@media (max-width: 1024px) {
    .gallery-grid { column-count: 2; }
}
@media (max-width: 640px) {
    .gallery-grid { column-count: 1; }
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 0;
    cursor: pointer;
    background: transparent;
    box-shadow: 0 8px 20px rgba(0,0,0,0.35);
    transition: transform .2s ease, box-shadow .3s ease;
    display: inline-block;
    width: 100%;
    margin: 0 0 clamp(10px, 1.5vw, 18px);
    break-inside: avoid;
    -webkit-column-break-inside: avoid;
    column-break-inside: avoid;
}

.gallery-media {
    display: block;
}
.gallery-media img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform .35s ease;
}

.gallery-item:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,0.25); }
.gallery-item:hover .gallery-media img { transform: scale(1.05); }

.gallery-caption {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 14px 16px;
    color: #fff;
    font-weight: 500;
    font-size: 0.95rem;
    letter-spacing: .2px;
    background: linear-gradient(0deg, rgba(13, 74, 167, 0.9) 0%, rgba(31,111,235,0.45) 35%, rgba(31,111,235,0.0) 90%);
    opacity: 0;
    transform: translateY(10px);
    transition: opacity .25s ease, transform .25s ease;
    pointer-events: none;
}

.gallery-item:hover .gallery-caption {
    opacity: 1;
    transform: translateY(0);
}
</style>


<section class="page-hero" style="padding-top: 120px; padding-bottom: var(--spacing-lg); background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.85)), url('<?php echo BASE_URL; ?>/assets/images/gallery-back.jpeg'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('nav_gallery_tag','GALLERY'); ?></span>
            <h1 class="section-title"><?php echo t('gallery_title'); ?></h1>
            <p class="section-description"><?php echo t('gallery_description','Browse through our collection of images'); ?></p>
        </div>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="gallery-board">
        <div class="gallery-grid">
            <?php
            $db = Database::getInstance()->getConnection();
            $lang_suffix = Language::getSuffix();
            $stmt = $db->query("SELECT * FROM gallery ORDER BY sort_order ASC");
            $images = $stmt->fetchAll();
            
            if (count($images) > 0) {
                foreach ($images as $item) {
                    $title = $item['title' . $lang_suffix] ?: 'Gallery Image';
                    $image = BASE_URL . '/assets/uploads/' . $item['image'];
                    $classes = 'gallery-item';
                    ?>
                    <div class="<?php echo $classes; ?>">
                        <div class="gallery-media">
                            <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>">
                        </div>
                        <div class="gallery-caption"><?php echo htmlspecialchars($title); ?></div>
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
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initGallery();
});
</script>

<?php require_once '../includes/footer.php'; ?>
