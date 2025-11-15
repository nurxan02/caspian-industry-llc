<?php 
require_once 'header.php';

$db = Database::getInstance()->getConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$client = null;

if ($id > 0) {
	$stmt = $db->prepare("SELECT * FROM clients WHERE id = ?");
	$stmt->execute([$id]);
	$client = $stmt->fetch();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['name'] ?? '';
	$website = $_POST['website'] ?? '';
	$description_en = $_POST['description_en'] ?? '';
	$description_ru = $_POST['description_ru'] ?? '';
	$description_az = $_POST['description_az'] ?? '';
	$sort_order = (int)($_POST['sort_order'] ?? 0);
    
	// Handle logo upload
	$logo = $client['logo'] ?? '';
	if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
		$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
		$filename = $_FILES['logo']['name'];
		$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
		if (in_array($ext, $allowed)) {
			$newFilename = 'client_' . time() . '_' . uniqid() . '.' . $ext;
			$uploadPath = __DIR__ . '/../assets/uploads/' . $newFilename;
            
			if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadPath)) {
				// Delete old logo
				if ($logo && file_exists(__DIR__ . '/../assets/uploads/' . $logo)) {
					unlink(__DIR__ . '/../assets/uploads/' . $logo);
				}
				$logo = $newFilename;
			}
		}
	}
    
	if (!$logo && !$id) {
		// Logo is required for new clients
		header('Location: ' . BASE_URL . '/admin/clients-edit.php?error=logo_required');
		exit;
	}
    
	if ($id > 0) {
		// Update
		$stmt = $db->prepare("
			UPDATE clients SET 
			name = ?, logo = ?, website = ?,
			description_en = ?, description_ru = ?, description_az = ?,
			sort_order = ?
			WHERE id = ?
		");
		$stmt->execute([
			$name, $logo, $website,
			$description_en, $description_ru, $description_az,
			$sort_order, $id
		]);
	} else {
		// Insert
		$stmt = $db->prepare("
			INSERT INTO clients (
				name, logo, website,
				description_en, description_ru, description_az,
				sort_order
			) VALUES (?, ?, ?, ?, ?, ?, ?)
		");
		$stmt->execute([
			$name, $logo, $website,
			$description_en, $description_ru, $description_az,
			$sort_order
		]);
	}
    
	header('Location: ' . BASE_URL . '/admin/clients.php?saved=1');
	exit;
}
?>

<div class="admin-card">
	<div class="admin-card-header">
		<h3 class="admin-card-title"><?php echo $id ? 'Edit' : 'Add'; ?> Client</h3>
		<a href="<?php echo BASE_URL; ?>/admin/clients.php" class="btn btn-outline btn-sm">
			<i class="fas fa-arrow-left"></i> Back
		</a>
	</div>
    
	<?php if (isset($_GET['error']) && $_GET['error'] === 'logo_required'): ?>
		<div class="alert alert-danger">Please upload a logo!</div>
	<?php endif; ?>
    
	<form method="POST" enctype="multipart/form-data">
		<!-- Basic Info -->
		<h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
			<i class="fas fa-user-tie"></i> Basic Information
		</h4>
		<div class="form-row">
			<div class="form-group">
				<label class="form-label">Client Name *</label>
				<input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($client['name'] ?? ''); ?>" required>
			</div>
			<div class="form-group">
				<label class="form-label">Website</label>
				<input type="url" name="website" class="form-control" value="<?php echo htmlspecialchars($client['website'] ?? ''); ?>" placeholder="https://example.com">
			</div>
		</div>
        
		<!-- English -->
		<h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
			<i class="fas fa-globe"></i> English
		</h4>
		<div class="form-group">
			<label class="form-label">Description</label>
			<textarea name="description_en" class="form-control" rows="3"><?php echo htmlspecialchars($client['description_en'] ?? ''); ?></textarea>
		</div>
        
		<!-- Russian -->
		<h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
			<i class="fas fa-globe"></i> Русский
		</h4>
		<div class="form-group">
			<label class="form-label">Описание</label>
			<textarea name="description_ru" class="form-control" rows="3"><?php echo htmlspecialchars($client['description_ru'] ?? ''); ?></textarea>
		</div>
        
		<!-- Azerbaijani -->
		<h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
			<i class="fas fa-globe"></i> Azərbaycan
		</h4>
		<div class="form-group">
			<label class="form-label">Təsvir</label>
			<textarea name="description_az" class="form-control" rows="3"><?php echo htmlspecialchars($client['description_az'] ?? ''); ?></textarea>
		</div>
        
		<!-- Logo and Settings -->
		<h4 style="margin-top: var(--spacing-md); color: var(--color-secondary);">
			<i class="fas fa-image"></i> Logo
		</h4>
		<div class="form-row">
			<div class="form-group">
				<label class="form-label">Logo <?php echo !$id ? '*' : ''; ?></label>
				<div class="file-upload">
					<input type="file" name="logo" accept="image/*" <?php echo !$id ? 'required' : ''; ?>>
					<div class="file-upload-label">
						<i class="fas fa-cloud-upload-alt"></i>
						<span>Click to upload logo (PNG, SVG recommended)</span>
					</div>
				</div>
				<?php if (!empty($client['logo'])): ?>
					<div class="image-preview" style="background: white; padding: 1rem;">
						<img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $client['logo']; ?>" alt="Current logo" style="max-height: 100px; object-fit: contain;">
					</div>
				<?php endif; ?>
			</div>
            
			<div class="form-group">
				<label class="form-label">Sort Order</label>
				<input type="number" name="sort_order" class="form-control" value="<?php echo $client['sort_order'] ?? 0; ?>" min="0">
			</div>
		</div>
        
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">
				<i class="fas fa-save"></i> Save Client
			</button>
			<a href="<?php echo BASE_URL; ?>/admin/clients.php" class="btn btn-outline">Cancel</a>
		</div>
	</form>
</div>

<?php require_once 'footer.php'; ?>

