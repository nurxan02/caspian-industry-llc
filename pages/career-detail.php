<?php
require_once '../includes/header.php';

// Get language suffix
$lang_suffix = Language::getSuffix();

// Get database connection
require_once '../includes/database.php';
$database = Database::getInstance()->getConnection();

// Get job ID from URL
$job_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$job_id) {
    header('Location: careers.php');
    exit;
}

// Get job details
$query = "SELECT * FROM careers WHERE id = ? AND (is_active = 1 OR is_active IS NULL)";
$stmt = $database->prepare($query);
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    header('Location: careers.php');
    exit;
}

$title = $job['title' . $lang_suffix];
$description = $job['description' . $lang_suffix];
$category = $job['category' . $lang_suffix];
$salary = $job['salary_range' . $lang_suffix];
$work_hours = $job['work_hours' . $lang_suffix];
$tags = !empty($job['tags' . $lang_suffix]) ? explode(',', $job['tags' . $lang_suffix]) : [];
$email = $job['email'];
$created_date = date('F j, Y', strtotime($job['created_at']));
?>

<style>
.article-hero {
    padding-top: 120px;
    padding-bottom: var(--spacing-lg);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);
}

.job-detail-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: var(--spacing-xl);
}

.job-content {
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-lg);
    padding: var(--spacing-xl);
}

.job-sidebar {
    position: sticky;
    top: 100px;
}

.sidebar-card {
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-md);
}

.job-meta {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-lg);
    border-bottom: 1px solid rgba(107, 168, 214, 0.1);
}

.job-meta-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.job-meta-item i {
    color: var(--color-secondary);
}

.job-tags {
    display: flex;
    gap: var(--spacing-xs);
    flex-wrap: wrap;
    margin-bottom: var(--spacing-xl);
}

.job-tag {
    background: rgba(107, 168, 214, 0.1);
    color: var(--color-secondary);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
}

.job-description h4 {
    color: var(--text-primary);
    font-size: 1.125rem;
    font-weight: 600;
    margin-top: var(--spacing-xl);
    margin-bottom: var(--spacing-md);
}

.job-description p,
.job-description li {
    color: var(--text-secondary);
    line-height: 1.8;
    margin-bottom: var(--spacing-md);
}

.job-description ul {
    list-style-position: inside;
    padding-left: var(--spacing-md);
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-sm) 0;
    border-bottom: 1px solid rgba(107, 168, 214, 0.1);
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.info-value {
    color: var(--text-primary);
    font-weight: 600;
}

@media (max-width: 768px) {
    .job-detail-container {
        grid-template-columns: 1fr;
    }
    
    .job-sidebar {
        position: static;
    }
}
</style>

<section class="article-hero">
    <div class="container">
        <a href="<?php echo BASE_URL; ?>/pages/careers.php" class="btn btn-outline" style="margin-bottom: var(--spacing-md); margin-top:1rem;">
            <i class="fas fa-arrow-left"></i> <?php echo t('careers_back', 'Karyera Səhifəsinə Qayıt'); ?>
        </a>
        <div style="max-width: 800px;">
            <span class="section-tag" style="background: rgba(107, 168, 214, 0.1); color: var(--color-secondary); padding: var(--spacing-xs) var(--spacing-sm); border-radius: var(--radius-sm); font-size: 0.875rem; font-weight: 600;">
                <?php echo htmlspecialchars($category); ?>
            </span>
            <h1 style="margin-top: var(--spacing-md); margin-bottom: var(--spacing-sm);">
                <?php echo htmlspecialchars($title); ?>
            </h1>
            <div class="job-meta">
                <div class="job-meta-item">
                    <i class="far fa-calendar"></i>
                    <span><?php echo $created_date; ?></span>
                </div>
                <?php if (!empty($salary)): ?>
                <div class="job-meta-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <span><?php echo htmlspecialchars($salary); ?></span>
                </div>
                <?php endif; ?>
                <div class="job-meta-item">
                    <i class="fas fa-clock"></i>
                    <span><?php echo htmlspecialchars($work_hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="job-detail-container">
            <!-- Main Content -->
            <div class="job-content">
                <?php if (!empty($tags)): ?>
                <div class="job-tags">
                    <?php foreach ($tags as $tag): ?>
                        <span class="job-tag"><?php echo htmlspecialchars(trim($tag)); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <div class="job-description">
                    <?php echo nl2br(htmlspecialchars($description)); ?>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="job-sidebar">
                <!-- Apply Card -->
                <div class="sidebar-card">
                    <h3 style="color: var(--text-primary); font-size: 1.125rem; font-weight: 600; margin-bottom: var(--spacing-md);">
                        <?php echo t('careers_apply_now', 'İndi Müraciət Edin'); ?>
                    </h3>
                    <p style="color: var(--text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-lg);">
                        <?php echo t('careers_apply_description', 'Bu vəzifə üçün müraciət etmək istəyirsinizsə, aşağıdakı düyməyə klikləyin'); ?>
                    </p>
                    <a href="mailto:<?php echo htmlspecialchars($email); ?>?subject=<?php echo urlencode($title); ?> - CV" class="btn btn-primary" style="width: 100%; text-align: center; justify-content: center;">
                        <i class="fas fa-envelope"></i> <?php echo t('careers_send_cv', 'CV Göndər'); ?>
                    </a>
                </div>
                
                <!-- Job Info Card -->
                <div class="sidebar-card">
                    <h3 style="color: var(--text-primary); font-size: 1.125rem; font-weight: 600; margin-bottom: var(--spacing-md);">
                        <?php echo t('careers_job_info', 'İş Məlumatı'); ?>
                    </h3>
                    <div>
                        <div class="info-row">
                            <span class="info-label"><?php echo t('careers_category', 'Kateqoriya'); ?></span>
                            <span class="info-value"><?php echo htmlspecialchars($category); ?></span>
                        </div>
                        <?php if (!empty($salary)): ?>
                        <div class="info-row">
                            <span class="info-label"><?php echo t('careers_salary', 'Maaş'); ?></span>
                            <span class="info-value"><?php echo htmlspecialchars($salary); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="info-row">
                            <span class="info-label"><?php echo t('careers_work_hours', 'İş Saatları'); ?></span>
                            <span class="info-value"><?php echo htmlspecialchars($work_hours); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><?php echo t('careers_posted', 'Yerləşdirilib'); ?></span>
                            <span class="info-value"><?php echo $created_date; ?></span>
                        </div>
                        <?php if (!empty($job['expiry_date'])): ?>
                        <div class="info-row">
                            <span class="info-label"><?php echo t('careers_expires', 'Bitmə tarixi'); ?></span>
                            <span class="info-value"><?php echo date('F j, Y', strtotime($job['expiry_date'])); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Company Info Card -->
                <div class="sidebar-card">
                    <h3 style="color: var(--text-primary); font-size: 1.125rem; font-weight: 600; margin-bottom: var(--spacing-md);">
                        <?php echo t('careers_about_company', 'Şirkət Haqqında'); ?>
                    </h3>
                    <p style="color: var(--text-secondary); font-size: 0.875rem; line-height: 1.6;">
                        <?php echo t('careers_company_description', 'Caspian Industry - neft və qaz sənayesi üçün peşəkar həllər təqdim edən lider şirkət'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>