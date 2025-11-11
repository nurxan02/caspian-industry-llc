<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/contacts.php?deleted=1');
    exit;
}

// Handle mark as read
if (isset($_GET['mark_read'])) {
    $id = (int)$_GET['mark_read'];
    $stmt = $db->prepare("UPDATE contacts SET is_read = 1 WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/contacts.php?marked=1');
    exit;
}

// Get all contacts
$stmt = $db->query("SELECT * FROM contacts ORDER BY created_at DESC");
$contacts = $stmt->fetchAll();
?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Contact form deleted successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['marked'])): ?>
    <div class="alert alert-success">Contact marked as read!</div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Contact Forms</h3>
        <div>
            <span class="badge badge-info"><?php echo count($contacts); ?> Total</span>
        </div>
    </div>
    
    <?php if (count($contacts) > 0): ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr style="<?php echo !$contact['is_read'] ? 'background: rgba(107, 168, 214, 0.05);' : ''; ?>">
                <td><strong><?php echo htmlspecialchars($contact['name']); ?></strong></td>
                <td><a href="mailto:<?php echo $contact['email']; ?>"><?php echo htmlspecialchars($contact['email']); ?></a></td>
                <td><?php echo htmlspecialchars($contact['phone'] ?: '-'); ?></td>
                <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                <td><?php echo date('M j, Y H:i', strtotime($contact['created_at'])); ?></td>
                <td>
                    <?php if ($contact['is_read']): ?>
                        <span class="badge badge-success">Read</span>
                    <?php else: ?>
                        <span class="badge badge-warning">New</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-icon btn-edit" onclick="viewMessage(<?php echo $contact['id']; ?>, <?php echo htmlspecialchars(json_encode($contact)); ?>)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <?php if (!$contact['is_read']): ?>
                        <a href="?mark_read=<?php echo $contact['id']; ?>" class="btn-icon" style="background: #ff9800;">
                            <i class="fas fa-check"></i>
                        </a>
                        <?php endif; ?>
                        <a href="?delete=<?php echo $contact['id']; ?>" class="btn-icon btn-delete" data-action="delete">
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
        <i class="fas fa-envelope"></i>
        <p>No contact forms yet</p>
    </div>
    <?php endif; ?>
</div>

<!-- Message Modal -->
<div id="messageModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 10000; align-items: center; justify-content: center;">
    <div style="background: var(--bg-dark); border-radius: var(--radius-lg); padding: var(--spacing-lg); max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-md);">
            <h3>Contact Message</h3>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--text-secondary); cursor: pointer;">&times;</button>
        </div>
        <div id="messageContent"></div>
    </div>
</div>

<script>
function viewMessage(id, contact) {
    const content = `
        <div style="margin-bottom: var(--spacing-md);">
            <strong>Name:</strong> ${contact.name}<br>
            <strong>Email:</strong> <a href="mailto:${contact.email}">${contact.email}</a><br>
            <strong>Phone:</strong> ${contact.phone || 'N/A'}<br>
            <strong>Subject:</strong> ${contact.subject}<br>
            <strong>Date:</strong> ${new Date(contact.created_at).toLocaleString()}
        </div>
        <div style="padding: var(--spacing-md); background: var(--bg-card); border-radius: var(--radius-md); border-left: 3px solid var(--color-secondary);">
            <strong>Message:</strong><br><br>
            ${contact.message.replace(/\n/g, '<br>')}
        </div>
    `;
    
    document.getElementById('messageContent').innerHTML = content;
    document.getElementById('messageModal').style.display = 'flex';
    
    // Mark as read if not read
    if (!contact.is_read) {
        fetch(`?mark_read=${id}`);
    }
}

function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
}
</script>

<?php require_once 'footer.php'; ?>
