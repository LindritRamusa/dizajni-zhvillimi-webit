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

$usersCount = $db->fetch("SELECT COUNT(*) as count FROM users")['count'];
$servicesCount = $db->fetch("SELECT COUNT(*) as count FROM services")['count'];
$newsCount = $db->fetch("SELECT COUNT(*) as count FROM news")['count'];
$messagesCount = $db->fetch("SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0")['count'];

$pageTitle = 'Dashboard';
$pageDescription = 'Paneli administrativ i Klinikës Medina';
$currentPage = 'dashboard';

require_once __DIR__ . '/../../views/layouts/admin-header.php';
?>

<div class="admin-dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-content">
            <h3><?php echo $usersCount; ?></h3>
            <p>Përdoruesit</p>
            <a href="users.php" class="stat-link">Shiko të gjithë →</a>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">🩺</div>
        <div class="stat-content">
            <h3><?php echo $servicesCount; ?></h3>
            <p>Shërbimet</p>
            <a href="services.php" class="stat-link">Menaxho →</a>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📰</div>
        <div class="stat-content">
            <h3><?php echo $newsCount; ?></h3>
            <p>Lajmet</p>
            <a href="news.php" class="stat-link">Menaxho →</a>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">✉️</div>
        <div class="stat-content">
            <h3><?php echo $messagesCount; ?></h3>
            <p>Mesazhe të palexuara</p>
            <a href="messages.php" class="stat-link">Shiko →</a>
        </div>
    </div>
</div>

<div class="admin-dashboard-welcome">
    <div class="welcome-card">
        <h2>Mirësevini, <?php echo htmlspecialchars($user['name']); ?>!</h2>
        <p>Kjo është paneli administrativ i Klinikës Medina. Nga këtu mund të menaxhoni të gjithë përmbajtjen e webfaqes.</p>
    </div>
</div>

<?php require_once __DIR__ . '/../../views/layouts/admin-footer.php'; ?>
