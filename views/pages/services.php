<section class="page-header">
    <div class="container">
        <h1>Shërbimet Tona</h1>
        <p>Kujdesi mjekësor profesional për çdo nevojë</p>
    </div>
</section>

<section class="services-content">
    <div class="container">
        <?php if (empty($services)): ?>
            <div style="text-align: center; padding: 4rem;">
                <p style="font-size: 1.25rem; color: var(--text-light);">Nuk ka shërbime të disponueshme për momentin.</p>
            </div>
        <?php else: ?>
            <div class="services-grid-full">
                <?php foreach ($services as $service): ?>
                    <div class="service-card-large">
                        <?php if ($service['image']): ?>
                            <div class="service-image-large">
                                <img src="/uploads/<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;">
                            </div>
                        <?php elseif ($service['icon']): ?>
                            <div class="service-icon-large">
                                <?php echo htmlspecialchars($service['icon']); ?>
                            </div>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                        <?php if ($service['subtitle']): ?>
                            <p style="color: var(--primary-color); font-weight: 500; margin-bottom: 1rem;"><?php echo htmlspecialchars($service['subtitle']); ?></p>
                        <?php endif; ?>
                        <?php if ($service['description']): ?>
                            <p style="color: var(--text-light); margin-bottom: 1.5rem;"><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
                        <?php endif; ?>
                        <ul class="service-features">
                            <?php if ($service['duration']): ?>
                                <li><strong>Kohëzgjatja:</strong> <?php echo htmlspecialchars($service['duration']); ?></li>
                            <?php endif; ?>
                            <?php if ($service['price']): ?>
                                <li><strong>Çmimi:</strong> <?php echo htmlspecialchars($service['price']); ?></li>
                            <?php endif; ?>
                            <?php if ($service['availability']): ?>
                                <li><strong>Disponueshmëria:</strong> <?php echo htmlspecialchars($service['availability']); ?></li>
                            <?php endif; ?>
                        </ul>
                        <a href="service-details.php?id=<?php echo $service['id']; ?>" class="btn-primary">Më Shumë</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
