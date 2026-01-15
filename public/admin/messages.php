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

$messages = $db->fetchAll("SELECT id, name, email, phone, subject, message, is_read, created_at FROM contact_messages ORDER BY created_at DESC");

$pageTitle = 'Mesazhet';
$pageDescription = 'Shiko mesazhet e kontaktit';
$currentPage = 'messages';

require_once __DIR__ . '/../../views/layouts/admin-header.php';
?>

<div class="admin-table-container">
    <div class="admin-table-header">
        <h2>Mesazhet e Kontaktit</h2>
        <span class="table-count">Total: <?php echo count($messages); ?></span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri</th>
                <th>Email</th>
                <th>Telefoni</th>
                <th>Tema</th>
                <th>Statusi</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($messages)): ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">Nuk ka mesazhe</td>
                </tr>
            <?php else: ?>
                <?php foreach ($messages as $msg): ?>
                    <tr style="<?php echo $msg['is_read'] == 0 ? 'background-color: #f0f8ff;' : ''; ?>">
                        <td><?php echo htmlspecialchars($msg['id']); ?></td>
                        <td><?php echo htmlspecialchars($msg['name']); ?></td>
                        <td><?php echo htmlspecialchars($msg['email']); ?></td>
                        <td><?php echo htmlspecialchars($msg['phone'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($msg['subject'] ?? '-'); ?></td>
                        <td>
                            <?php if ($msg['is_read'] == 0): ?>
                                <span class="role-badge role-admin">E palexuar</span>
                            <?php else: ?>
                                <span class="role-badge role-user">E lexuar</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d.m.Y H:i', strtotime($msg['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../views/layouts/admin-footer.php'; ?>
