<?php
require_once '../includes/config.php';
require_once '../includes/database.php';
require_once 'auth.php';

$pdo = Database::getInstance()->getConnection();
$id = $_GET['id'] ?? null;
$career = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM careers WHERE id = ?");
    $stmt->execute([$id]);
    $career = $stmt->fetch();
}

if ($_POST) {
    try {
        $position_az = $_POST['position_az'] ?? '';
        $position_en = $_POST['position_en'] ?? '';
        $position_ru = $_POST['position_ru'] ?? '';
        $description_az = $_POST['description_az'] ?? '';
        $description_en = $_POST['description_en'] ?? '';
        $description_ru = $_POST['description_ru'] ?? '';
        $salary_range = $_POST['salary_range'] ?? '';
        $email = $_POST['email'] ?? '';
        $work_hours = $_POST['work_hours'] ?? '';
        $category_az = $_POST['category_az'] ?? '';
        $category_en = $_POST['category_en'] ?? '';
        $category_ru = $_POST['category_ru'] ?? '';
        $tags = $_POST['tags'] ?? '';
        $valid_until = $_POST['valid_until'] ?? null;
        $status = $_POST['status'] ?? 'active';
        
        if (empty($valid_until)) {
            $valid_until = null;
        }

        if ($id) {
            // Update
            $sql = "UPDATE careers SET 
                position_az = ?, position_en = ?, position_ru = ?,
                description_az = ?, description_en = ?, description_ru = ?,
                salary_range = ?, email = ?, work_hours = ?,
                category_az = ?, category_en = ?, category_ru = ?,
                tags = ?, valid_until = ?, status = ?
                WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $position_az, $position_en, $position_ru,
                $description_az, $description_en, $description_ru,
                $salary_range, $email, $work_hours,
                $category_az, $category_en, $category_ru,
                $tags, $valid_until, $status, $id
            ]);
            $message = "Karyera elanı yeniləndi!";
        } else {
            // Insert
            $sql = "INSERT INTO careers 
                (position_az, position_en, position_ru, description_az, description_en, description_ru,
                salary_range, email, work_hours, category_az, category_en, category_ru,
                tags, valid_until, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $position_az, $position_en, $position_ru,
                $description_az, $description_en, $description_ru,
                $salary_range, $email, $work_hours,
                $category_az, $category_en, $category_ru,
                $tags, $valid_until, $status
            ]);
            $message = "Yeni karyera elanı yaradıldı!";
        }
        
        header('Location: careers.php?message=' . urlencode($message));
        exit;
    } catch (Exception $e) {
        $error = "Xəta baş verdi: " . $e->getMessage();
    }
}

require_once 'header.php';
?>

<div class="admin-header">
    <h1><?php echo $id ? 'Karyera Elanını Redaktə Et' : 'Yeni Karyera Elanı'; ?></h1>
    <a href="careers.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Geri
    </a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label class="form-label">Pozisiya Adı</label>
            <div class="row">
                <div class="col-md-4">
                    <label for="position_az">Azərbaycan</label>
                    <input type="text" id="position_az" name="position_az" class="form-control" 
                           value="<?php echo htmlspecialchars($career['position_az'] ?? ''); ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="position_en">English</label>
                    <input type="text" id="position_en" name="position_en" class="form-control" 
                           value="<?php echo htmlspecialchars($career['position_en'] ?? ''); ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="position_ru">Русский</label>
                    <input type="text" id="position_ru" name="position_ru" class="form-control" 
                           value="<?php echo htmlspecialchars($career['position_ru'] ?? ''); ?>" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">İş Açıqlaması</label>
            <div class="row">
                <div class="col-md-4">
                    <label for="description_az">Azərbaycan</label>
                    <textarea id="description_az" name="description_az" class="form-control" rows="6" required><?php echo htmlspecialchars($career['description_az'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-4">
                    <label for="description_en">English</label>
                    <textarea id="description_en" name="description_en" class="form-control" rows="6" required><?php echo htmlspecialchars($career['description_en'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-4">
                    <label for="description_ru">Русский</label>
                    <textarea id="description_ru" name="description_ru" class="form-control" rows="6" required><?php echo htmlspecialchars($career['description_ru'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email (Müraciət üçün)</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           value="<?php echo htmlspecialchars($career['email'] ?? ''); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="salary_range" class="form-label">Maaş Aralığı</label>
                    <input type="text" id="salary_range" name="salary_range" class="form-control" 
                           value="<?php echo htmlspecialchars($career['salary_range'] ?? ''); ?>" 
                           placeholder="Məsələn: 1000-2000 AZN">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="work_hours" class="form-label">Çalışma Saatları</label>
                    <input type="text" id="work_hours" name="work_hours" class="form-control" 
                           value="<?php echo htmlspecialchars($career['work_hours'] ?? ''); ?>" 
                           placeholder="Məsələn: 09:00-18:00, Tam ştatlı">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tags" class="form-label">Etiketlər (vergüllə ayırın)</label>
                    <input type="text" id="tags" name="tags" class="form-control" 
                           value="<?php echo htmlspecialchars($career['tags'] ?? ''); ?>" 
                           placeholder="php, mysql, javascript">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Kateqoriya</label>
            <div class="row">
                <div class="col-md-4">
                    <label for="category_az">Azərbaycan</label>
                    <input type="text" id="category_az" name="category_az" class="form-control" 
                           value="<?php echo htmlspecialchars($career['category_az'] ?? ''); ?>" 
                           placeholder="İT, Maliyyə, Satış">
                </div>
                <div class="col-md-4">
                    <label for="category_en">English</label>
                    <input type="text" id="category_en" name="category_en" class="form-control" 
                           value="<?php echo htmlspecialchars($career['category_en'] ?? ''); ?>" 
                           placeholder="IT, Finance, Sales">
                </div>
                <div class="col-md-4">
                    <label for="category_ru">Русский</label>
                    <input type="text" id="category_ru" name="category_ru" class="form-control" 
                           value="<?php echo htmlspecialchars($career['category_ru'] ?? ''); ?>" 
                           placeholder="ИТ, Финансы, Продажи">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="valid_until" class="form-label">Son Müraciət Tarixi (İsteğe bağlı)</label>
                    <input type="date" id="valid_until" name="valid_until" class="form-control" 
                           value="<?php echo $career['valid_until'] ?? ''; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="active" <?php echo ($career['status'] ?? 'active') === 'active' ? 'selected' : ''; ?>>Aktiv</option>
                        <option value="inactive" <?php echo ($career['status'] ?? '') === 'inactive' ? 'selected' : ''; ?>>Qeyri-aktiv</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                <?php echo $id ? 'Yenilə' : 'Yadda Saxla'; ?>
            </button>
            <a href="careers.php" class="btn btn-secondary">
                <i class="fas fa-times"></i> Ləğv Et
            </a>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>