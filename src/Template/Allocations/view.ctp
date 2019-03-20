<div class="row">
<div class="col-md-2">
<div class="list-group">
    <?= $this->Html->link(__('Edit Allocation'), ['action' => 'edit', $allocation->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Form->postLink(__('Delete Allocation'), ['action' => 'delete', $allocation->id], ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $allocation->id)]) ?>
    <?= $this->Html->link(__('List Allocations'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link(__('New Allocation'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
</div>

<div class="col-md-10">
    
<div class="card border-secondary mb-3" style="max-width: 78rem;">
  <div class="card-header"><h3><?= h($allocation->id) ?></h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Details</h5>
    <p class="card-text">
    <table class="table">
                                        <tr>
                    <th><?= __('Area') ?></th>
                    <td><?= $allocation->has('area') ? $this->Html->link($allocation->area->name, ['controller' => 'Areas', 'action' => 'view', $allocation->area->id]) : '' ?></td>
                </tr>
                                        <tr>
                    <th><?= __('Group') ?></th>
                    <td><?= $allocation->has('group') ? $this->Html->link($allocation->group->name, ['controller' => 'Groups', 'action' => 'view', $allocation->group->id]) : '' ?></td>
                </tr>
                                                        <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($allocation->id) ?></td>
                </tr>
                                    </table>
    </p>
  </div>
</div>
    
</div>
</div>
</div>
