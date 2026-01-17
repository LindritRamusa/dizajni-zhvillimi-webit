<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Core\Middleware;
use App\Core\Auth;
use App\Core\Database;
use App\Models\Service;

session_start();

Middleware::requireAdmin();

$auth = new Auth();
$user = $auth->getUser();
$db = Database::getInstance();
$serviceModel = new Service();

$services = $serviceModel->findAll();

$pageTitle = 'Shërbimet';
$pageDescription = 'Menaxho shërbimet e klinikës';
$currentPage = 'services';

require_once __DIR__ . '/../../views/layouts/admin-header.php';
?>

<div class="admin-table-container">
    <div class="admin-table-header">
        <h2>Lista e Shërbimeve</h2>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <span class="table-count">Total: <?php echo count($services); ?></span>
            <a href="service-add.php" class="btn-primary">+ Shto Shërbim</a>
        </div>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulli</th>
                <th>Nëntitulli</th>
                <th>Imazhi</th>
                <th>Krijuar nga</th>
                <th>Data</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($services)): ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">Nuk ka shërbime të regjistruara</td>
                </tr>
            <?php else: ?>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($service['id']); ?></td>
                        <td><?php echo htmlspecialchars($service['title']); ?></td>
                        <td><?php echo htmlspecialchars($service['subtitle'] ?? '-'); ?></td>
                        <td>
                            <?php if ($service['image']): ?>
                                <img src="/uploads/<?php echo htmlspecialchars($service['image']); ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                                <span style="color: var(--text-light);">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($service['creator_name'] ?? '-'); ?></td>
                        <td><?php echo date('d.m.Y H:i', strtotime($service['created_at'])); ?></td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="service-edit.php?id=<?php echo $service['id']; ?>" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Ndrysho</a>
                                <a href="service-delete.php?id=<?php echo $service['id']; ?>" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem; background-color: var(--error-color);" onclick="return confirm('A jeni të sigurt që dëshironi të fshini këtë shërbim?');">Fshi</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../views/layouts/admin-footer.php'; ?>
