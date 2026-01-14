<?php

require_once __DIR__ . '/../../app/autoload.php';

use App\Core\Middleware;
use App\Core\Auth;

session_start();

Middleware::requireAdmin();

$auth = new Auth();
$user = $auth->getUser();

$pageTitle = 'Dashboard - Klinika Medina';
$pageDescription = 'Paneli administrativ i Klinikës Medina';
$currentPage = 'dashboard';

require_once __DIR__ . '/../../views/layouts/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Dashboard Administrativ</h1>
        <p>Mirësevini, <?php echo htmlspecialchars($user['name']); ?></p>
    </div>
</section>

<section class="admin-dashboard">
    <div class="container">
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="dashboard-icon">👥</div>
                <h3>Përdoruesit</h3>
                <p>Menaxho përdoruesit e sistemit</p>
                <a href="users.php" class="btn-primary">Menaxho</a>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-icon">🩺</div>
                <h3>Shërbimet</h3>
                <p>Menaxho shërbimet e klinikës</p>
                <a href="services.php" class="btn-primary">Menaxho</a>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-icon">📰</div>
                <h3>Lajmet</h3>
                <p>Menaxho lajmet dhe artikujt</p>
                <a href="news.php" class="btn-primary">Menaxho</a>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-icon">👨‍⚕️</div>
                <h3>Ekipi</h3>
                <p>Menaxho anëtarët e ekipit</p>
                <a href="team.php" class="btn-primary">Menaxho</a>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-icon">✉️</div>
                <h3>Mesazhet</h3>
                <p>Shiko mesazhet e kontaktit</p>
                <a href="messages.php" class="btn-primary">Shiko</a>
            </div>
            <div class="dashboard-card">
                <div class="dashboard-icon">ℹ️</div>
                <h3>Rreth Nesh</h3>
                <p>Menaxho përmbajtjen e faqes Rreth Nesh</p>
                <a href="about.php" class="btn-primary">Menaxho</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../views/layouts/footer.php'; ?>
