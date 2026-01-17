<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Models\Service;

session_start();

$serviceModel = new Service();
$services = $serviceModel->findAll();
$servicesPreview = array_slice($services, 0, 3);

$pageTitle = 'Klinika Medina - Faqja Kryesore';
$pageDescription = 'Klinika Medina - Kujdesi mjekësor profesional dhe i sigurt';
$currentPage = 'home';
$additionalScripts = ['/js/slider.js'];

require_once __DIR__ . '/../views/layouts/header.php';
?>

<section class="hero-slider">
    <div class="slider-container" id="sliderContainer">
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
    </div>
    <div class="slider-controls">
        <button class="slider-btn prev" id="prevBtn">‹</button>
        <button class="slider-btn next" id="nextBtn">›</button>
    </div>
    <div class="slider-dots">
        <span class="dot active" data-slide="0"></span>
        <span class="dot" data-slide="1"></span>
        <span class="dot" data-slide="2"></span>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2 class="section-title">Pse të Zgjidhni Klinikën Medina?</h2>
        <div class="features-grid">
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
                <p>plane trajtimesh të personalizuara për çdo pacient</p>
            </div>
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

<?php require_once __DIR__ . '/../views/layouts/footer.php'; ?>

