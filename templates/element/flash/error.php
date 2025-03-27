<?php if (!empty($message)): ?>
    <div id="flash-<?= h($key) ?>" class="alert alert-danger">
        <?= h($message) ?>
    </div>
<?php endif; ?>