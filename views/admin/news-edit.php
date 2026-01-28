<div class="admin-form-container">
    <div class="admin-form-header">
        <h2>Ndrysho Lajm</h2>
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
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($newsItem['title']); ?>" required>
        </div>

        <div class="form-group">
            <label for="content">Përmbajtja *</label>
            <textarea id="content" name="content" rows="8" required><?php echo htmlspecialchars($newsItem['content']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Imazhi</label>
            <?php if (!empty($newsItem['image'])): ?>
                <div style="margin-bottom: 1rem;">
                    <img src="/uploads/<?php echo htmlspecialchars($newsItem['image']); ?>" alt="" style="max-width: 200px; height: auto; border-radius: 5px; display: block; margin-bottom: 0.5rem;">
                    <small style="color: var(--text-light);">Imazhi aktual</small>
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
            <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Lëreni bosh për të mbajtur imazhin aktual</small>
        </div>

        <div class="form-group">
            <label for="pdf_document">Dokumenti PDF</label>
            <?php if (!empty($newsItem['pdf_document'])): ?>
                <div style="margin-bottom: 1rem;">
                    <a href="/uploads/<?php echo htmlspecialchars($newsItem['pdf_document']); ?>" target="_blank" style="font-size: 0.875rem;">Shiko PDF aktual</a>
                    <small style="color: var(--text-light); display: block; margin-top: 0.25rem;">Dokumenti aktual</small>
                </div>
            <?php endif; ?>
            <input type="file" id="pdf_document" name="pdf_document" accept="application/pdf">
            <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Lëreni bosh për të mbajtur dokumentin aktual</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Ruaj Ndryshimet</button>
            <a href="news.php" class="btn-secondary">Anulo</a>
        </div>
    </form>
</div>
