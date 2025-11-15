<?php require_once 'header.php'; ?>

<?php
$db = Database::getInstance()->getConnection();

// Get statistics
$stats = [
    'contacts' => $db->query("SELECT COUNT(*) FROM contacts")->fetchColumn(),
    'news' => $db->query("SELECT COUNT(*) FROM news")->fetchColumn(),
    'projects' => $db->query("SELECT COUNT(*) FROM projects")->fetchColumn(),
    'partners' => $db->query("SELECT COUNT(*) FROM partners")->fetchColumn(),
    'clients' => $db->query("SELECT COUNT(*) FROM clients")->fetchColumn(),
];

$unread_contacts = $db->query("SELECT COUNT(*) FROM contacts WHERE is_read = 0")->fetchColumn();
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value"><?php echo $stats['contacts']; ?></div>
        <div class="stat-label">
            <i class="fas fa-envelope"></i> Contact Forms
            <?php if ($unread_contacts > 0): ?>
                <span class="badge badge-warning" style="margin-left: 0.5rem;"><?php echo $unread_contacts; ?> new</span>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="stat-card" >
        <div class="stat-value"><?php echo $stats['news']; ?></div>
        <div class="stat-label"><i class="fas fa-newspaper"></i> News Articles</div>
    </div>
    
    <div class="stat-card" >
        <div class="stat-value"><?php echo $stats['projects']; ?></div>
        <div class="stat-label"><i class="fas fa-project-diagram"></i> Projects</div>
    </div>
    
    <div class="stat-card" >
        <div class="stat-value"><?php echo $stats['partners']; ?></div>
        <div class="stat-label"><i class="fas fa-handshake"></i> Partners</div>
    </div>
    
    <div class="stat-card" >
        <div class="stat-value"><?php echo $stats['clients']; ?></div>
        <div class="stat-label"><i class="fas fa-users"></i> Clients</div>
    </div>
</div>

<!-- Recent Contacts -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Recent Contact Forms</h3>
        <a href="<?php echo BASE_URL; ?>/admin/contacts.php" class="btn btn-outline btn-sm">View All</a>
    </div>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $db->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5");
            $contacts = $stmt->fetchAll();
            
            if (count($contacts) > 0) {
                foreach ($contacts as $contact) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($contact['created_at'])); ?></td>
                        <td>
                            <?php if ($contact['is_read']): ?>
                                <span class="badge badge-success">Read</span>
                            <?php else: ?>
                                <span class="badge badge-warning">New</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="5" class="text-center">No contact forms yet</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Recent News -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Recent News</h3>
        <a href="<?php echo BASE_URL; ?>/admin/news.php" class="btn btn-outline btn-sm">View All</a>
    </div>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>Title (EN)</th>
                <th>Published Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $db->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 5");
            $news = $stmt->fetchAll();
            
            if (count($news) > 0) {
                foreach ($news as $item) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['title_en']); ?></td>
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
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="4" class="text-center">No news yet</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>
