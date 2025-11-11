<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM faq WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: /admin/faq.php?deleted=1');
    exit;
}

// Get all FAQ
$stmt = $db->query("SELECT * FROM faq ORDER BY sort_order ASC");
$faqs = $stmt->fetchAll();
?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">FAQ deleted successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">FAQ saved successfully!</div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Frequently Asked Questions</h3>
        <a href="/admin/faq-edit.php" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <?php if (count($faqs) > 0): ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Question (EN)</th>
                <th>Answer Preview (EN)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faqs as $faq): ?>
            <tr>
                <td><?php echo $faq['sort_order']; ?></td>
                <td><strong><?php echo htmlspecialchars($faq['question_en']); ?></strong></td>
                <td><?php echo htmlspecialchars(substr($faq['answer_en'], 0, 100)); ?>...</td>
                <td>
                    <div class="action-buttons">
                        <a href="/admin/faq-edit.php?id=<?php echo $faq['id']; ?>" class="btn-icon btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete=<?php echo $faq['id']; ?>" class="btn-icon btn-delete" onclick="return confirm('Are you sure?')">
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
        <i class="fas fa-question-circle"></i>
        <p>No FAQ yet. Click "Add New" to add your first question.</p>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
