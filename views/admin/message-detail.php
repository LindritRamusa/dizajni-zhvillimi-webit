<div class="admin-table-container">
    <div class="admin-form-header" style="margin-bottom: 1.5rem;">
        <h2>Mesazhi nga <?php echo htmlspecialchars($msg['name']); ?></h2>
        <a href="messages.php" class="btn-secondary">← Kthehu te lista</a>
    </div>

    <div class="info-box" style="max-width: 800px; margin-bottom: 1rem;">
        <p style="margin: 0.5rem 0;"><strong>Emri:</strong> <?php echo htmlspecialchars($msg['name']); ?></p>
        <p style="margin: 0.5rem 0;"><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>"><?php echo htmlspecialchars($msg['email']); ?></a></p>
        <p style="margin: 0.5rem 0;"><strong>Telefoni:</strong> <?php echo htmlspecialchars($msg['phone'] ?? '-'); ?></p>
        <p style="margin: 0.5rem 0;"><strong>Tema:</strong> <?php echo htmlspecialchars($msg['subject'] ?? '-'); ?></p>
        <p style="margin: 0.5rem 0;"><strong>Data:</strong> <?php echo date('d.m.Y H:i', strtotime($msg['created_at'])); ?></p>
    </div>

    <div class="info-box" style="max-width: 800px;">
        <h3 style="margin-top: 0;">Mesazhi</h3>
        <p style="white-space: pre-wrap; margin: 0;"><?php echo htmlspecialchars($msg['message']); ?></p>
    </div>
</div>
