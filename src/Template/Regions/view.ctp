<div class="row">
<div class="col-md-2">
<div class="list-group">
    <?= $this->Html->link(__('Add Locations'), ['controller'=>'Locations', 'action' => 'add', '?'=>['region_id' => $region->id] ],['class' => 'list-group-item list-group-item-action']) ?>

    <?= $this->Html->link(__('Edit Region'), ['action' => 'edit', $region->id], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Form->postLink(__('Delete Region'), ['action' => 'delete', $region->id], ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $region->id)]) ?>
    <?= $this->Html->link(__('List Regions'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link(__('New Region'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index'],['class' => 'list-group-item list-group-item-action']) ?>
        <?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
</div>

<div class="col-md-10">
    
<div class="card border-secondary mb-3" style="max-width: 78rem;">
  <div class="card-header"><h3><?= h($region->name) ?></h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Details</h5>
    <p class="card-text">
    <table class="table">
                                        <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($region->name) ?></td>
                </tr>
                                                        <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($region->id) ?></td>
                </tr>
                                    </table>
                                    <div class="related">
        <h4><?= __('Related Locations') ?></h4>
        <?php if (!empty($region->locations)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($region->locations as $locations): ?>
            <tr>
                <td><?= h($locations->id) ?></td>
                <td><?= h($locations->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Locations', 'action' => 'view', $locations->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Locations', 'action' => 'edit', $locations->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Locations', 'action' => 'delete', $locations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $locations->id)]) ?>

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
