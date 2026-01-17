<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Core\Middleware;
use App\Core\Auth;
use App\Models\Service;

session_start();

Middleware::requireAdmin();

$auth = new Auth();
$user = $auth->getUser();
$serviceModel = new Service();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $subtitle = trim($_POST['subtitle'] ?? '');
    $icon = trim($_POST['icon'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $duration = trim($_POST['duration'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $availability = trim($_POST['availability'] ?? '');
    
    if (empty($title)) {
        $error = 'Titulli është i detyrueshëm';
    } else {
        $imagePath = null;
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $fileName = uniqid('service_') . '.' . $fileExtension;
                $targetPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imagePath = $fileName;
                } else {
                    $error = 'Gabim gjatë ngarkimit të imazhit';
                }
            } else {
                $error = 'Formati i imazhit nuk është i lejuar';
            }
        }
        
        if (empty($error)) {
            $serviceData = [
                'title' => $title,
                'subtitle' => $subtitle ?: null,
                'icon' => $icon ?: null,
                'description' => $description ?: null,
                'duration' => $duration ?: null,
                'price' => $price ?: null,
                'availability' => $availability ?: null,
                'image' => $imagePath,
                'created_by' => $user['id']
            ];
            
            $serviceId = $serviceModel->create($serviceData);
            
            if ($serviceId) {
                header('Location: services.php');
                exit;
            } else {
                $error = 'Gabim gjatë krijimit të shërbimit';
            }
        }
    }
}

$pageTitle = 'Shto Shërbim';
$pageDescription = 'Shto shërbim të ri';
$currentPage = 'services';

require_once __DIR__ . '/../../views/layouts/admin-header.php';
?>

<div class="admin-form-container">
    <div class="admin-form-header">
        <h2>Shto Shërbim të Ri</h2>
        <a href="services.php" class="btn-secondary">← Kthehu</a>
    </div>

    <?php if ($error): ?>
        <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div style="background-color: #efe; color: #3c3; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #3c3;">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="admin-form">
        <div class="form-group">
            <label for="title">Titulli *</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="subtitle">Nëntitulli</label>
            <input type="text" id="subtitle" name="subtitle" value="<?php echo htmlspecialchars($_POST['subtitle'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="icon">Ikona (Emoji)</label>
            <input type="text" id="icon" name="icon" value="<?php echo htmlspecialchars($_POST['icon'] ?? ''); ?>" placeholder="🩺">
        </div>

        <div class="form-group">
            <label for="description">Përshkrimi</label>
            <textarea id="description" name="description" rows="5"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="duration">Kohëzgjatja</label>
                <input type="text" id="duration" name="duration" value="<?php echo htmlspecialchars($_POST['duration'] ?? ''); ?>" placeholder="30-60 minuta">
            </div>

            <div class="form-group">
                <label for="price">Çmimi</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>" placeholder="Nga 20 euro">
            </div>
        </div>

        <div class="form-group">
            <label for="availability">Disponueshmëria</label>
            <input type="text" id="availability" name="availability" value="<?php echo htmlspecialchars($_POST['availability'] ?? ''); ?>" placeholder="E Hënë - E Premte: 08:00 - 20:00">
        </div>

        <div class="form-group">
            <label for="image">Imazhi</label>
            <input type="file" id="image" name="image" accept="image/*">
            <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Formate të lejuara: JPG, PNG, GIF, WEBP</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Ruaj Shërbimin</button>
            <a href="services.php" class="btn-secondary">Anulo</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../../views/layouts/admin-footer.php'; ?>
