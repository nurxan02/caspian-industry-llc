<?php 
require_once '../includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$db = Database::getInstance()->getConnection();
$lang_suffix = Language::getSuffix();

$stmt = $db->prepare("SELECT * FROM news WHERE id = ? AND is_published = 1");
$stmt->execute([$id]);
$news = $stmt->fetch();

if (!$news) {
    header('Location: ' . BASE_URL . '/pages/news.php');
    exit;
}

$title = $news['title' . $lang_suffix];
$content = $news['content' . $lang_suffix];
$image = $news['image'] ? BASE_URL . '/assets/uploads/' . $news['image'] : BASE_URL . '/assets/images/placeholder.jpg';
$date = date('F j, Y', strtotime($news['published_date']));
?>

<style>
.article-hero {
    padding-top: 120px;
    padding-bottom: var(--spacing-lg);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);
}

.article-image {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
    border-radius: var(--radius-lg);
    margin: var(--spacing-lg) 0;
}

.article-content {
    max-width: 800px;
    margin: 0 auto;
}

.article-content p {
    font-size: 1.125rem;
    line-height: 1.8;
    margin-bottom: var(--spacing-md);
}
</style>

<section class="article-hero">
    <div class="container">
        <a href="<?php echo BASE_URL; ?>/pages/news.php" class="btn btn-outline" style="margin-bottom: var(--spacing-md);">
            <i class="fas fa-arrow-left"></i> <?php echo t('nav_news'); ?>
        </a>
        <div class="article-content">
            <div class="news-date" style="color: var(--color-secondary); font-weight: 600; margin-bottom: var(--spacing-sm);">
                <i class="far fa-calendar"></i> <?php echo $date; ?>
            </div>
            <h1><?php echo htmlspecialchars($title); ?></h1>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="article-content">
            <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="article-image">
            <div style="color: var(--text-secondary);">
                <?php echo nl2br(htmlspecialchars($content)); ?>
            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>
