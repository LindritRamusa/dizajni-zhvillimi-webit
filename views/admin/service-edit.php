<div class="admin-form-container">
    <div class="admin-form-header">
        <h2>Ndrysho Shërbim</h2>
        <a href="services.php" class="btn-secondary">← Kthehu</a>
    </div>

    <?php if (!empty($error)): ?>
        <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="admin-form">
        <div class="form-group">
            <label for="title">Titulli *</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required>
        </div>

        <div class="form-group">
            <label for="subtitle">Nëntitulli</label>
            <input type="text" id="subtitle" name="subtitle" value="<?php echo htmlspecialchars($service['subtitle'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="icon">Ikona (Emoji)</label>
            <input type="text" id="icon" name="icon" value="<?php echo htmlspecialchars($service['icon'] ?? ''); ?>" placeholder="🩺">
        </div>

        <div class="form-group">
            <label for="description">Përshkrimi</label>
            <textarea id="description" name="description" rows="5"><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="duration">Kohëzgjatja</label>
                <input type="text" id="duration" name="duration" value="<?php echo htmlspecialchars($service['duration'] ?? ''); ?>" placeholder="30-60 minuta">
            </div>

            <div class="form-group">
                <label for="price">Çmimi</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($service['price'] ?? ''); ?>" placeholder="Nga 20 euro">
            </div>
        </div>

        <div class="form-group">
            <label for="availability">Disponueshmëria</label>
            <input type="text" id="availability" name="availability" value="<?php echo htmlspecialchars($service['availability'] ?? ''); ?>" placeholder="E Hënë - E Premte: 08:00 - 20:00">
        </div>

        <div class="form-group">
            <label for="image">Imazhi</label>
            <?php if (!empty($service['image'])): ?>
                <div style="margin-bottom: 1rem;">
                    <img src="/uploads/<?php echo htmlspecialchars($service['image']); ?>" alt="" style="max-width: 200px; height: auto; border-radius: 5px; display: block; margin-bottom: 0.5rem;">
                    <small style="color: var(--text-light);">Imazhi aktual</small>
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
            <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Lëreni bosh për të mbajtur imazhin aktual</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Ruaj Ndryshimet</button>
            <a href="services.php" class="btn-secondary">Anulo</a>
        </div>
    </form>
</div>
