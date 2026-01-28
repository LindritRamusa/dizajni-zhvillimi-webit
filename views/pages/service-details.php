<section class="page-header">
    <div class="container">
        <h1><?php echo htmlspecialchars($service['title']); ?></h1>
        <?php if (!empty($service['subtitle'])): ?>
            <p><?php echo htmlspecialchars($service['subtitle']); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="service-details">
    <div class="container">
        <div class="service-details-content">
            <div class="service-description">
                <?php if (!empty($service['image'])): ?>
                    <div class="service-image-large">
                        <img src="/uploads/<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" style="width: 100%; height: 400px; object-fit: cover; border-radius: 10px; margin-bottom: 2rem;">
                    </div>
                <?php endif; ?>

                <h2>Përshkrimi</h2>
                <?php if (!empty($service['description'])): ?>
                    <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
                <?php else: ?>
                    <p>Nuk ka përshkrim të disponueshëm për këtë shërbim.</p>
                <?php endif; ?>
            </div>

            <div class="service-details-sidebar">
                <div class="info-box">
                    <h3>Informacione</h3>
                    <ul>
                        <?php if (!empty($service['duration'])): ?>
                            <li><strong>Kohëzgjatja:</strong> <?php echo htmlspecialchars($service['duration']); ?></li>
                        <?php endif; ?>
                        <?php if (!empty($service['price'])): ?>
                            <li><strong>Çmimi:</strong> <?php echo htmlspecialchars($service['price']); ?></li>
                        <?php endif; ?>
                        <?php if (!empty($service['availability'])): ?>
                            <li><strong>Disponueshmëria:</strong> <?php echo htmlspecialchars($service['availability']); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="info-box">
                    <h3>Kontakti</h3>
                    <p>Për më shumë informacione ose për të rezervuar një termin, ju lutem na kontaktoni.</p>
                    <a href="contact.php" class="btn-primary" style="display: block; text-align: center; margin-top: 1rem;">Kontaktoni</a>
                </div>
            </div>
        </div>
    </div>
</section>
