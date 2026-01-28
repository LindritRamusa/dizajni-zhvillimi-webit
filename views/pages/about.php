<section class="page-header">
    <div class="container">
        <h1>Rreth Nesh</h1>
        <p>Klinika Medina – kujdes mjekësor profesional</p>
    </div>
</section>

<section class="services-content" style="padding: 4rem 0;">
    <div class="container">
        <?php if (empty($aboutContent)): ?>
            <div class="service-details-content" style="max-width: 800px; margin: 0 auto;">
                <div class="service-description">
                    <h2>Rreth Nesh</h2>
                    <p>Klinika Medina ofron kujdes mjekësor profesional për ju dhe familjen tuaj. Ekipi ynë përbëhet nga mjekë dhe infermierë me përvojë.</p>
                    <h2>Misioni Jonë</h2>
                    <p>Të ofrojmë shërbime mjekësore cilësore dhe të arritshme për të gjithë pacientët.</p>
                    <h2>Vlerat Tona</h2>
                    <p>Profesionalizëm, empati dhe përkushtim ndaj shëndetit të pacientëve.</p>
                </div>
            </div>
        <?php else: ?>
            <div class="service-details-content" style="max-width: 800px; margin: 0 auto;">
                <div class="service-description">
                    <?php foreach ($aboutContent as $block): ?>
                        <div style="margin-bottom: 2rem;">
                            <?php if (!empty($block['title'])): ?>
                                <h2><?php echo htmlspecialchars($block['title']); ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($block['image'])): ?>
                                <?php
                                $img = $block['image'];
                                $isFile = strpos($img, '/') === 0 || strpos($img, 'http') === 0 || strpos($img, '.') !== false;
                                ?>
                                <?php if ($isFile): ?>
                                    <p><img src="<?php echo $img[0] === '/' || substr($img, 0, 4) === 'http' ? htmlspecialchars($img) : '/uploads/' . htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($block['title'] ?? ''); ?>" style="max-width: 100%; height: auto; border-radius: 8px;"></p>
                                <?php else: ?>
                                    <p><span style="font-size: 2rem;"><?php echo htmlspecialchars($img); ?></span></p>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($block['content'])): ?>
                                <p style="line-height: 1.7;"><?php echo nl2br(htmlspecialchars($block['content'])); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
