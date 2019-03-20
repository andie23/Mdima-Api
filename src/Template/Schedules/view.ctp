<div class="row">
<div class="col-md-2">
<div class="list-group">
    <?= $this->Html->link(__('Edit Schedule'), ['action' => 'edit', $schedule->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Form->postLink(__('Delete Schedule'), ['action' => 'delete', $schedule->id], ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)]) ?>
    <?= $this->Html->link(__('List Schedules'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link(__('New Schedule'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
</div>

<div class="col-md-10">
    
<div class="card border-secondary mb-3" style="max-width: 78rem;">
  <div class="card-header"><h3><?= h($schedule->name) ?></h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Details</h5>
    <p class="card-text">
    <table class="table">
                                        <tr>
                    <th><?= __('Group') ?></th>
                    <td><?= $schedule->has('group') ? $this->Html->link($schedule->group->name, ['controller' => 'Groups', 'action' => 'view', $schedule->group->id]) : '' ?></td>
                </tr>
                                        <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($schedule->name) ?></td>
                </tr>
                                                        <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($schedule->id) ?></td>
                </tr>
                        <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= $this->Number->format($schedule->duration) ?></td>
                </tr>
                                                <tr>
                    <th><?= __('Starting Date') ?></th>
                    <td><?= h($schedule->starting_date) ?></td>
                </tr>
                        <tr>
                    <th><?= __('Ending Date') ?></th>
                    <td><?= h($schedule->ending_date) ?></td>
                </tr>
                            </table>
    </p>
  </div>
</div>
    
</div>
</div>
</div>
