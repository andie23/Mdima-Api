
<div class="row">
<div class="col-md-2">
<div class="list-group">
  <?= $this->Html->link(__('New Area'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
    </div>
</div>
<div class="col-md-10">
    <div class="card" width=100?>
    <h5 class="card-header"><?= __('Areas') ?></h5>
    <div class="card-body">
    <table class="table" >
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('location_id') ?></th>
                <th class="actions"><?= __('Options') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($areas as $area): ?>
            <tr>
                <td><?= $this->Number->format($area->id) ?></td>
                <td><?= h($area->name) ?></td>
                <td><?= $area->has('location') ? $this->Html->link($area->location->name, ['controller' => 'Locations', 'action' => 'view', $area->location->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $area->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Modify'), ['action' => 'edit', $area->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $area->id], ['class'=>'badge badge-danger','confirm' => __('Are you sure you want to delete # {0}?', $area->id)]) ?>
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

