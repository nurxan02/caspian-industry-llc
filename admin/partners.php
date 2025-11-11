<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("SELECT logo FROM partners WHERE id = ?");
    $stmt->execute([$id]);
    $logo = $stmt->fetchColumn();
    
    if ($logo && file_exists(__DIR__ . '/../assets/uploads/' . $logo)) {
        unlink(__DIR__ . '/../assets/uploads/' . $logo);
    }
    
    $stmt = $db->prepare("DELETE FROM partners WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: /admin/partners.php?deleted=1');
    exit;
}

// Get all partners
$stmt = $db->query("SELECT * FROM partners ORDER BY sort_order ASC");
$partners = $stmt->fetchAll();
?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Partner deleted successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">Partner saved successfully!</div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Partners</h3>
        <a href="/admin/partners-edit.php" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <?php if (count($partners) > 0): ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Logo</th>
                <th>Name</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partners as $partner): ?>
            <tr>
                <td><?php echo $partner['sort_order']; ?></td>
                <td>
                    <?php if ($partner['logo']): ?>
                        <img src="/assets/uploads/<?php echo $partner['logo']; ?>" style="width: 80px; height: 40px; object-fit: contain;">
                    <?php else: ?>
                        <div style="width: 80px; height: 40px; background: var(--bg-card); border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="color: var(--text-muted);"></i>
                        </div>
                    <?php endif; ?>
                </td>
                <td><strong><?php echo htmlspecialchars($partner['name']); ?></strong></td>
                <td>
                    <?php if ($partner['website']): ?>
                        <a href="<?php echo htmlspecialchars($partner['website']); ?>" target="_blank" style="color: var(--color-secondary);">
                            <i class="fas fa-external-link-alt"></i> Visit
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="/admin/partners-edit.php?id=<?php echo $partner['id']; ?>" class="btn-icon btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete=<?php echo $partner['id']; ?>" class="btn-icon btn-delete" onclick="return confirm('Are you sure?')">
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
        <i class="fas fa-handshake"></i>
        <p>No partners yet. Click "Add New" to add your first partner.</p>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
