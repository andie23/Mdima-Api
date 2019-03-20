
<div class="row">
<div class="col-md-2">
<div class="list-group">
  <?= $this->Html->link(__('New Schedule'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
    </div>
</div>
<div class="col-md-10">
    <div class="card" width=100?>
    <h5 class="card-header"><?= __('Schedules') ?></h5>
    <div class="card-body">
    <table class="table" >
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('duration') ?></th>
                <th><?= $this->Paginator->sort('starting_date') ?></th>
                <th><?= $this->Paginator->sort('ending_date') ?></th>
                <th><?= $this->Paginator->sort('group_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th class="actions"><?= __('Options') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?= $this->Number->format($schedule->id) ?></td>
                <td><?= $this->Number->format($schedule->duration) ?>(Hours)</td>
                <td><?= h($schedule->starting_date) ?></td>
                <td><?= h($schedule->ending_date) ?></td>
                <td><?= $schedule->has('group') ? $this->Html->link($schedule->group->name, ['controller' => 'Groups', 'action' => 'view', $schedule->group->id]) : '' ?></td>
                <td><?= h($schedule->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $schedule->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Modify'), ['action' => 'edit', $schedule->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $schedule->id], ['class'=>'badge badge-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)]) ?>
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

