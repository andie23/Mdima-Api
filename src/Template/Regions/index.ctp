
<div class="row">
<div class="col-md-2">
<div class="list-group">
  <?= $this->Html->link(__('New Region'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
    </div>
</div>
<div class="col-md-10">
    <div class="card" width=100?>
    <h5 class="card-header"><?= __('Regions') ?></h5>
    <div class="card-body">
    <table class="table" >
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th class="actions"><?= __('Options') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($regions as $region): ?>
            <tr>
                <td><?= $this->Number->format($region->id) ?></td>
                <td><?= h($region->name) ?></td>
                <td class="actions">

                    <?= $this->Html->link(__('Add Locations'), ['controller'=>'Locations', 'action' => 'add', '?'=>['region_id' => $region->id] ],['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $region->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Modify'), ['action' => 'edit', $region->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $region->id], ['class'=>'badge badge-danger','confirm' => __('Are you sure you want to delete # {0}?', $region->id)]) ?>
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

