<div class="admin-form-container">
    <div class="admin-form-header">
        <h2>Shto bllok përmbajtjeje</h2>
        <a href="content.php?section=<?php echo urlencode($section); ?>" class="btn-secondary">← Kthehu</a>
    </div>

    <?php if (!empty($error)): ?>
        <div style="background-color: #fee; color: #c33; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #c33;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="admin-form">
        <input type="hidden" name="section" value="<?php echo htmlspecialchars($section); ?>">
        <div class="form-group">
            <label for="title">Titulli</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="content">Përmbajtja</label>
            <textarea id="content" name="content" rows="6"><?php echo htmlspecialchars($content ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Ikona / imazh (emoji ose emër skedari, p.sh. 🏥 ose foto.jpg)</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($image ?? ''); ?>" placeholder="🏥">
        </div>
        <div class="form-group">
            <label for="display_order">Renditja (numër)</label>
            <input type="number" id="display_order" name="display_order" value="<?php echo (int)($display_order ?? 0); ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-primary">Ruaj</button>
            <a href="content.php?section=<?php echo urlencode($section); ?>" class="btn-secondary">Anulo</a>
        </div>
    </form>
</div>
