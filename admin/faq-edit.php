<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$faq = null;

if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM faq WHERE id = ?");
    $stmt->execute([$id]);
    $faq = $stmt->fetch();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_en = $_POST['question_en'] ?? '';
    $question_ru = $_POST['question_ru'] ?? '';
    $question_az = $_POST['question_az'] ?? '';
    $answer_en = $_POST['answer_en'] ?? '';
    $answer_ru = $_POST['answer_ru'] ?? '';
    $answer_az = $_POST['answer_az'] ?? '';
    $category = $_POST['category'] ?? '';
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    
    if ($id > 0) {
        // Update
        $stmt = $db->prepare("
            UPDATE faq SET 
            question_en = ?, question_ru = ?, question_az = ?,
            answer_en = ?, answer_ru = ?, answer_az = ?,
            category = ?, sort_order = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $question_en, $question_ru, $question_az,
            $answer_en, $answer_ru, $answer_az,
            $category, $sort_order, $id
        ]);
    } else {
        // Insert
        $stmt = $db->prepare("
            INSERT INTO faq (
                question_en, question_ru, question_az,
                answer_en, answer_ru, answer_az,
                category, sort_order
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $question_en, $question_ru, $question_az,
            $answer_en, $answer_ru, $answer_az,
            $category, $sort_order
        ]);
    }
    
    header('Location: ' . BASE_URL . '/admin/faq.php?saved=1');
    exit;
}
?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $id ? 'Edit' : 'Add'; ?> FAQ</h3>
        <a href="<?php echo BASE_URL; ?>/admin/faq.php" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    
    <form method="POST">
        <!-- English -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> English
        </h4>
        <div class="form-group">
            <label class="form-label">Question *</label>
            <input type="text" name="question_en" class="form-control" value="<?php echo htmlspecialchars($faq['question_en'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Answer *</label>
            <textarea name="answer_en" class="form-control" rows="5" required><?php echo htmlspecialchars($faq['answer_en'] ?? ''); ?></textarea>
        </div>
        
        <!-- Russian -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Русский
        </h4>
        <div class="form-group">
            <label class="form-label">Вопрос *</label>
            <input type="text" name="question_ru" class="form-control" value="<?php echo htmlspecialchars($faq['question_ru'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Ответ *</label>
            <textarea name="answer_ru" class="form-control" rows="5" required><?php echo htmlspecialchars($faq['answer_ru'] ?? ''); ?></textarea>
        </div>
        
        <!-- Azerbaijani -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Azərbaycan
        </h4>
        <div class="form-group">
            <label class="form-label">Sual *</label>
            <input type="text" name="question_az" class="form-control" value="<?php echo htmlspecialchars($faq['question_az'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Cavab *</label>
            <textarea name="answer_az" class="form-control" rows="5" required><?php echo htmlspecialchars($faq['answer_az'] ?? ''); ?></textarea>
        </div>
        
        <!-- Settings -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-cog"></i> Settings
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($faq['category'] ?? ''); ?>" placeholder="e.g. General, Technical, Billing">
            </div>
            <div class="form-group">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="<?php echo $faq['sort_order'] ?? 0; ?>" min="0">
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save FAQ
            </button>
            <a href="<?php echo BASE_URL; ?>/admin/faq.php" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
