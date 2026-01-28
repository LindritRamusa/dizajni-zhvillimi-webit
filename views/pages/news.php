<section class="page-header">
    <div class="container">
        <h1>Lajmet</h1>
        <p>Lajmet e fundit dhe informacione të rëndësishme nga Klinika Medina</p>
    </div>
</section>

<section class="services-content">
    <div class="container">
        <?php if (empty($news)): ?>
            <div style="text-align: center; padding: 4rem;">
                <p style="font-size: 1.25rem; color: var(--text-light);">Nuk ka lajme të disponueshme për momentin.</p>
            </div>
        <?php else: ?>
            <div class="services-grid-full">
                <?php foreach ($news as $item): ?>
                    <div class="service-card-large">
                        <?php if (!empty($item['image'])): ?>
                            <div class="service-image-large">
                                <img src="/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;">
                            </div>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p style="color: var(--text-light); font-size: 0.875rem; margin-bottom: 0.75rem;">
                            <?php echo htmlspecialchars($item['author_name'] ?? 'Klinika Medina'); ?> · <?php echo date('d.m.Y', strtotime($item['created_at'])); ?>
                        </p>
                        <?php if (!empty($item['content'])): ?>
                            <p style="color: var(--text-light); margin-bottom: 1.5rem;"><?php echo nl2br(htmlspecialchars(mb_substr($item['content'], 0, 200))); ?><?php echo mb_strlen($item['content']) > 200 ? '…' : ''; ?></p>
                        <?php endif; ?>
                        <a href="news-details.php?id=<?php echo $item['id']; ?>" class="btn-primary">Lexo Më Shumë</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
