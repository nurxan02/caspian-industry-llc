<?php
require_once '../includes/header.php';

// Get language suffix
$lang_suffix = Language::getSuffix();

// Get database connection
require_once '../includes/database.php';
$database = Database::getInstance()->getConnection();

// Get all active careers
$query = "SELECT * FROM careers WHERE (is_active = 1 OR is_active IS NULL) AND (expiry_date IS NULL OR expiry_date >= DATE('now')) ORDER BY created_at DESC";
$stmt = $database->prepare($query);
$stmt->execute();
$careers = $stmt->fetchAll();

// Get categories for filter
$categoriesQuery = "SELECT DISTINCT category{$lang_suffix} as category FROM careers WHERE (is_active = 1 OR is_active IS NULL) ORDER BY category{$lang_suffix}";
$categoriesStmt = $database->prepare($categoriesQuery);
$categoriesStmt->execute();
$categories = $categoriesStmt->fetchAll();
?>

<style>
.page-hero {
    padding-top: 120px;
    padding-bottom: var(--spacing-lg);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);
    position: relative;
}

.careers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: var(--spacing-md);
}

.career-card {
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: all var(--transition-normal);
    cursor: pointer;
}

.career-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(107, 168, 214, 0.3);
}

.career-content {
    padding: var(--spacing-md);
}

.career-category {
    display: inline-block;
    background: rgba(107, 168, 214, 0.1);
    color: var(--color-secondary);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: var(--spacing-sm);
}

.career-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-sm);
}

.career-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: var(--spacing-md);
}

.career-details {
    display: flex;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-md);
    flex-wrap: wrap;
}

.career-detail-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.career-detail-item i {
    color: var(--color-secondary);
}

.career-tags {
    display: flex;
    gap: var(--spacing-xs);
    flex-wrap: wrap;
    margin-bottom: var(--spacing-md);
}

.career-tag {
    background: rgba(107, 168, 214, 0.05);
    color: var(--text-secondary);
    padding: 4px 8px;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
}

.career-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: var(--spacing-md);
    border-top: 1px solid rgba(107, 168, 214, 0.1);
}

.career-link {
    color: var(--color-secondary);
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all var(--transition-fast);
}

.career-link:hover {
    color: var(--color-primary);
}

.career-date {
    color: var(--text-muted);
    font-size: 0.75rem;
}

.filters-container {
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: var(--spacing-md);
    align-items: end;
}

.filter-group label {
    display: block;
    margin-bottom: var(--spacing-xs);
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 600;
}

.filter-group select,
.filter-group input {
    width: 100%;
    padding: var(--spacing-sm);
    background: var(--bg-primary);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-md);
    color: var(--text-primary);
    font-size: 1rem;
}

.filter-group select:focus,
.filter-group input:focus {
    outline: none;
    border-color: var(--color-secondary);
}

@media (max-width: 768px) {
    .filters-container {
        grid-template-columns: 1fr;
    }
    
    .careers-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="page-hero" style="background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.85)), url('<?php echo BASE_URL; ?>/assets/images/news-back.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('careers_tag', 'CAREERS'); ?></span>
            <h1 class="section-title"><?php echo t('careers_title', 'Karyera İmkanları'); ?></h1>
            <p class="section-description"><?php echo t('careers_subtitle', 'Komandamıza qoşulun və bizimlə gələcəyinizi qurun'); ?></p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Filters -->
        <div class="filters-container">
            <div class="filter-group">
                <label><?php echo t('careers_filter_category', 'Kateqoriya'); ?></label>
                <select id="categoryFilter">
                    <option value=""><?php echo t('careers_all_categories', 'Bütün kateqoriyalar'); ?></option>
                    <?php foreach ($categories as $cat): ?>
                        <?php if (!empty($cat['category'])): ?>
                            <option value="<?php echo htmlspecialchars($cat['category']); ?>"><?php echo htmlspecialchars($cat['category']); ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label><?php echo t('careers_search', 'Axtar'); ?></label>
                <input type="text" id="searchInput" placeholder="<?php echo t('careers_search_placeholder', 'İş başlığı və ya açar sözlər...'); ?>">
            </div>
            
            <div>
                <button id="clearFilters" class="btn btn-outline">
                    <?php echo t('careers_clear_filters', 'Sıfırla'); ?>
                </button>
            </div>
        </div>

        <!-- Job Cards Grid -->
        <div id="jobsGrid" class="careers-grid">
            <?php if (count($careers) > 0): ?>
                <?php foreach ($careers as $career): ?>
                    <div class="career-card" data-category="<?php echo htmlspecialchars($career['category' . $lang_suffix]); ?>" data-title="<?php echo htmlspecialchars(strtolower($career['title' . $lang_suffix])); ?>" data-tags="<?php echo htmlspecialchars(strtolower($career['tags' . $lang_suffix])); ?>" onclick="window.location.href='career-detail.php?id=<?php echo $career['id']; ?>'">
                        <div class="career-content">
                            <span class="career-category">
                                <?php echo htmlspecialchars($career['category' . $lang_suffix]); ?>
                            </span>
                            
                            <h3 class="career-title">
                                <?php echo htmlspecialchars($career['title' . $lang_suffix]); ?>
                            </h3>
                            
                            <p class="career-description">
                                <?php echo htmlspecialchars(substr($career['description' . $lang_suffix], 0, 120)) . '...'; ?>
                            </p>
                            
                            <div class="career-details">
                                <?php if (!empty($career['salary_range' . $lang_suffix])): ?>
                                <div class="career-detail-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span><?php echo htmlspecialchars($career['salary_range' . $lang_suffix]); ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($career['work_hours' . $lang_suffix])): ?>
                                <div class="career-detail-item">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo htmlspecialchars($career['work_hours' . $lang_suffix]); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (!empty($career['tags' . $lang_suffix])): ?>
                            <div class="career-tags">
                                <?php 
                                $tags = explode(',', $career['tags' . $lang_suffix]);
                                foreach (array_slice($tags, 0, 3) as $tag): 
                                ?>
                                    <span class="career-tag">
                                        <?php echo htmlspecialchars(trim($tag)); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="career-footer">
                                <span class="career-link">
                                    <?php echo t('careers_view_details', 'Ətraflı bax'); ?> →
                                </span>
                                <span class="career-date">
                                    <i class="far fa-calendar"></i> <?php echo date('d.m.Y', strtotime($career['created_at'])); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: var(--spacing-3xl);">
                    <i class="fas fa-briefcase" style="font-size: 4rem; color: var(--text-muted); margin-bottom: var(--spacing-lg);"></i>
                    <h3 style="color: var(--text-secondary); margin-bottom: var(--spacing-sm);"><?php echo t('careers_no_jobs', 'Hazırda aktiv iş elanı yoxdur'); ?></h3>
                    <p style="color: var(--text-muted);"><?php echo t('careers_check_later', 'Zəhmət olmasa, daha sonra yoxlayın'); ?></p>
                </div>
            <?php endif; ?>
        </div>
        
        <div id="noResults" style="display: none; text-align: center; padding: var(--spacing-3xl);">
            <i class="fas fa-search" style="font-size: 4rem; color: var(--text-muted); margin-bottom: var(--spacing-lg);"></i>
            <h3 style="color: var(--text-secondary); margin-bottom: var(--spacing-sm);"><?php echo t('careers_no_results', 'Nəticə tapılmadı'); ?></h3>
            <p style="color: var(--text-muted);"><?php echo t('careers_try_different', 'Fərqli axtarış kriterləri sınayın'); ?></p>
        </div>
    </div>
</section>

<script>
function filterJobs() {
    const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
    const searchFilter = document.getElementById('searchInput').value.toLowerCase();
    const jobCards = document.querySelectorAll('.career-card');
    const noResults = document.getElementById('noResults');
    let visibleCount = 0;
    
    jobCards.forEach(card => {
        const category = card.dataset.category.toLowerCase();
        const title = card.dataset.title.toLowerCase();
        const tags = card.dataset.tags.toLowerCase();
        
        const matchesCategory = !categoryFilter || category.includes(categoryFilter);
        const matchesSearch = !searchFilter || 
                             title.includes(searchFilter) || 
                             tags.includes(searchFilter);
        
        if (matchesCategory && matchesSearch) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
}

document.getElementById('categoryFilter').addEventListener('change', filterJobs);
document.getElementById('searchInput').addEventListener('input', filterJobs);
document.getElementById('clearFilters').addEventListener('click', function() {
    document.getElementById('categoryFilter').value = '';
    document.getElementById('searchInput').value = '';
    filterJobs();
});
</script>

<?php require_once '../includes/footer.php'; ?>