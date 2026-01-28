<div class="admin-form-container">
    <div class="admin-form-header">
        <h2>Shto Lajm të Ri</h2>
        <a href="news.php" class="btn-secondary">← Kthehu</a>
    </div>

    <?php if (!empty($error)): ?>
        <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="admin-form">
        <div class="form-group">
            <label for="title">Titulli *</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="content">Përmbajtja *</label>
            <textarea id="content" name="content" rows="8" required><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Imazhi</label>
            <input type="file" id="image" name="image" accept="image/*">
            <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Formate të lejuara: JPG, PNG, GIF, WEBP</small>
        </div>

        <div class="form-group">
            <label for="pdf_document">Dokumenti PDF</label>
            <input type="file" id="pdf_document" name="pdf_document" accept="application/pdf">
            <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Vetëm PDF</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Ruaj Lajmin</button>
            <a href="news.php" class="btn-secondary">Anulo</a>
        </div>
    </form>
</div>
