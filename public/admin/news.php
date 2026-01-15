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

$news = $db->fetchAll("SELECT id, title, created_at FROM news ORDER BY created_at DESC");

$pageTitle = 'Lajmet';
$pageDescription = 'Menaxho lajmet dhe artikujt';
$currentPage = 'news';

require_once __DIR__ . '/../../views/layouts/admin-header.php';
?>

<div class="admin-table-container">
    <div class="admin-table-header">
        <h2>Lista e Lajmeve</h2>
        <span class="table-count">Total: <?php echo count($news); ?></span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulli</th>
                <th>Data e Krijimit</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($news)): ?>
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem;">Nuk ka lajme të regjistruara</td>
                </tr>
            <?php else: ?>
                <?php foreach ($news as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id']); ?></td>
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td><?php echo date('d.m.Y H:i', strtotime($item['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../views/layouts/admin-footer.php'; ?>
