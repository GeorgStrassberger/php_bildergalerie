<h3>Status vom Upload:</h3>
<?php if(empty($message)): ?>
    <p>Alles okey</p>
<?php else: ?>
    <p><?php echo e($message); ?></p>
<?php endif; ?>

<a href="admin.php">Zurück zum Adminbereich.</a>
