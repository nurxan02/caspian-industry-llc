<?php require_once '../includes/header.php'; ?>

<style>
.faq-container {
    max-width: 900px;
    margin: 0 auto;
}

.faq-item {
    background: var(--bg-card);
    border: 1px solid rgba(107, 168, 214, 0.1);
    border-radius: var(--radius-md);
    margin-bottom: var(--spacing-md);
    overflow: hidden;
    transition: all var(--transition-normal);
}

.faq-item:hover {
    border-color: rgba(107, 168, 214, 0.3);
}

.faq-question {
    padding: var(--spacing-md);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    font-size: 1.125rem;
    user-select: none;
}

.faq-icon {
    color: var(--color-secondary);
    font-size: 1.5rem;
    transition: transform var(--transition-fast);
}

.faq-item.active .faq-icon {
    transform: rotate(45deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height var(--transition-normal);
}

.faq-item.active .faq-answer {
    max-height: 1000px;
}

.faq-answer-content {
    padding: 0 var(--spacing-md) var(--spacing-md);
    color: var(--text-secondary);
    line-height: 1.8;
}
</style>

<!-- Hero Section -->
<section class="page-hero" style="padding-top: 120px; padding-bottom: var(--spacing-lg); background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--bg-darker) 100%);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><?php echo t('nav_faq'); ?></span>
            <h1 class="section-title"><?php echo t('faq_title'); ?></h1>
            <p class="section-description">Find answers to commonly asked questions</p>
        </div>
    </div>
</section>

<!-- FAQ List -->
<section class="section">
    <div class="container">
        <div class="faq-container">
            <?php
            $db = Database::getInstance()->getConnection();
            $lang_suffix = Language::getSuffix();
            $stmt = $db->query("SELECT * FROM faq ORDER BY sort_order ASC");
            $faqs = $stmt->fetchAll();
            
            if (count($faqs) > 0) {
                foreach ($faqs as $faq) {
                    $question = $faq['question' . $lang_suffix];
                    $answer = $faq['answer' . $lang_suffix];
                    ?>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span><?php echo htmlspecialchars($question); ?></span>
                            <i class="fas fa-plus faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <?php echo nl2br(htmlspecialchars($answer)); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div style="text-align: center; padding: var(--spacing-xl);">';
                echo '<i class="fas fa-question-circle" style="font-size: 4rem; color: var(--color-secondary); margin-bottom: var(--spacing-md);"></i>';
                echo '<p style="color: var(--text-secondary);">' . t('faq_no_items') . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initFAQ();
});
</script>

<?php require_once '../includes/footer.php'; ?>
