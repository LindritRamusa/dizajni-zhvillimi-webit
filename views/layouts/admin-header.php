<?php
if (!isset($auth)) {
    session_start();
    \App\Core\Middleware::requireAdmin();
    $auth = new \App\Core\Auth();
    $user = $auth->getUser();
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $pageDescription ?? 'Admin Dashboard - Klinika Medina'; ?>">
    <title><?php echo $pageTitle ?? 'Admin Dashboard - Klinika Medina'; ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/responsive.css">
</head>
<body>
    <div class="admin-wrapper" id="adminWrapper">
        <div class="admin-sidebar-overlay" id="adminSidebarOverlay" aria-hidden="true"></div>
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-sidebar-header">
                <h2>Klinika Medina</h2>
                <p class="admin-user-name"><?php echo htmlspecialchars($user['name']); ?></p>
            </div>
            <nav class="admin-nav">
                <ul class="admin-nav-list">
                    <li>
                        <a href="dashboard.php" class="admin-nav-link <?php echo ($currentPage ?? '') === 'dashboard' ? 'active' : ''; ?>">
                            <span class="nav-icon">📊</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="users.php" class="admin-nav-link <?php echo ($currentPage ?? '') === 'users' ? 'active' : ''; ?>">
                            <span class="nav-icon">👥</span>
                            <span>Përdoruesit</span>
                        </a>
                    </li>
                    <li>
                        <a href="services.php" class="admin-nav-link <?php echo ($currentPage ?? '') === 'services' ? 'active' : ''; ?>">
                            <span class="nav-icon">🩺</span>
                            <span>Shërbimet</span>
                        </a>
                    </li>
                    <li>
                        <a href="news.php" class="admin-nav-link <?php echo ($currentPage ?? '') === 'news' ? 'active' : ''; ?>">
                            <span class="nav-icon">📰</span>
                            <span>Lajmet</span>
                        </a>
                    </li>
                    <li>
                        <a href="messages.php" class="admin-nav-link <?php echo ($currentPage ?? '') === 'messages' ? 'active' : ''; ?>">
                            <span class="nav-icon">✉️</span>
                            <span>Mesazhet</span>
                        </a>
                    </li>
                    <li>
                        <a href="content.php" class="admin-nav-link <?php echo ($currentPage ?? '') === 'content' ? 'active' : ''; ?>">
                            <span class="nav-icon">📄</span>
                            <span>Përmbajtja</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="admin-sidebar-footer">
                <a href="/index.php" class="admin-nav-link">
                    <span class="nav-icon">🏠</span>
                    <span>Faqja Kryesore</span>
                </a>
                <a href="/logout.php" class="admin-nav-link">
                    <span class="nav-icon">🚪</span>
                    <span>Dil</span>
                </a>
            </div>
        </aside>
        <main class="admin-main">
            <header class="admin-topbar">
                <div class="admin-topbar-content">
                    <button type="button" class="admin-menu-btn" id="adminMenuBtn" aria-label="Hap menunë" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <h1><?php echo $pageTitle ?? 'Dashboard'; ?></h1>
                    <div class="admin-topbar-actions">
                        <span class="admin-role-badge">Administrator</span>
                    </div>
                </div>
            </header>
            <div class="admin-content-wrapper">
