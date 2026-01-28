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
