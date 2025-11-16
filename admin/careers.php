<?php
require_once 'auth.php';

// Get database connection  
require_once '../includes/database.php';
$database = Database::getInstance()->getConnection();

require_once 'header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add' || $action === 'edit') {
        $id = $_POST['id'] ?? null;
        $title_az = $_POST['title_az'] ?? '';
        $title_en = $_POST['title_en'] ?? '';
        $title_ru = $_POST['title_ru'] ?? '';
        $description_az = $_POST['description_az'] ?? '';
        $description_en = $_POST['description_en'] ?? '';
        $description_ru = $_POST['description_ru'] ?? '';
        $salary_range_az = $_POST['salary_range_az'] ?? '';
        $salary_range_en = $_POST['salary_range_en'] ?? '';
        $salary_range_ru = $_POST['salary_range_ru'] ?? '';
        $work_hours_az = $_POST['work_hours_az'] ?? '';
        $work_hours_en = $_POST['work_hours_en'] ?? '';
        $work_hours_ru = $_POST['work_hours_ru'] ?? '';
        $category_az = $_POST['category_az'] ?? '';
        $category_en = $_POST['category_en'] ?? '';
        $category_ru = $_POST['category_ru'] ?? '';
        $tags_az = $_POST['tags_az'] ?? '';
        $tags_en = $_POST['tags_en'] ?? '';
        $tags_ru = $_POST['tags_ru'] ?? '';
        $email = $_POST['email'] ?? '';
        $expiry_date = $_POST['expiry_date'] ?? null;
        $is_active = isset($_POST['is_active']) ? 1 : 0;
        
        if ($action === 'add') {
            $query = "INSERT INTO careers (
                title_az, title_en, title_ru, description_az, description_en, description_ru,
                salary_range_az, salary_range_en, salary_range_ru, work_hours_az, work_hours_en, work_hours_ru,
                category_az, category_en, category_ru, tags_az, tags_en, tags_ru, email, expiry_date, is_active
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $database->prepare($query);
            $success = $stmt->execute([
                $title_az, $title_en, $title_ru, $description_az, $description_en, $description_ru,
                $salary_range_az, $salary_range_en, $salary_range_ru, $work_hours_az, $work_hours_en, $work_hours_ru,
                $category_az, $category_en, $category_ru, $tags_az, $tags_en, $tags_ru, $email, $expiry_date, $is_active
            ]);
            
            $message = $success ? 'İş elanı uğurla əlavə edildi!' : 'Xəta baş verdi!';
        } else {
            $query = "UPDATE careers SET 
                title_az = ?, title_en = ?, title_ru = ?, description_az = ?, description_en = ?, description_ru = ?,
                salary_range_az = ?, salary_range_en = ?, salary_range_ru = ?, work_hours_az = ?, work_hours_en = ?, work_hours_ru = ?,
                category_az = ?, category_en = ?, category_ru = ?, tags_az = ?, tags_en = ?, tags_ru = ?, email = ?, 
                expiry_date = ?, is_active = ?, updated_at = CURRENT_TIMESTAMP
                WHERE id = ?";
            
            $stmt = $database->prepare($query);
            $success = $stmt->execute([
                $title_az, $title_en, $title_ru, $description_az, $description_en, $description_ru,
                $salary_range_az, $salary_range_en, $salary_range_ru, $work_hours_az, $work_hours_en, $work_hours_ru,
                $category_az, $category_en, $category_ru, $tags_az, $tags_en, $tags_ru, $email, $expiry_date, $is_active, $id
            ]);
            
            $message = $success ? 'İş elanı uğurla yeniləndi!' : 'Xəta baş verdi!';
        }
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? 0;
        $query = "DELETE FROM careers WHERE id = ?";
        $stmt = $database->prepare($query);
        $success = $stmt->execute([$id]);
        $message = $success ? 'İş elanı silindi!' : 'Xəta baş verdi!';
    }
}

// Get all careers
$query = "SELECT * FROM careers ORDER BY created_at DESC";
$stmt = $database->prepare($query);
$stmt->execute();
$careers = $stmt->fetchAll();

// Get edit data if editing
$editCareer = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $query = "SELECT * FROM careers WHERE id = ?";
    $stmt = $database->prepare($query);
    $stmt->execute([$editId]);
    $editCareer = $stmt->fetch();
}
?>

<style>
.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: var(--spacing-xl);
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-xl);
    padding-bottom: var(--spacing-lg);
    border-bottom: 1px solid var(--border-color);
}

.admin-header h1 {
    margin: 0;
    color: var(--text-primary);
    font-size: 2rem;
    font-weight: 600;
}

.admin-form {
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-color);
    margin-bottom: var(--spacing-xl);
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-lg);
    border-bottom: 1px solid var(--border-color);
}

.form-tabs {
    display: flex;
    gap: 2px;
    margin-bottom: var(--spacing-lg);
    border-bottom: 1px solid var(--border-color);
}

.tab-btn {
    padding: var(--spacing-sm) var(--spacing-lg);
    border: none;
    background: var(--bg-primary);
    color: var(--text-secondary);
    cursor: pointer;
    border-radius: var(--radius-sm) var(--radius-sm) 0 0;
    transition: all 0.2s;
}

.tab-btn.active {
    background: var(--color-primary);
    color: white;
}

.tab-content {
    display: none;
    padding: var(--spacing-lg);
}

.tab-content.active {
    display: block;
}

.admin-form-content {
    padding: var(--spacing-lg);
}

.form-group {
    margin-bottom: var(--spacing-lg);
}

.form-group label {
    display: block;
    margin-bottom: var(--spacing-sm);
    font-weight: 500;
    color: var(--text-primary);
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: var(--spacing-sm);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    background: var(--bg-primary);
    color: var(--text-primary);
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    cursor: pointer;
}

.checkbox-label input[type="checkbox"] {
    width: auto;
}

.form-actions {
    display: flex;
    gap: var(--spacing-sm);
    padding-top: var(--spacing-lg);
    border-top: 1px solid var(--border-color);
}

.admin-table-container {
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th,
.admin-table td {
    padding: var(--spacing-md);
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.admin-table th {
    background: var(--bg-primary);
    font-weight: 600;
    color: var(--text-primary);
}

.admin-table td {
    color: var(--text-secondary);
}

.status-badge {
    padding: 4px 8px;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: 500;
}

.status-badge.active {
    background: #10b981;
    color: white;
}

.status-badge.inactive {
    background: #ef4444;
    color: white;
}

.action-buttons {
    display: flex;
    gap: var(--spacing-xs);
}

.btn {
    display: inline-flex;
    align-items: center;
    padding: var(--spacing-sm) var(--spacing-md);
    border: none;
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-primary {
    background: var(--color-primary);
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
}

.btn-secondary {
    background: var(--bg-primary);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.btn-outline {
    background: transparent;
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.btn-danger {
    background: #ef4444;
    color: white;
}

.btn-sm {
    padding: 4px 8px;
    font-size: 0.75rem;
}

.alert {
    padding: var(--spacing-md);
    border-radius: var(--radius-sm);
    margin-bottom: var(--spacing-lg);
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1><i class="fas fa-briefcase"></i> Karyera İdarəetmə</h1>
        <button class="btn btn-primary" onclick="toggleForm()">
            <i class="fas fa-plus"></i> Yeni İş Elanı
        </button>
    </div>

    <?php if (isset($message)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Add/Edit Form -->
    <div id="careerForm" class="admin-form" style="<?php echo $editCareer ? 'display: block;' : 'display: none;'; ?>">
        <div class="form-header">
            <h2><?php echo $editCareer ? 'İş Elanını Redaktə Et' : 'Yeni İş Elanı Əlavə Et'; ?></h2>
            <button class="btn btn-outline" onclick="toggleForm()">
                <i class="fas fa-times"></i> Bağla
            </button>
        </div>

        <form method="POST" class="admin-form-content">
            <input type="hidden" name="action" value="<?php echo $editCareer ? 'edit' : 'add'; ?>">
            <?php if ($editCareer): ?>
                <input type="hidden" name="id" value="<?php echo $editCareer['id']; ?>">
            <?php endif; ?>

            <div class="form-tabs">
                <button type="button" class="tab-btn active" onclick="switchTab('az')">AZ</button>
                <button type="button" class="tab-btn" onclick="switchTab('en')">EN</button>
                <button type="button" class="tab-btn" onclick="switchTab('ru')">RU</button>
                <button type="button" class="tab-btn" onclick="switchTab('general')">Ümumi</button>
            </div>

            <!-- Azerbaijani Tab -->
            <div id="tab-az" class="tab-content active">
                <div class="form-group">
                    <label>İş Adı (AZ) *</label>
                    <input type="text" name="title_az" value="<?php echo htmlspecialchars($editCareer['title_az'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>İş Təsviri (AZ) *</label>
                    <textarea name="description_az" rows="6" required><?php echo htmlspecialchars($editCareer['description_az'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Maaş Aralığı (AZ)</label>
                    <input type="text" name="salary_range_az" value="<?php echo htmlspecialchars($editCareer['salary_range_az'] ?? ''); ?>" placeholder="Məs: 3000-5000 AZN">
                </div>

                <div class="form-group">
                    <label>İş Saatları (AZ) *</label>
                    <input type="text" name="work_hours_az" value="<?php echo htmlspecialchars($editCareer['work_hours_az'] ?? ''); ?>" required placeholder="Məs: Tam vaxt (09:00-18:00)">
                </div>

                <div class="form-group">
                    <label>Kateqoriya (AZ) *</label>
                    <input type="text" name="category_az" value="<?php echo htmlspecialchars($editCareer['category_az'] ?? ''); ?>" required placeholder="Məs: İdarəetmə">
                </div>

                <div class="form-group">
                    <label>Etiketlər (AZ)</label>
                    <input type="text" name="tags_az" value="<?php echo htmlspecialchars($editCareer['tags_az'] ?? ''); ?>" placeholder="vergüllə ayrılmış: layihə,menecment,komanda">
                </div>
            </div>

            <!-- English Tab -->
            <div id="tab-en" class="tab-content">
                <div class="form-group">
                    <label>Job Title (EN) *</label>
                    <input type="text" name="title_en" value="<?php echo htmlspecialchars($editCareer['title_en'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Job Description (EN) *</label>
                    <textarea name="description_en" rows="6" required><?php echo htmlspecialchars($editCareer['description_en'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Salary Range (EN)</label>
                    <input type="text" name="salary_range_en" value="<?php echo htmlspecialchars($editCareer['salary_range_en'] ?? ''); ?>" placeholder="e.g: 3000-5000 AZN">
                </div>

                <div class="form-group">
                    <label>Work Hours (EN) *</label>
                    <input type="text" name="work_hours_en" value="<?php echo htmlspecialchars($editCareer['work_hours_en'] ?? ''); ?>" required placeholder="e.g: Full time (09:00-18:00)">
                </div>

                <div class="form-group">
                    <label>Category (EN) *</label>
                    <input type="text" name="category_en" value="<?php echo htmlspecialchars($editCareer['category_en'] ?? ''); ?>" required placeholder="e.g: Management">
                </div>

                <div class="form-group">
                    <label>Tags (EN)</label>
                    <input type="text" name="tags_en" value="<?php echo htmlspecialchars($editCareer['tags_en'] ?? ''); ?>" placeholder="comma separated: project,management,team">
                </div>
            </div>

            <!-- Russian Tab -->
            <div id="tab-ru" class="tab-content">
                <div class="form-group">
                    <label>Название Работы (RU) *</label>
                    <input type="text" name="title_ru" value="<?php echo htmlspecialchars($editCareer['title_ru'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Описание Работы (RU) *</label>
                    <textarea name="description_ru" rows="6" required><?php echo htmlspecialchars($editCareer['description_ru'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Диапазон Зарплаты (RU)</label>
                    <input type="text" name="salary_range_ru" value="<?php echo htmlspecialchars($editCareer['salary_range_ru'] ?? ''); ?>" placeholder="напр: 3000-5000 AZN">
                </div>

                <div class="form-group">
                    <label>Рабочие Часы (RU) *</label>
                    <input type="text" name="work_hours_ru" value="<?php echo htmlspecialchars($editCareer['work_hours_ru'] ?? ''); ?>" required placeholder="напр: Полный день (09:00-18:00)">
                </div>

                <div class="form-group">
                    <label>Категория (RU) *</label>
                    <input type="text" name="category_ru" value="<?php echo htmlspecialchars($editCareer['category_ru'] ?? ''); ?>" required placeholder="напр: Управление">
                </div>

                <div class="form-group">
                    <label>Теги (RU)</label>
                    <input type="text" name="tags_ru" value="<?php echo htmlspecialchars($editCareer['tags_ru'] ?? ''); ?>" placeholder="через запятую: проект,управление,команда">
                </div>
            </div>

            <!-- General Tab -->
            <div id="tab-general" class="tab-content">
                <div class="form-group">
                    <label>E-mail Ünvanı *</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($editCareer['email'] ?? ''); ?>" required placeholder="hr@caspiaindustry.az">
                </div>

                <div class="form-group">
                    <label>Bitmə Tarixi</label>
                    <input type="date" name="expiry_date" value="<?php echo $editCareer['expiry_date'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" <?php echo ($editCareer['is_active'] ?? 1) ? 'checked' : ''; ?>>
                        Aktiv
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?php echo $editCareer ? 'Yenilə' : 'Əlavə Et'; ?>
                </button>
                <button type="button" class="btn btn-outline" onclick="toggleForm()">
                    <i class="fas fa-times"></i> Ləğv Et
                </button>
            </div>
        </form>
    </div>

    <!-- Careers List -->
    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İş Adı</th>
                    <th>Kateqoriya</th>
                    <th>E-mail</th>
                    <th>Bitmə Tarixi</th>
                    <th>Status</th>
                    <th>Əməliyyatlar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($careers as $career): ?>
                    <tr>
                        <td><?php echo $career['id']; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($career['title_az']); ?></strong>
                            <small style="display: block; color: var(--text-secondary);">
                                <?php echo htmlspecialchars(substr($career['description_az'], 0, 60)) . '...'; ?>
                            </small>
                        </td>
                        <td><?php echo htmlspecialchars($career['category_az']); ?></td>
                        <td><?php echo htmlspecialchars($career['email']); ?></td>
                        <td>
                            <?php if ($career['expiry_date']): ?>
                                <?php 
                                $expiry = new DateTime($career['expiry_date']);
                                $now = new DateTime();
                                $isExpired = $expiry < $now;
                                ?>
                                <span style="color: <?php echo $isExpired ? '#ef4444' : '#22c55e'; ?>">
                                    <?php echo $expiry->format('d.m.Y'); ?>
                                    <?php echo $isExpired ? '(Bitib)' : ''; ?>
                                </span>
                            <?php else: ?>
                                <span style="color: var(--text-secondary);">Daimi</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="status-badge <?php echo $career['is_active'] ? 'active' : 'inactive'; ?>">
                                <?php echo $career['is_active'] ? 'Aktiv' : 'Deaktiv'; ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="../pages/career-detail.php?id=<?php echo $career['id']; ?>" class="btn btn-sm btn-outline" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="?edit=<?php echo $career['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteCareer(<?php echo $career['id']; ?>, '<?php echo htmlspecialchars($career['title_az']); ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <?php if (empty($careers)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-secondary); padding: var(--spacing-xl);">
                            Hələ ki heç bir iş elanı yoxdur
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete form -->
<form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" id="deleteId">
</form>

<script>
function toggleForm() {
    const form = document.getElementById('careerForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function switchTab(tabName) {
    // Remove active class from all tabs and contents
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    
    // Add active class to clicked tab and its content
    event.target.classList.add('active');
    document.getElementById('tab-' + tabName).classList.add('active');
}

function deleteCareer(id, title) {
    if (confirm(`"${title}" adlı iş elanını silmək istədiyinizdən əminsiniz?`)) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteForm').submit();
    }
}
</script>

<?php require_once 'footer.php'; ?>