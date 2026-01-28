<section class="page-header">
    <div class="container">
        <h1><?php echo htmlspecialchars($news['title']); ?></h1>
        <p style="font-size: 1rem; color: var(--text-light);">
            <?php echo htmlspecialchars($news['author_name'] ?? 'Klinika Medina'); ?> · <?php echo date('d.m.Y H:i', strtotime($news['created_at'])); ?>
        </p>
    </div>
</section>

<section class="service-details">
    <div class="container">
        <div class="service-details-content">
            <div class="service-description">
                <?php if (!empty($news['image'])): ?>
                    <div class="service-image-large" style="margin-bottom: 2rem;">
                        <img src="/uploads/<?php echo htmlspecialchars($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 10px;">
                    </div>
                <?php endif; ?>

                <div class="news-content" style="line-height: 1.7;">
                    <?php echo nl2br(htmlspecialchars($news['content'])); ?>
                </div>

                <?php if (!empty($news['pdf_document'])): ?>
                    <div class="info-box" style="margin-top: 2rem;">
                        <h3>Dokumenti i bashkëngjitur</h3>
                        <a href="/uploads/<?php echo htmlspecialchars($news['pdf_document']); ?>" target="_blank" class="btn-primary" style="display: inline-block;">Shkarko PDF</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="service-details-sidebar">
                <div class="info-box">
                    <h3>Informacione</h3>
                    <ul>
                        <li><strong>Autori:</strong> <?php echo htmlspecialchars($news['author_name'] ?? '-'); ?></li>
                        <li><strong>Data:</strong> <?php echo date('d.m.Y H:i', strtotime($news['created_at'])); ?></li>
                    </ul>
                </div>

                <div class="info-box">
                    <h3>Lajme të tjera</h3>
                    <p>Për të parë të gjitha lajmet, vizitoni faqen e lajmeve.</p>
                    <a href="news.php" class="btn-primary" style="display: block; text-align: center; margin-top: 1rem;">Të gjitha Lajmet</a>
                </div>
            </div>
        </div>
    </div>
</section>
