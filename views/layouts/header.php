<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $pageDescription ?? 'Klinika Medina - Kujdesi mjekësor profesional dhe i sigurt'; ?>">
    <title><?php echo $pageTitle ?? 'Klinika Medina'; ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/responsive.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <a href="index.php">Klinika Medina</a>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php" class="<?php echo ($currentPage ?? '') === 'home' ? 'active' : ''; ?>">Faqja Kryesore</a></li>
                    <li><a href="about.php" class="<?php echo ($currentPage ?? '') === 'about' ? 'active' : ''; ?>">Rreth Nesh</a></li>
                    <li><a href="services.php" class="<?php echo ($currentPage ?? '') === 'services' ? 'active' : ''; ?>">Shërbimet</a></li>
                    <li><a href="contact.php" class="<?php echo ($currentPage ?? '') === 'contact' ? 'active' : ''; ?>">Kontakti</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <li><a href="/admin/dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="/logout.php" class="btn-login">Dil</a></li>
                    <?php else: ?>
                        <li><a href="/login.php" class="btn-login">Login</a></li>
                        <li><a href="/register.php" class="btn-register">Regjistrohu</a></li>
                    <?php endif; ?>
                </ul>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>