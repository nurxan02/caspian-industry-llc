<?php require_once '../includes/header.php'; ?>

<style>
.page-hero {
    padding-top: 120px;
    padding-bottom: var(--spacing-lg);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: var(--spacing-md);
}

.news-card {
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: all var(--transition-normal);
}

.news-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(107, 168, 214, 0.3);
}

.news-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.news-content {
    padding: var(--spacing-md);
}

.news-date {
    color: var(--color-secondary);
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: var(--spacing-xs);
}
</style>

<!-- Hero Section -->
<section class="page-hero"style="background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.85)), url('<?php echo BASE_URL; ?>/assets/images/news-back.jpg'); background-size: cover; background-position: center; ">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('nav_news_tag','NEWS'); ?></span>
            <h1 class="section-title"><?php echo t('news_title'); ?></h1>
            <p class="section-description"><?php echo t('news_description','Stay updated with our latest news and announcements'); ?></p>
        </div>
    </div>
</section>

<!-- News Grid -->
<section class="section">
    <div class="container">
        <div class="news-grid">
            <?php
            $db = Database::getInstance()->getConnection();
            $lang_suffix = Language::getSuffix();
            $stmt = $db->query("SELECT * FROM news WHERE is_published = 1 ORDER BY published_date DESC");
            $news = $stmt->fetchAll();
            
            if (count($news) > 0) {
                foreach ($news as $item) {
                    $title = $item['title' . $lang_suffix];
                    $excerpt = $item['excerpt' . $lang_suffix] ?: substr(strip_tags($item['content' . $lang_suffix]), 0, 150) . '...';
                    $image = $item['image'] ? BASE_URL . '/assets/uploads/' . $item['image'] : BASE_URL . '/assets/images/placeholder.jpg';
                    $date = date('F j, Y', strtotime($item['published_date']));
                    ?>
                    <div class="news-card">
                        <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="news-image">
                        <div class="news-content">
                            <div class="news-date">
                                <i class="far fa-calendar"></i> <?php echo $date; ?>
                            </div>
                            <h3><?php echo htmlspecialchars($title); ?></h3>
                            <p style="color: var(--text-secondary); margin: var(--spacing-sm) 0;">
                                <?php echo htmlspecialchars($excerpt); ?>
                            </p>
                            <a href="<?php echo BASE_URL; ?>/pages/news-detail.php?id=<?php echo $item['id']; ?>" class="btn btn-outline">
                                <?php echo t('news_read_more'); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align: center; padding: var(--spacing-xl);">';
                echo '<i class="fas fa-newspaper" style="font-size: 4rem; color: var(--color-secondary); margin-bottom: var(--spacing-md);"></i>';
                echo '<p style="color: var(--text-secondary);">' . t('news_no_items') . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>
