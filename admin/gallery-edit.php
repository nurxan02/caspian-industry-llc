<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = null;

if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM gallery WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_en = $_POST['title_en'] ?? '';
    $title_ru = $_POST['title_ru'] ?? '';
    $title_az = $_POST['title_az'] ?? '';
    $description_en = $_POST['description_en'] ?? '';
    $description_ru = $_POST['description_ru'] ?? '';
    $description_az = $_POST['description_az'] ?? '';
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    
    // Handle image upload
    $image = $item['image'] ?? '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $newFilename = 'gallery_' . time() . '_' . uniqid() . '.' . $ext;
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
    
    if (!$image && !$id) {
        // Image is required for new items
        header('Location: ' . BASE_URL . '/admin/gallery-edit.php?error=image_required');
        exit;
    }
    
    if ($id > 0) {
        // Update
        $stmt = $db->prepare("
            UPDATE gallery SET 
            title_en = ?, title_ru = ?, title_az = ?,
            description_en = ?, description_ru = ?, description_az = ?,
            image = ?, sort_order = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $title_en, $title_ru, $title_az,
            $description_en, $description_ru, $description_az,
            $image, $sort_order, $id
        ]);
    } else {
        // Insert
        $stmt = $db->prepare("
            INSERT INTO gallery (
                title_en, title_ru, title_az,
                description_en, description_ru, description_az,
                image, sort_order
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $title_en, $title_ru, $title_az,
            $description_en, $description_ru, $description_az,
            $image, $sort_order
        ]);
    }
    
    header('Location: ' . BASE_URL . '/admin/gallery.php?saved=1');
    exit;
}
?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $id ? 'Edit' : 'Add'; ?> Gallery Item</h3>
        <a href="<?php echo BASE_URL; ?>/admin/gallery.php" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    
    <?php if (isset($_GET['error']) && $_GET['error'] === 'image_required'): ?>
        <div class="alert alert-danger">Please upload an image!</div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <!-- English -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> English
        </h4>
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($item['title_en'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description_en" class="form-control" rows="3"><?php echo htmlspecialchars($item['description_en'] ?? ''); ?></textarea>
        </div>
        
        <!-- Russian -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Русский
        </h4>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title_ru" class="form-control" value="<?php echo htmlspecialchars($item['title_ru'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Описание</label>
            <textarea name="description_ru" class="form-control" rows="3"><?php echo htmlspecialchars($item['description_ru'] ?? ''); ?></textarea>
        </div>
        
        <!-- Azerbaijani -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Azərbaycan
        </h4>
        <div class="form-group">
            <label class="form-label">Başlıq</label>
            <input type="text" name="title_az" class="form-control" value="<?php echo htmlspecialchars($item['title_az'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Təsvir</label>
            <textarea name="description_az" class="form-control" rows="3"><?php echo htmlspecialchars($item['description_az'] ?? ''); ?></textarea>
        </div>
        
        <!-- Image and Settings -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-image"></i> Image
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Image <?php echo !$id ? '*' : ''; ?></label>
                <div class="file-upload">
                    <input type="file" name="image" accept="image/*" <?php echo !$id ? 'required' : ''; ?>>
                    <div class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Click to upload image</span>
                    </div>
                </div>
                <?php if (!empty($item['image'])): ?>
                    <div class="image-preview">
                        <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $item['image']; ?>" alt="Current image">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="<?php echo $item['sort_order'] ?? 0; ?>" min="0">
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Gallery Item
            </button>
            <a href="<?php echo BASE_URL; ?>/admin/gallery.php" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
