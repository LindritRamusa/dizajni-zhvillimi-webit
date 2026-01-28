<div class="admin-table-container">
    <div class="admin-table-header">
        <h2>Lista e Përdoruesve</h2>
        <span class="table-count">Total: <?php echo count($users); ?></span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri</th>
                <th>Email</th>
                <th>Telefoni</th>
                <th>Roli</th>
                <th>Data Regjistrimit</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Nuk ka përdorues të regjistruar</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['id']); ?></td>
                        <td><?php echo htmlspecialchars($u['name']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td><?php echo htmlspecialchars($u['phone'] ?? '-'); ?></td>
                        <td>
                            <span class="role-badge <?php echo $u['role'] === 'admin' ? 'role-admin' : 'role-user'; ?>">
                                <?php echo $u['role'] === 'admin' ? 'Administrator' : 'Përdorues'; ?>
                            </span>
                        </td>
                        <td><?php echo date('d.m.Y H:i', strtotime($u['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
