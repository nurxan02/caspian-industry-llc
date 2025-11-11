<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$project = null;

if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_en = $_POST['title_en'] ?? '';
    $title_ru = $_POST['title_ru'] ?? '';
    $title_az = $_POST['title_az'] ?? '';
    $description_en = $_POST['description_en'] ?? '';
    $description_ru = $_POST['description_ru'] ?? '';
    $description_az = $_POST['description_az'] ?? '';
    $category_en = $_POST['category_en'] ?? '';
    $category_ru = $_POST['category_ru'] ?? '';
    $category_az = $_POST['category_az'] ?? '';
    $client = $_POST['client'] ?? '';
    $location = $_POST['location'] ?? '';
    $completion_date = $_POST['completion_date'] ?? null;
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    
    // Handle multiple image uploads
    $images = $project['images'] ? json_decode($project['images'], true) : [];
    
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $uploadedImages = [];
        
        foreach ($_FILES['images']['name'] as $key => $filename) {
            if ($_FILES['images']['error'][$key] === 0) {
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                
                if (in_array($ext, $allowed)) {
                    $newFilename = 'project_' . time() . '_' . uniqid() . '.' . $ext;
                    $uploadPath = __DIR__ . '/../assets/uploads/' . $newFilename;
                    
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $uploadPath)) {
                        $uploadedImages[] = $newFilename;
                    }
                }
            }
        }
        
        if (!empty($uploadedImages)) {
            $images = array_merge($images, $uploadedImages);
        }
    }
    
    $imagesJson = json_encode($images);
    
    if ($id > 0) {
        // Update
        $stmt = $db->prepare("
            UPDATE projects SET 
            title_en = ?, title_ru = ?, title_az = ?,
            description_en = ?, description_ru = ?, description_az = ?,
            category_en = ?, category_ru = ?, category_az = ?,
            client = ?, location = ?, completion_date = ?,
            images = ?, is_published = ?, sort_order = ?,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        $stmt->execute([
            $title_en, $title_ru, $title_az,
            $description_en, $description_ru, $description_az,
            $category_en, $category_ru, $category_az,
            $client, $location, $completion_date,
            $imagesJson, $is_published, $sort_order, $id
        ]);
    } else {
        // Insert
        $stmt = $db->prepare("
            INSERT INTO projects (
                title_en, title_ru, title_az,
                description_en, description_ru, description_az,
                category_en, category_ru, category_az,
                client, location, completion_date,
                images, is_published, sort_order
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $title_en, $title_ru, $title_az,
            $description_en, $description_ru, $description_az,
            $category_en, $category_ru, $category_az,
            $client, $location, $completion_date,
            $imagesJson, $is_published, $sort_order
        ]);
    }
    
    header('Location: ' . BASE_URL . '/admin/projects.php?saved=1');
    exit;
}

$currentImages = $project && $project['images'] ? json_decode($project['images'], true) : [];
?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $id ? 'Edit' : 'Add'; ?> Project</h3>
        <a href="<?php echo BASE_URL; ?>/admin/projects.php" class="btn btn-outline btn-sm">
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
                <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($project['title_en'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">Category</label>
                <input type="text" name="category_en" class="form-control" value="<?php echo htmlspecialchars($project['category_en'] ?? ''); ?>" placeholder="e.g. Industrial, Infrastructure">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Description *</label>
            <textarea name="description_en" class="form-control" rows="6" required><?php echo htmlspecialchars($project['description_en'] ?? ''); ?></textarea>
        </div>
        
        <!-- Russian -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Русский
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Заголовок *</label>
                <input type="text" name="title_ru" class="form-control" value="<?php echo htmlspecialchars($project['title_ru'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">Категория</label>
                <input type="text" name="category_ru" class="form-control" value="<?php echo htmlspecialchars($project['category_ru'] ?? ''); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Описание *</label>
            <textarea name="description_ru" class="form-control" rows="6" required><?php echo htmlspecialchars($project['description_ru'] ?? ''); ?></textarea>
        </div>
        
        <!-- Azerbaijani -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-globe"></i> Azərbaycan
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Başlıq *</label>
                <input type="text" name="title_az" class="form-control" value="<?php echo htmlspecialchars($project['title_az'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">Kateqoriya</label>
                <input type="text" name="category_az" class="form-control" value="<?php echo htmlspecialchars($project['category_az'] ?? ''); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Təsvir *</label>
            <textarea name="description_az" class="form-control" rows="6" required><?php echo htmlspecialchars($project['description_az'] ?? ''); ?></textarea>
        </div>
        
        <!-- Project Details -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-info-circle"></i> Project Details
        </h4>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Client</label>
                <input type="text" name="client" class="form-control" value="<?php echo htmlspecialchars($project['client'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($project['location'] ?? ''); ?>">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Completion Date</label>
                <input type="date" name="completion_date" class="form-control" value="<?php echo $project['completion_date'] ?? ''; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="<?php echo $project['sort_order'] ?? 0; ?>" min="0">
            </div>
        </div>
        
        <!-- Images -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-images"></i> Images
        </h4>
        <div class="form-group">
            <label class="form-label">Upload Images (Multiple)</label>
            <div class="file-upload">
                <input type="file" name="images[]" accept="image/*" multiple>
                <div class="file-upload-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Click to upload images</span>
                </div>
            </div>
            <?php if (!empty($currentImages)): ?>
                <div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
                    <?php foreach ($currentImages as $img): ?>
                        <div class="image-preview" style="position: relative;">
                            <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $img; ?>" alt="Project image" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="is_published" value="1" <?php echo (!$project || $project['is_published']) ? 'checked' : ''; ?>>
                <span>Publish this project</span>
            </label>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Project
            </button>
            <a href="<?php echo BASE_URL; ?>/admin/projects.php" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
