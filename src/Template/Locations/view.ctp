<div class="row">
<div class="col-md-2">
<div class="list-group">
<?= $this->Html->link(__('Assign Areas'), ['controller'=>'Areas', 'action' => 'add', '?'=>['location_id'=>$location->id]],['class' => 'list-group-item list-group-item-action']) ?>

    <?= $this->Html->link(__('Edit Location'), ['action' => 'edit', $location->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Form->postLink(__('Delete Location'), ['action' => 'delete', $location->id], ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $location->id)]) ?>
    <?= $this->Html->link(__('List Locations'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link(__('New Location'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
</div>

<div class="col-md-10">
    
<div class="card border-secondary mb-3" style="max-width: 78rem;">
  <div class="card-header"><h3><?= h($location->name) ?></h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Details</h5>
    <p class="card-text">
    <table class="table">
                                        <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($location->name) ?></td>
                </tr>
                                        <tr>
                    <th><?= __('Region') ?></th>
                    <td><?= $location->has('region') ? $this->Html->link($location->region->name, ['controller' => 'Regions', 'action' => 'view', $location->region->id]) : '' ?></td>
                </tr>
                                                        <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($location->id) ?></td>
                </tr>
                                    </table>
    </p>
    <div class="related">
        <h4><?= __('Related Areas') ?></h4>
        <?php if (!empty($location->areas)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Location Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($location->areas as $areas): ?>
            <tr>
                <td><?= h($areas->id) ?></td>
                <td><?= h($areas->name) ?></td>
                <td><?= h($areas->location_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Areas', 'action' => 'view', $areas->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Areas', 'action' => 'edit', $areas->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Areas', 'action' => 'delete', $areas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $areas->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
  </div>
</div>
    

</div>
</div>
</div>
