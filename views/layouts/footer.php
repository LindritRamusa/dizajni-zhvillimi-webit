    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Klinika Medina</h3>
                    <p>Kujdesi mjekësor profesional dhe i sigurt për ju dhe familjen tuaj.</p>
                </div>
                <div class="footer-section">
                    <h4>Linqe të Shpejta</h4>
                    <ul>
                        <li><a href="index.php">Faqja Kryesore</a></li>
                        <li><a href="about.php">Rreth Nesh</a></li>
                        <li><a href="services.php">Shërbimet</a></li>
                        <li><a href="contact.php">Kontakti</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Kontakti</h4>
                    <p>📍 Rruga Ramadan Rexhepi, Ferizaj</p>
                    <p>📞 +383 49 162 111</p>
                    <p>✉️ medina@medina-ks.com</p>
                </div>
                <div class="footer-section">
                    <h4>Orari</h4>
                    <p>E Hënë - E Premte: 08:00 - 20:00</p>
                    <p>E Shtunë: 09:00 - 15:00</p>
                    <p>E Dielë: E Mbyllur</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Klinika Medina. Të gjitha të drejtat e rezervuara.</p>
            </div>
        </div>
    </footer>

    <script src="/js/main.js"></script>
    <?php if (isset($additionalScripts)): ?>
        <?php foreach ($additionalScripts as $script): ?>
            <script src="<?php echo $script; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

