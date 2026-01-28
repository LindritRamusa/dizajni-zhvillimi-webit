<section class="auth-section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Hyrje</h1>
                <p>Hyni në llogarinë tuaj</p>
            </div>

            <?php if (!empty($error)): ?>
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
