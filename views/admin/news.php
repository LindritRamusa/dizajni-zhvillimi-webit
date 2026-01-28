<div class="admin-table-container">
    <div class="admin-table-header">
        <h2>Lista e Lajmeve</h2>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <span class="table-count">Total: <?php echo count($news); ?></span>
            <a href="news-add.php" class="btn-primary">+ Shto Lajm</a>
        </div>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulli</th>
                <th>Imazhi</th>
                <th>PDF</th>
                <th>Autori</th>
                <th>Data</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($news)): ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">Nuk ka lajme të regjistruara</td>
                </tr>
            <?php else: ?>
                <?php foreach ($news as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id']); ?></td>
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td>
                            <?php if (!empty($item['image'])): ?>
                                <img src="/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                                <span style="color: var(--text-light);">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($item['pdf_document'])): ?>
                                <a href="/uploads/<?php echo htmlspecialchars($item['pdf_document']); ?>" target="_blank" style="font-size: 0.875rem;">PDF</a>
                            <?php else: ?>
                                <span style="color: var(--text-light);">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($item['author_name'] ?? '-'); ?></td>
                        <td><?php echo date('d.m.Y H:i', strtotime($item['created_at'])); ?></td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="news-edit.php?id=<?php echo $item['id']; ?>" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Ndrysho</a>
                                <a href="news-delete.php?id=<?php echo $item['id']; ?>" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem; background-color: var(--error-color);" onclick="return confirm('A jeni të sigurt që dëshironi të fshini këtë lajm?');">Fshi</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
