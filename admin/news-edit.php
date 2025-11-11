<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$news = null;

if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $news = $stmt->fetch();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_en = $_POST['title_en'] ?? '';
    $title_ru = $_POST['title_ru'] ?? '';
    $title_az = $_POST['title_az'] ?? '';
    $content_en = $_POST['content_en'] ?? '';
    $content_ru = $_POST['content_ru'] ?? '';
    $content_az = $_POST['content_az'] ?? '';
    $excerpt_en = $_POST['excerpt_en'] ?? '';
    $excerpt_ru = $_POST['excerpt_ru'] ?? '';
    $excerpt_az = $_POST['excerpt_az'] ?? '';
    $published_date = $_POST['published_date'] ?? date('Y-m-d');
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    
    // Handle image upload
    $image = $news['image'] ?? '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $newFilename = 'news_' . time() . '_' . uniqid() . '.' . $ext;
            $uploadPath = __DIR__ . '/../assets/uploads/' . $newFilename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                // Delete old image
                if ($image && file_exists(__DIR__ . '/../assets/uploads/' . $image)) {
                    unlink(__DIR__ . '/../assets/uploads/' . $image);
                }
                $image = $newFilename;
            }
        }
    }
    
    if ($id > 0) {
        // Update
        $stmt = $db->prepare("
            UPDATE news SET 
            title_en = ?, title_ru = ?, title_az = ?,
            content_en = ?, content_ru = ?, content_az = ?,
            excerpt_en = ?, excerpt_ru = ?, excerpt_az = ?,
            image = ?, published_date = ?, is_published = ?,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        $stmt->execute([
            $title_en, $title_ru, $title_az,
            $content_en, $content_ru, $content_az,
            $excerpt_en, $excerpt_ru, $excerpt_az,
            $image, $published_date, $is_published, $id
        ]);
    } else {
        // Insert
        $stmt = $db->prepare("
            INSERT INTO news (
                title_en, title_ru, title_az,
                content_en, content_ru, content_az,
                excerpt_en, excerpt_ru, excerpt_az,
                image, published_date, is_published
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $title_en, $title_ru, $title_az,
            $content_en, $content_ru, $content_az,
            $excerpt_en, $excerpt_ru, $excerpt_az,
            $image, $published_date, $is_published
        ]);
    }
    
    header('Location: /admin/news.php?saved=1');
    exit;
}
?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $id ? 'Edit' : 'Add'; ?> News</h3>
        <a href="/admin/news.php" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    
    <form method="POST" enctype="multipart/form-data">
        <!-- English -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> English
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($news['title_en'] ?? ''); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Excerpt</label>
            <textarea name="excerpt_en" class="form-control" rows="2"><?php echo htmlspecialchars($news['excerpt_en'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Content *</label>
            <textarea name="content_en" class="form-control" rows="8" required><?php echo htmlspecialchars($news['content_en'] ?? ''); ?></textarea>
        </div>
        
        <!-- Russian -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Русский
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Заголовок *</label>
                <input type="text" name="title_ru" class="form-control" value="<?php echo htmlspecialchars($news['title_ru'] ?? ''); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Краткое описание</label>
            <textarea name="excerpt_ru" class="form-control" rows="2"><?php echo htmlspecialchars($news['excerpt_ru'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Содержание *</label>
            <textarea name="content_ru" class="form-control" rows="8" required><?php echo htmlspecialchars($news['content_ru'] ?? ''); ?></textarea>
        </div>
        
        <!-- Azerbaijani -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Azərbaycan
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Başlıq *</label>
                <input type="text" name="title_az" class="form-control" value="<?php echo htmlspecialchars($news['title_az'] ?? ''); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Qısa məzmun</label>
            <textarea name="excerpt_az" class="form-control" rows="2"><?php echo htmlspecialchars($news['excerpt_az'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Məzmun *</label>
            <textarea name="content_az" class="form-control" rows="8" required><?php echo htmlspecialchars($news['content_az'] ?? ''); ?></textarea>
        </div>
        
        <!-- Image and Settings -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-cog"></i> Settings
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <div class="file-upload">
                    <input type="file" name="image" accept="image/*">
                    <div class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Click to upload image</span>
                    </div>
                </div>
                <?php if (!empty($news['image'])): ?>
                    <div class="image-preview">
                        <img src="/assets/uploads/<?php echo $news['image']; ?>" alt="Current image">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label class="form-label">Published Date</label>
                <input type="date" name="published_date" class="form-control" value="<?php echo $news['published_date'] ?? date('Y-m-d'); ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="is_published" value="1" <?php echo (!$news || $news['is_published']) ? 'checked' : ''; ?>>
                <span>Publish this article</span>
            </label>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save News
            </button>
            <a href="/admin/news.php" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
