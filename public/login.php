<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Core\Auth;

session_start();

$auth = new Auth();

$error = '';

if ($auth->isLoggedIn()) {
    if ($auth->isAdmin()) {
        header('Location: /admin/dashboard.php');
    } else {
        header('Location: /index.php');
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $auth->login($email, $password);

    if ($result['success']) {
        if ($result['role'] === 'admin') {
            header('Location: /admin/dashboard.php');
        } else {
            header('Location: /index.php');
        }
        exit;
    } else {
        $error = $result['message'];
    }
}

$pageTitle = 'Hyrje - Klinika Medina';
$pageDescription = 'Hyni në llogarinë tuaj për të qasur shërbimet e Klinikës Medina';
$currentPage = 'login';

require_once __DIR__ . '/../views/layouts/header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Hyrje</h1>
                <p>Hyni në llogarinë tuaj</p>
            </div>

            <?php if ($error): ?>
                <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form" id="loginForm">
                <div class="form-group">
                    <label for="loginEmail">Email *</label>
                    <input type="email" id="loginEmail" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    <span class="error-message" id="loginEmailError"></span>
                </div>

                <div class="form-group">
                    <label for="loginPassword">Fjalëkalimi *</label>
                    <input type="password" id="loginPassword" name="password" required>
                    <span class="error-message" id="loginPasswordError"></span>
                </div>

                <button type="submit" class="btn-primary btn-full">Hyr</button>
            </form>

            <div class="auth-footer">
                <p>Nuk keni llogari? <a href="register.php">Regjistrohuni këtu</a></p>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../views/layouts/footer.php'; ?>
