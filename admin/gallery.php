<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();
    
    if ($image && file_exists(__DIR__ . '/../assets/uploads/' . $image)) {
        unlink(__DIR__ . '/../assets/uploads/' . $image);
    }
    
    $stmt = $db->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/gallery.php?deleted=1');
    exit;
}

// Get all gallery items
$stmt = $db->query("SELECT * FROM gallery ORDER BY sort_order ASC");
$items = $stmt->fetchAll();
?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Gallery item deleted successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">Gallery item saved successfully!</div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Gallery</h3>
        <a href="<?php echo BASE_URL; ?>/admin/gallery-edit.php" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <?php if (count($items) > 0): ?>
    <div class="grid grid-4" style="margin-top: 2rem;">
        <?php foreach ($items as $item): ?>
        <div class="card" style="position: relative;">
            <?php if ($item['image']): ?>
                <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $item['image']; ?>" class="card-image" style="height: 200px; object-fit: cover;">
            <?php else: ?>
                <div style="height: 200px; background: var(--bg-card); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-image" style="font-size: 3rem; color: var(--text-muted);"></i>
                </div>
            <?php endif; ?>
            <div style="padding: 1rem;">
                <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($item['title_en']); ?></h4>
                <p style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 1rem;">
                    <?php echo htmlspecialchars(substr($item['description_en'], 0, 60)); ?>...
                </p>
                <div class="action-buttons" style="justify-content: center;">
                    <a href="<?php echo BASE_URL; ?>/admin/gallery-edit.php?id=<?php echo $item['id']; ?>" class="btn-icon btn-edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="?delete=<?php echo $item['id']; ?>" class="btn-icon btn-delete" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state">
        <i class="fas fa-images"></i>
        <p>No gallery items yet. Click "Add New" to add your first image.</p>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
