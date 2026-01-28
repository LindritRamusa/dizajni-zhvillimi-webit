<section class="page-header">
    <div class="container">
        <h1>Na Kontaktoni</h1>
        <p>Jemi këtu për të ju ndihmuar me çdo pyetje</p>
    </div>
</section>

<section class="contact-section" style="padding: 4rem 0;">
    <div class="container">
        <div style="max-width: 600px; margin: 0 auto;">
            <?php if (!empty($error)): ?>
                <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div style="background-color: #efe; color: #3c3; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #3c3;">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form" id="contactForm">
                <div class="form-group">
                    <label for="contactName">Emri *</label>
                    <input type="text" id="contactName" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required class="<?php echo isset($errors['name']) ? 'error' : ''; ?>">
                    <span class="error-message" id="contactNameError"><?php echo isset($errors['name']) ? htmlspecialchars($errors['name']) : ''; ?></span>
                </div>

                <div class="form-group">
                    <label for="contactEmail">Email *</label>
                    <input type="email" id="contactEmail" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required class="<?php echo isset($errors['email']) ? 'error' : ''; ?>">
                    <span class="error-message" id="contactEmailError"><?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?></span>
                </div>

                <div class="form-group">
                    <label for="contactPhone">Telefoni</label>
                    <input type="tel" id="contactPhone" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" placeholder="+383 49 XXX XXX" class="<?php echo isset($errors['phone']) ? 'error' : ''; ?>">
                    <span class="error-message" id="contactPhoneError"><?php echo isset($errors['phone']) ? htmlspecialchars($errors['phone']) : ''; ?></span>
                </div>

                <div class="form-group">
                    <label for="contactSubject">Tema</label>
                    <select id="contactSubject" name="subject">
                        <option value="">Zgjidhni temën</option>
                        <option value="Informacione" <?php echo ($subject ?? '') === 'Informacione' ? 'selected' : ''; ?>>Informacione</option>
                        <option value="Termine" <?php echo ($subject ?? '') === 'Termine' ? 'selected' : ''; ?>>Termine</option>
                        <option value="Ankesa" <?php echo ($subject ?? '') === 'Ankesa' ? 'selected' : ''; ?>>Ankesa</option>
                        <option value="Tjera" <?php echo ($subject ?? '') === 'Tjera' ? 'selected' : ''; ?>>Tjera</option>
                    </select>
                    <span class="error-message" id="contactSubjectError"></span>
                </div>

                <div class="form-group">
                    <label for="contactMessage">Mesazhi *</label>
                    <textarea id="contactMessage" name="message" rows="5" required class="<?php echo isset($errors['message']) ? 'error' : ''; ?>"><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                    <span class="error-message" id="contactMessageError"><?php echo isset($errors['message']) ? htmlspecialchars($errors['message']) : ''; ?></span>
                </div>

                <button type="submit" class="btn-primary btn-full">Dërgo Mesazhin</button>
            </form>
        </div>
    </div>
</section>
