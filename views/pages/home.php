<section class="hero-slider">
    <div class="slider-container" id="sliderContainer">
        <?php if (empty($slides)): ?>
            <div class="slide active">
                <div class="slide-content">
                    <h1>Mirësevini në Klinikën Medina</h1>
                    <p>Kujdesi mjekësor profesional për ju dhe familjen tuaj</p>
                    <a href="services.php" class="btn-primary">Shiko Shërbimet</a>
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Mjekë Profesionalë</h1>
                    <p>Ekipi ynë i ekspertëve është këtu për t'ju ndihmuar</p>
                    <a href="about.php" class="btn-primary">Më Shumë</a>
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Termina Online</h1>
                    <p>Rezervoni terminin tuaj lehtësisht dhe shpejt</p>
                    <a href="contact.php" class="btn-primary">Kontaktoni</a>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($slides as $i => $slide): ?>
                <div class="slide<?php echo $i === 0 ? ' active' : ''; ?>">
                    <div class="slide-content">
                        <h1><?php echo htmlspecialchars($slide['title'] ?? 'Klinika Medina'); ?></h1>
                        <p><?php echo htmlspecialchars($slide['content'] ?? ''); ?></p>
                        <a href="<?php echo htmlspecialchars($slideLinks[$i] ?? 'services.php'); ?>" class="btn-primary"><?php echo htmlspecialchars($slideLinkLabels[$i] ?? 'Më Shumë'); ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="slider-controls">
        <button class="slider-btn prev" id="prevBtn">‹</button>
        <button class="slider-btn next" id="nextBtn">›</button>
    </div>
    <div class="slider-dots">
        <?php
        $slideCount = !empty($slides) ? count($slides) : 3;
        for ($i = 0; $i < $slideCount; $i++):
        ?>
        <span class="dot<?php echo $i === 0 ? ' active' : ''; ?>" data-slide="<?php echo $i; ?>"></span>
        <?php endfor; ?>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2 class="section-title"><?php echo htmlspecialchars(($featuresTitleRow['title'] ?? 'Pse të Zgjidhni Klinikën Medina') ?: 'Pse të Zgjidhni Klinikën Medina'); ?></h2>
        <div class="features-grid">
            <?php if (empty($featureCards)): ?>
                <div class="feature-card">
                    <div class="feature-icon">🏥</div>
                    <h3>Teknologji Moderne</h3>
                    <p>Pajisje mjekësore të fundit për diagnostikim dhe trajtim të saktë</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👨‍⚕️</div>
                    <h3>Mjekë Ekspertë</h3>
                    <p>Ekipi ynë përbëhet nga specialistë me përvojë të gjatë</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⏰</div>
                    <h3>Orar Fleksibël</h3>
                    <p>Jashtë orarit normal për nevojat tuaja urgjente</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💊</div>
                    <h3>Trajtim Personalizuar</h3>
                    <p>Plane trajtimesh të personalizuara për çdo pacient</p>
                </div>
            <?php else: ?>
                <?php foreach ($featureCards as $card): ?>
                    <div class="feature-card">
                        <div class="feature-icon"><?php echo htmlspecialchars($card['image'] ?? '🩺'); ?></div>
                        <h3><?php echo htmlspecialchars($card['title'] ?? ''); ?></h3>
                        <p><?php echo htmlspecialchars($card['content'] ?? ''); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="services-preview">
    <div class="container">
        <h2 class="section-title">Shërbimet Tona</h2>
        <div class="services-grid">
            <?php if (empty($servicesPreview)): ?>
                <div class="service-card">
                    <div class="service-icon">🩺</div>
                    <h3>Shërbime Mjekësore</h3>
                    <p>Konsultime me mjekë specialistë për çdo problem shëndetësor</p>
                </div>
            <?php else: ?>
                <?php foreach ($servicesPreview as $service): ?>
                    <div class="service-card">
                        <?php if ($service['icon']): ?>
                            <div class="service-icon"><?php echo htmlspecialchars($service['icon']); ?></div>
                        <?php else: ?>
                            <div class="service-icon">🩺</div>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                        <p><?php echo htmlspecialchars($service['subtitle'] ?? $service['description'] ?? 'Shërbim mjekësor profesional'); ?></p>
                        <a href="service-details.php?id=<?php echo $service['id']; ?>" class="btn-secondary">Më Shumë</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center">
            <a href="services.php" class="btn-primary">Shiko Të Gjitha Shërbimet</a>
        </div>
    </div>
</section>
