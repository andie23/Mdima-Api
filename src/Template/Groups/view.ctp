<div class="row">
<div class="col-md-2">
<div class="list-group">
        <?= $this->Html->link(__('Assign Schedules'), ['controller'=>'Schedules', 'action' => 'add', '?'=>['group_id' => $group->id]],['class' => 'list-group-item list-group-item-action']) ?>
      <?= $this->Html->link(__('Assign Areas'), ['controller'=>'Allocations', 'action' => 'add', '?'=>['group_id' => $group->id]],['class' => 'list-group-item list-group-item-action']) ?>    <?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->id], ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $group->id)]) ?>
    <?= $this->Html->link(__('List Groups'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link(__('New Group'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
</div>

<div class="col-md-10">
    
<div class="card border-secondary mb-3" style="max-width: 78rem;">
  <div class="card-header"><h3><?= h($group->name) ?></h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Details</h5>
    <p class="card-text">
    <table class="table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($group->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($group->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Programme') ?></th>
            <td><?= h($group->programme->name) ?></td>
        </tr>
    </table>
            <div class="related">
                <h4><?= __('Area Allocations') ?></h4>
                <?php if (!empty($group->allocations)): ?>
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Area') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($group->allocations as $allocations): ?>
                    <tr>
                        <td><?= h($allocations->id) ?></td>
                        <td><?= $this->cell('Area::name', ['id'=>$allocations->area_id]) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Allocations', 'action' => 'view', $allocations->id], ['class'=>'badge badge-primary']) ?>
            
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Allocations', 'action' => 'edit', $allocations->id], ['class'=>'badge badge-primary']) ?>
            
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Allocations', 'action' => 'delete', $allocations->id], ['class'=>'badge badge-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $allocations->id)]) ?>
            
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Schedules') ?></h4>
                <?php if (!empty($group->schedules)): ?>
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Name') ?></th>
                        <th><?= __('Duration(Hours)') ?></th>
                        <th><?= __('Starting Date') ?></th>
                        <th><?= __('Ending Date') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($group->schedules as $schedules): ?>
                    <tr>
                        <td><?= h($schedules->id) ?></td>
                        <td><?= h($schedules->name) ?></td>
                        <td><?= h($schedules->duration) ?></td>
                        <td><?= h($schedules->starting_date) ?></td>
                        <td><?= h($schedules->ending_date) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Schedules', 'action' => 'view', $schedules->id], ['class'=>'badge badge-primary']) ?>
            
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Schedules', 'action' => 'edit', $schedules->id], ['class'=>'badge badge-primary']) ?>
            
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schedules', 'action' => 'delete', $schedules->id], ['class'=>'badge badge-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $schedules->id)]) ?>
            
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
