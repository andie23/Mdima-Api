<div class="row">
<div class="col-md-2">
<div class="list-group">
    <?= $this->Html->link(__('Edit Programme'), ['action' => 'edit', $programme->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Form->postLink(__('Delete Programme'), ['action' => 'delete', $programme->id], ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $programme->id)]) ?>
    <?= $this->Html->link(__('List Programmes'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link(__('New Programme'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
</div>

<div class="col-md-10">
    
<div class="card border-secondary mb-3" style="max-width: 78rem;">
  <div class="card-header"><h3><?= h($programme->name) ?></h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Details</h5>
    <p class="card-text">
    <table class="table">
                                        <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($programme->name) ?></td>
                </tr>
                                                        <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($programme->id) ?></td>
                </tr>
                                                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($programme->created) ?></td>
                </tr>
                                                <tr>
                    <th><?= __('Is Published') ?></th>
                    <td><?= $programme->is_published ? __('Yes') : __('No'); ?></td>
                </tr>
                        <tr>
                    <th><?= __('Is Notified') ?></th>
                    <td><?= $programme->is_notified ? __('Yes') : __('No'); ?></td>
                </tr>
                    </table>
    </p>
  </div>
</div>
    
    <div class="related">
        <h4><?= __('Related Groups') ?></h4>
        <?php if (!empty($programme->groups)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Programme Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($programme->groups as $groups): ?>
            <tr>
                <td><?= h($groups->id) ?></td>
                <td><?= h($groups->name) ?></td>
                <td><?= h($groups->programme_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groups->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
</div>
</div>
