<div class="row">
<div class="col-md-2">
<div class="list-group">
    <?= $this->Html->link(__('Edit Area'), ['action' => 'edit', $area->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Form->postLink(__('Delete Area'), ['action' => 'delete', $area->id], ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $area->id)]) ?>
    <?= $this->Html->link(__('List Areas'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link(__('New Area'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
</div>

<div class="col-md-10">
    
<div class="card border-secondary mb-3" style="max-width: 78rem;">
  <div class="card-header"><h3><?= h($area->name) ?></h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Details</h5>
    <p class="card-text">
    <table class="table">
                                        <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($area->name) ?></td>
                </tr>
                                        <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= $area->has('location') ? $this->Html->link($area->location->name, ['controller' => 'Locations', 'action' => 'view', $area->location->id]) : '' ?></td>
                </tr>
                                                        <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($area->id) ?></td>
                </tr>
                                    </table>
    <div class="related">
        <h4><?= __('Related Allocations') ?></h4>
        <?php if (!empty($area->allocations)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Group Id') ?></th>
                <th><?= __('Area Id') ?></th>
                <th><?= __('Schedule Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($area->allocations as $allocations): ?>
            <tr>
                <td><?= h($allocations->id) ?></td>
                <td><?= h($allocations->group_id) ?></td>
                <td><?= h($allocations->area_id) ?></td>
                <td><?= h($allocations->schedule_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Allocations', 'action' => 'view', $allocations->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Allocations', 'action' => 'edit', $allocations->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Allocations', 'action' => 'delete', $allocations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allocations->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    </p>
  </div>
</div>
    
</div>
</div>
</div>
