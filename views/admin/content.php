<div class="admin-table-container">
    <div class="admin-table-header">
        <h2>Përmbajtja</h2>
        <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <span style="display: flex; gap: 0.5rem;">
                <a href="content.php?section=home" class="btn-secondary<?php echo $section === 'home' ? ' active' : ''; ?>" style="padding: 0.5rem 1rem;">Faqja Kryesore</a>
                <a href="content.php?section=about" class="btn-secondary<?php echo $section === 'about' ? ' active' : ''; ?>" style="padding: 0.5rem 1rem;">Rreth Nesh</a>
            </span>
            <span class="table-count">Total: <?php echo count($blocks); ?></span>
            <a href="content-add.php?section=<?php echo urlencode($section); ?>" class="btn-primary">+ Shto Bllok</a>
        </div>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Renditja</th>
                <th>Titulli</th>
                <th>Përmbajtja</th>
                <th>Ndryshuar nga</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($blocks)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Nuk ka bllokë për këtë faqe. Shtoni të parin.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($blocks as $b): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($b['id']); ?></td>
                        <td><?php echo (int)$b['display_order']; ?></td>
                        <td><?php echo htmlspecialchars($b['title'] ?? '-'); ?></td>
                        <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars(mb_substr($b['content'] ?? '', 0, 80)); ?><?php echo mb_strlen($b['content'] ?? '') > 80 ? '…' : ''; ?></td>
                        <td><?php echo htmlspecialchars($b['creator_name'] ?? '-'); ?></td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="content-edit.php?id=<?php echo $b['id']; ?>" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Ndrysho</a>
                                <a href="content-delete.php?id=<?php echo $b['id']; ?>&section=<?php echo urlencode($section); ?>" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem; background-color: var(--error-color);" onclick="return confirm('A jeni të sigurt që dëshironi të fshini këtë bllok?');">Fshi</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
