<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Core\Middleware;
use App\Core\Auth;
use App\Core\Database;

session_start();

Middleware::requireAdmin();

$auth = new Auth();
$user = $auth->getUser();
$db = Database::getInstance();

$services = $db->fetchAll("SELECT id, title, subtitle, created_at FROM services ORDER BY created_at DESC");

$pageTitle = 'Shërbimet';
$pageDescription = 'Menaxho shërbimet e klinikës';
$currentPage = 'services';

require_once __DIR__ . '/../../views/layouts/admin-header.php';
?>

<div class="admin-table-container">
    <div class="admin-table-header">
        <h2>Lista e Shërbimeve</h2>
        <span class="table-count">Total: <?php echo count($services); ?></span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulli</th>
                <th>Nëntitulli</th>
                <th>Data e Krijimit</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($services)): ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 2rem;">Nuk ka shërbime të regjistruara</td>
                </tr>
            <?php else: ?>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($service['id']); ?></td>
                        <td><?php echo htmlspecialchars($service['title']); ?></td>
                        <td><?php echo htmlspecialchars($service['subtitle'] ?? '-'); ?></td>
                        <td><?php echo date('d.m.Y H:i', strtotime($service['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../views/layouts/admin-footer.php'; ?>
