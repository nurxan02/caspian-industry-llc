<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("SELECT image FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();
    
    if ($image && file_exists(__DIR__ . '/../assets/uploads/' . $image)) {
        unlink(__DIR__ . '/../assets/uploads/' . $image);
    }
    
    $stmt = $db->prepare("DELETE FROM news WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/news.php?deleted=1');
    exit;
}

// Get all news
$stmt = $db->query("SELECT * FROM news ORDER BY published_date DESC");
$news = $stmt->fetchAll();
?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">News deleted successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">News saved successfully!</div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">News Articles</h3>
        <a href="<?php echo BASE_URL; ?>/admin/news-edit.php" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <?php if (count($news) > 0): ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title (EN)</th>
                <th>Published Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $item): ?>
            <tr>
                <td>
                    <?php if ($item['image']): ?>
                        <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $item['image']; ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                    <?php else: ?>
                        <div style="width: 60px; height: 60px; background: var(--bg-card); border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="color: var(--text-muted);"></i>
                        </div>
                    <?php endif; ?>
                </td>
                <td><strong><?php echo htmlspecialchars($item['title_en']); ?></strong></td>
                <td><?php echo date('M j, Y', strtotime($item['published_date'])); ?></td>
                <td>
                    <?php if ($item['is_published']): ?>
                        <span class="badge badge-success">Published</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Draft</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="<?php echo BASE_URL; ?>/admin/news-edit.php?id=<?php echo $item['id']; ?>" class="btn-icon btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete=<?php echo $item['id']; ?>" class="btn-icon btn-delete" data-action="delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="empty-state">
        <i class="fas fa-newspaper"></i>
        <p>No news yet. Click "Add New" to create your first article.</p>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
