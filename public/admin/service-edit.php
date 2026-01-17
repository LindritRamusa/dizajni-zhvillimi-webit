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
$service = null;

$serviceId = $_GET['id'] ?? null;

if (!$serviceId) {
    header('Location: services.php');
    exit;
}

$service = $serviceModel->findById($serviceId);

if (!$service) {
    header('Location: services.php');
    exit;
}

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
        $imagePath = $service['image'];
        
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
                    if ($imagePath && file_exists($uploadDir . $imagePath)) {
                        unlink($uploadDir . $imagePath);
                    }
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
            
            $result = $serviceModel->update($serviceId, $serviceData);
            
            if ($result) {
                header('Location: services.php');
                exit;
            } else {
                $error = 'Gabim gjatë përditësimit të shërbimit';
            }
        }
    }
    
    $service = $serviceModel->findById($serviceId);
}

$pageTitle = 'Ndrysho Shërbim';
$pageDescription = 'Ndrysho shërbimin';
$currentPage = 'services';

require_once __DIR__ . '/../../views/layouts/admin-header.php';
?>

<div class="admin-form-container">
    <div class="admin-form-header">
        <h2>Ndrysho Shërbim</h2>
        <a href="services.php" class="btn-secondary">← Kthehu</a>
    </div>

    <?php if ($error): ?>
        <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="admin-form">
        <div class="form-group">
            <label for="title">Titulli *</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required>
        </div>

        <div class="form-group">
            <label for="subtitle">Nëntitulli</label>
            <input type="text" id="subtitle" name="subtitle" value="<?php echo htmlspecialchars($service['subtitle'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="icon">Ikona (Emoji)</label>
            <input type="text" id="icon" name="icon" value="<?php echo htmlspecialchars($service['icon'] ?? ''); ?>" placeholder="🩺">
        </div>

        <div class="form-group">
            <label for="description">Përshkrimi</label>
            <textarea id="description" name="description" rows="5"><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="duration">Kohëzgjatja</label>
                <input type="text" id="duration" name="duration" value="<?php echo htmlspecialchars($service['duration'] ?? ''); ?>" placeholder="30-60 minuta">
            </div>

            <div class="form-group">
                <label for="price">Çmimi</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($service['price'] ?? ''); ?>" placeholder="Nga 20 euro">
            </div>
        </div>

        <div class="form-group">
            <label for="availability">Disponueshmëria</label>
            <input type="text" id="availability" name="availability" value="<?php echo htmlspecialchars($service['availability'] ?? ''); ?>" placeholder="E Hënë - E Premte: 08:00 - 20:00">
        </div>

        <div class="form-group">
            <label for="image">Imazhi</label>
            <?php if ($service['image']): ?>
                <div style="margin-bottom: 1rem;">
                    <img src="/uploads/<?php echo htmlspecialchars($service['image']); ?>" alt="" style="max-width: 200px; height: auto; border-radius: 5px; display: block; margin-bottom: 0.5rem;">
                    <small style="color: var(--text-light);">Imazhi aktual</small>
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
            <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Lëreni bosh për të mbajtur imazhin aktual</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Ruaj Ndryshimet</button>
            <a href="services.php" class="btn-secondary">Anulo</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../../views/layouts/admin-footer.php'; ?>
