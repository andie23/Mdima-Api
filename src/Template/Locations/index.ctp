
<div class="row">
<div class="col-md-2">
<div class="list-group">
  <?= $this->Html->link(__('New Location'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add'] , ['class' => 'list-group-item list-group-item-action']) ?>
    </div>
</div>
<div class="col-md-10">
    <div class="card" width=100?>
    <h5 class="card-header"><?= __('Locations') ?></h5>
    <div class="card-body">
    <table class="table" >
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('region_id') ?></th>
                <th class="actions"><?= __('Options') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $location): ?>
            <tr>
                <td><?= $this->Number->format($location->id) ?></td>
                <td><?= h($location->name) ?></td>
                <td><?= $location->has('region') ? $this->Html->link($location->region->name, ['controller' => 'Regions', 'action' => 'view', $location->region->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Assign Areas'), ['controller'=>'Areas', 'action' => 'add', '?'=>['location_id'=>$location->id]],['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $location->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Html->link(__('Modify'), ['action' => 'edit', $location->id],['class'=>'badge badge-primary']) ?>
                    <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $location->id], ['class'=>'badge badge-danger','confirm' => __('Are you sure you want to delete # {0}?', $location->id)]) ?>
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

