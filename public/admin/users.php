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

$users = $db->fetchAll("SELECT id, name, email, phone, role, created_at FROM users ORDER BY created_at DESC");

$pageTitle = 'Menaxho Përdoruesit - Dashboard';
$pageDescription = 'Menaxho përdoruesit e sistemit';
$currentPage = 'admin-users';

require_once __DIR__ . '/../../views/layouts/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Menaxho Përdoruesit</h1>
        <p><a href="dashboard.php" style="color: white; text-decoration: underline;">← Kthehu në Dashboard</a></p>
    </div>
</section>

<section class="admin-content">
    <div class="container">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Emri</th>
                        <th>Email</th>
                        <th>Telefoni</th>
                        <th>Roli</th>
                        <th>Data Regjistrimit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem;">Nuk ka përdorues të regjistruar</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($u['id']); ?></td>
                                <td><?php echo htmlspecialchars($u['name']); ?></td>
                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                                <td><?php echo htmlspecialchars($u['phone'] ?? '-'); ?></td>
                                <td>
                                    <span class="role-badge <?php echo $u['role'] === 'admin' ? 'role-admin' : 'role-user'; ?>">
                                        <?php echo $u['role'] === 'admin' ? 'Administrator' : 'Përdorues'; ?>
                                    </span>
                                </td>
                                <td><?php echo date('d.m.Y H:i', strtotime($u['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../views/layouts/footer.php'; ?>
