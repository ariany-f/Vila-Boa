<?php if (!empty($message)): ?>
    <div id="flash-<?= h($key) ?>" class="alert alert-success">
        <?= h($message) ?>
    </div>
<?php endif; ?>