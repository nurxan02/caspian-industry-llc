<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("SELECT images FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $images = $stmt->fetchColumn();
    
    if ($images) {
        $imageArray = json_decode($images, true);
        foreach ($imageArray as $image) {
            if (file_exists(__DIR__ . '/../assets/uploads/' . $image)) {
                unlink(__DIR__ . '/../assets/uploads/' . $image);
            }
        }
    }
    
    $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: /admin/projects.php?deleted=1');
    exit;
}

// Get all projects
$stmt = $db->query("SELECT * FROM projects ORDER BY sort_order ASC");
$projects = $stmt->fetchAll();
?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Project deleted successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">Project saved successfully!</div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Projects</h3>
        <a href="/admin/projects-edit.php" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <?php if (count($projects) > 0): ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Title (EN)</th>
                <th>Client</th>
                <th>Location</th>
                <th>Completion</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?php echo $project['sort_order']; ?></td>
                <td><strong><?php echo htmlspecialchars($project['title_en']); ?></strong></td>
                <td><?php echo htmlspecialchars($project['client']); ?></td>
                <td><?php echo htmlspecialchars($project['location']); ?></td>
                <td><?php echo $project['completion_date'] ? date('M Y', strtotime($project['completion_date'])) : '-'; ?></td>
                <td>
                    <?php if ($project['is_published']): ?>
                        <span class="badge badge-success">Published</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Draft</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="/admin/projects-edit.php?id=<?php echo $project['id']; ?>" class="btn-icon btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete=<?php echo $project['id']; ?>" class="btn-icon btn-delete" onclick="return confirm('Are you sure?')">
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
        <i class="fas fa-project-diagram"></i>
        <p>No projects yet. Click "Add New" to create your first project.</p>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
