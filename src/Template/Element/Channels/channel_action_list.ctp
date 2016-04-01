<?php foreach ($actions as $action): ?>
    <?= $action->created . ': ' . $action->user->firstname . ' switched channel ' . ($action->channel + 1) . ' ' . $action->state; ?><br>
<?php endforeach; ?>
