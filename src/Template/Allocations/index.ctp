
<div class="row">
<div class="col-md-2">
<div class="list-group">
  <?= $this->Html->link(__('New Allocation'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
    </div>
</div>
<div class="col-md-10">
    <div class="card" width=100?>
    <h5 class="card-header"><?= __('Allocations') ?></h5>
    <div class="card-body">
    <table class="table" >
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('area_id') ?></th>
                <th><?= $this->Paginator->sort('group_id') ?></th>
                <th class="actions"><?= __('Options') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allocations as $allocation): ?>
            <tr>
                <td><?= $this->Number->format($allocation->id) ?></td>
                <td><?= $allocation->has('area') ? $this->Html->link($allocation->area->name, ['controller' => 'Areas', 'action' => 'view', $allocation->area->id]) : '' ?></td>
                <td><?= $allocation->has('group') ? $this->Html->link($allocation->group->name, ['controller' => 'Groups', 'action' => 'view', $allocation->group->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $allocation->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Modify'), ['action' => 'edit', $allocation->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $allocation->id], ['class'=>'badge badge-danger','confirm' => __('Are you sure you want to delete # {0}?', $allocation->id)]) ?>
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

