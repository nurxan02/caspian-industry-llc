<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings = [
        'contact_email' => $_POST['contact_email'] ?? '',
        'contact_phone' => $_POST['contact_phone'] ?? '',
        'contact_address_en' => $_POST['contact_address_en'] ?? '',
        'contact_address_ru' => $_POST['contact_address_ru'] ?? '',
        'contact_address_az' => $_POST['contact_address_az'] ?? '',
        'facebook_url' => $_POST['facebook_url'] ?? '',
        'linkedin_url' => $_POST['linkedin_url'] ?? '',
        'instagram_url' => $_POST['instagram_url'] ?? '',
        'twitter_url' => $_POST['twitter_url'] ?? ''
    ];
    
    $stmt = $db->prepare("INSERT OR REPLACE INTO site_settings (setting_key, setting_value, updated_at) VALUES (?, ?, CURRENT_TIMESTAMP)");
    
    foreach ($settings as $key => $value) {
        $stmt->execute([$key, $value]);
    }
    
    header('Location: ' . BASE_URL . '/admin/settings.php?saved=1');
    exit;
}

// Load current settings
$stmt = $db->query("SELECT * FROM site_settings");
$all_settings = $stmt->fetchAll();
$settings = [];
foreach ($all_settings as $setting) {
    $settings[$setting['setting_key']] = $setting['setting_value'];
}
?>

<?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">Settings saved successfully!</div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Site Settings</h3>
    </div>
    
    <form method="POST">
        <!-- Contact Information -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-address-book"></i> Contact Information
        </h4>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email" name="contact_email" class="form-control" value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-phone"></i> Phone
                </label>
                <input type="text" name="contact_phone" class="form-control" value="<?php echo htmlspecialchars($settings['contact_phone'] ?? ''); ?>">
            </div>
        </div>
        
        <!-- Addresses -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-map-marker-alt"></i> Address (Multiple Languages)
        </h4>
        
        <div class="form-group">
            <label class="form-label">Address (English)</label>
            <textarea name="contact_address_en" class="form-control" rows="2"><?php echo htmlspecialchars($settings['contact_address_en'] ?? ''); ?></textarea>
        </div>
        
        <div class="form-group">
            <label class="form-label">Address (Русский)</label>
            <textarea name="contact_address_ru" class="form-control" rows="2"><?php echo htmlspecialchars($settings['contact_address_ru'] ?? ''); ?></textarea>
        </div>
        
        <div class="form-group">
            <label class="form-label">Address (Azərbaycan)</label>
            <textarea name="contact_address_az" class="form-control" rows="2"><?php echo htmlspecialchars($settings['contact_address_az'] ?? ''); ?></textarea>
        </div>
        
        <!-- Social Media -->
        <h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
            <i class="fas fa-share-alt"></i> Social Media Links
        </h4>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">
                    <i class="fab fa-facebook"></i> Facebook URL
                </label>
                <input type="url" name="facebook_url" class="form-control" value="<?php echo htmlspecialchars($settings['facebook_url'] ?? ''); ?>" placeholder="https://facebook.com/yourpage">
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fab fa-linkedin"></i> LinkedIn URL
                </label>
                <input type="url" name="linkedin_url" class="form-control" value="<?php echo htmlspecialchars($settings['linkedin_url'] ?? ''); ?>" placeholder="https://linkedin.com/company/yourcompany">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">
                    <i class="fab fa-instagram"></i> Instagram URL
                </label>
                <input type="url" name="instagram_url" class="form-control" value="<?php echo htmlspecialchars($settings['instagram_url'] ?? ''); ?>" placeholder="https://instagram.com/yourprofile">
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fab fa-twitter"></i> Twitter URL
                </label>
                <input type="url" name="twitter_url" class="form-control" value="<?php echo htmlspecialchars($settings['twitter_url'] ?? ''); ?>" placeholder="https://twitter.com/yourprofile">
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>
