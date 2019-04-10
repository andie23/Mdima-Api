
<div class="row">
<div class="col-md-2">
<div class="list-group">
  <?= $this->Html->link(__('New Group'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
    </div>
</div>
<div class="col-md-10">
    <div class="card" width=100?>
    <h5 class="card-header"><?= __('Groups') ?></h5>
    <div class="card-body">
    <table class="table" >
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('schedule') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th class="actions"><?= __('Options') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $group): ?>
            <tr>
                <td><?= $this->Number->format($group->id) ?></td>
                <td><?= h($group->programme->name) ?></td>
                <td><?= h($group->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Add Schedules'), ['controller'=>'Schedules', 'action' => 'add', '?'=>['group_id' => $group->id]], ['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Allocate Areas'), ['controller'=>'Allocations', 'action' => 'add', '?'=>['group_id' => $group->id]], ['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $group->id], ['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Modify'), ['action' => 'edit', $group->id], ['class'=>'badge badge-primary']) ?>
                    <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $group->id], ['class'=>'badge badge-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $group->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="pagination">
        <ul class="pagination">
            <?= $this->Paginator->prev(__('<< Previous ')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__(' Next >>')) ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>
</div>
</div>

