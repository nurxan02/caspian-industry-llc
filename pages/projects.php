<?php require_once '../includes/header.php'; ?>

<style>
.page-hero {
    padding-top: 120px;
    padding-bottom: var(--spacing-lg);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);
}

.project-filters {
    display: flex;
    gap: var(--spacing-sm);
    justify-content: center;
    margin-bottom: var(--spacing-lg);
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.5rem 1.5rem;
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.2);
    border-radius: var(--radius-md);
    color: var(--text-secondary);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: var(--color-white);
}
</style>

<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.85)), url('<?php echo BASE_URL; ?>/assets/images/project-back.jpg'); background-size: cover; background-position: center; ">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('nav_projects_tag','PROJECTS'); ?></span>
            <h1 class="section-title"><?php echo t('projects_title'); ?></h1>
            <p class="section-description"><?php echo t('projects_description','Explore our portfolio of successful projects'); ?></p>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="section">
    <div class="container">
        <div class="grid grid-2">
            <?php
            $db = Database::getInstance()->getConnection();
            $lang_suffix = Language::getSuffix();
            $stmt = $db->query("SELECT * FROM projects WHERE is_published = 1 ORDER BY sort_order ASC");
            $projects = $stmt->fetchAll();
            
            if (count($projects) > 0) {
                foreach ($projects as $project) {
                    $title = $project['title' . $lang_suffix];
                    $description = substr(strip_tags($project['description' . $lang_suffix]), 0, 200) . '...';
                    $images = $project['images'] ? json_decode($project['images'], true) : [];
                    $image = !empty($images) ? BASE_URL . '/assets/uploads/' . $images[0] : BASE_URL . '/assets/images/placeholder.jpg';
                    ?>
                    <div class="card">
                        <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="card-image">
                        <h3 class="card-title"><?php echo htmlspecialchars($title); ?></h3>
                        <p class="card-text"><?php echo htmlspecialchars($description); ?></p>
                        <?php if ($project['client']): ?>
                            <div class="card-meta">
                                <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($project['client']); ?></span>
                                <?php if ($project['completion_date']): ?>
                                    <span><i class="far fa-calendar-check"></i> <?php echo date('Y', strtotime($project['completion_date'])); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <a href="<?php echo BASE_URL; ?>/pages/project-detail.php?id=<?php echo $project['id']; ?>" class="btn btn-outline">
                            <?php echo t('projects_view'); ?> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align: center; padding: var(--spacing-xl);">';
                echo '<i class="fas fa-project-diagram" style="font-size: 4rem; color: var(--color-secondary); margin-bottom: var(--spacing-md);"></i>';
                echo '<p style="color: var(--text-secondary);">' . t('projects_no_items') . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>
