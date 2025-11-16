<?php 
require_once '../includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$db = Database::getInstance()->getConnection();
$lang_suffix = Language::getSuffix();

$stmt = $db->prepare("SELECT * FROM projects WHERE id = ? AND is_published = 1");
$stmt->execute([$id]);
$project = $stmt->fetch();

if (!$project) {
    header('Location: ' . BASE_URL . '/pages/projects.php');
    exit;
}

$title = $project['title' . $lang_suffix];
$description = $project['description' . $lang_suffix];
$images = $project['images'] ? json_decode($project['images'], true) : [];
?>

<style>
.project-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-md);
    margin: var(--spacing-lg) 0;
}

.project-gallery img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: transform var(--transition-normal);
}

.project-gallery img:hover {
    transform: scale(1.05);
}

.project-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-md);
    margin: var(--spacing-lg) 0;
}

.info-item {
    background: var(--bg-card);
    padding: var(--spacing-md);
    border-radius: var(--radius-md);
    border: 1px solid rgba(107, 168, 214, 0.1);
}

.info-label {
    color: var(--color-secondary);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: var(--spacing-xs);
}

.info-value {
    font-size: 1.125rem;
    color: var(--text-primary);
}
</style>

<section class="page-hero" style="padding-top: 120px; padding-bottom: var(--spacing-lg); background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);">
    <div class="container">
        <a href="<?php echo BASE_URL; ?>/pages/projects.php" class="btn btn-outline" style="margin-bottom: var(--spacing-md); margin-top:10px;">
            <i class="fas fa-arrow-left"></i> <?php echo t('nav_projects'); ?>
        </a>
        <h1><?php echo htmlspecialchars($title); ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="project-info">
            <?php if ($project['client']): ?>
            <div class="info-item">
                <div class="info-label"><?php echo t('projects_client'); ?></div>
                <div class="info-value"><?php echo htmlspecialchars($project['client']); ?></div>
            </div>
            <?php endif; ?>
            
            <?php if ($project['location']): ?>
            <div class="info-item">
                <div class="info-label"><?php echo t('projects_location'); ?></div>
                <div class="info-value"><?php echo htmlspecialchars($project['location']); ?></div>
            </div>
            <?php endif; ?>
            
            <?php if ($project['completion_date']): ?>
            <div class="info-item">
                <div class="info-label"><?php echo t('projects_completed'); ?></div>
                <div class="info-value"><?php echo date('F Y', strtotime($project['completion_date'])); ?></div>
            </div>
            <?php endif; ?>
        </div>

        <div style="max-width: 800px; margin: var(--spacing-lg) 0;">
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--text-secondary);">
                <?php echo nl2br(htmlspecialchars($description)); ?>
            </p>
        </div>

        <?php if (!empty($images)): ?>
        <h2 style="margin: var(--spacing-lg) 0 var(--spacing-md);">Project Gallery</h2>
        <div class="project-gallery gallery-item">
            <?php foreach ($images as $image): ?>
                <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>">
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initGallery();
});
</script>

<?php require_once '../includes/footer.php'; ?>
