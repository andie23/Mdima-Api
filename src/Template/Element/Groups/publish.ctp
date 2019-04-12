<?php if($programme->is_published): ?>
        <?= $this->Html->link(__('Unpublish (Not Synched)'), ['action' => 'unpublish', $programme->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?php else: ?>
        <?= $this->Html->link(__('Publish (Synched)'), ['action' => 'publish', $programme->id], ['class' => 'list-group-item list-group-item-action']) ?>
<?php endif; ?>