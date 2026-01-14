<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Core\Auth;
use App\Core\Middleware;

session_start();

$auth = new Auth();

$error = '';
$success = '';

Middleware::guestOnly();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($password !== $confirmPassword) {
        $error = 'Fjalëkalimet nuk përputhen';
    } else {
        $result = $auth->register([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password
        ]);

        if ($result['success']) {
            $redirectUrl = $auth->getRedirectUrl();
            header('Location: ' . $redirectUrl);
            exit;
        } else {
            $error = $result['message'];
        }
    }
}

$pageTitle = 'Regjistrohu - Klinika Medina';
$pageDescription = 'Regjistrohu për të qasur shërbimet e Klinikës Medina';
$currentPage = 'register';

require_once __DIR__ . '/../views/layouts/header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Regjistrohu</h1>
                <p>Krijo llogari të re për të qasur shërbimet tona</p>
            </div>

            <?php if ($error): ?>
                <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div style="background-color: #efe; color: #3c3; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #3c3;">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form" id="registerForm">
                <div class="form-group">
                    <label for="registerName">Emri i plotë *</label>
                    <input type="text" id="registerName" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                    <span class="error-message" id="registerNameError"></span>
                </div>

                <div class="form-group">
                    <label for="registerEmail">Email *</label>
                    <input type="email" id="registerEmail" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    <span class="error-message" id="registerEmailError"></span>
                </div>

                <div class="form-group">
                    <label for="registerPhone">Telefoni *</label>
                    <input type="tel" id="registerPhone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
                    <span class="error-message" id="registerPhoneError"></span>
                </div>

                <div class="form-group">
                    <label for="registerPassword">Fjalëkalimi *</label>
                    <input type="password" id="registerPassword" name="password" required>
                    <span class="error-message" id="registerPasswordError"></span>
                </div>

                <div class="form-group">
                    <label for="registerConfirmPassword">Konfirmo Fjalëkalimin *</label>
                    <input type="password" id="registerConfirmPassword" name="confirm_password" required>
                    <span class="error-message" id="registerConfirmPasswordError"></span>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="agreeTerms" name="agree_terms" required>
                        <span>Pranoj kushtet dhe rregullat *</span>
                    </label>
                    <span class="error-message" id="agreeTermsError"></span>
                </div>

                <button type="submit" class="btn-primary btn-full">Regjistrohu</button>
            </form>

            <div class="auth-footer">
                <p>Keni tashmë llogari? <a href="login.php">Hyni këtu</a></p>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../views/layouts/footer.php'; ?>
