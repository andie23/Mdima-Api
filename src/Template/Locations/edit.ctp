<div class="row">
<div class="col-md-2">
<div class="list-group">
<?= $this->Html->link(__('Assign Areas'), ['controller'=>'Areas', 'action' => 'add', '?'=>['location_id'=>$location->id]],['class' => 'list-group-item list-group-item-action']) ?>

       <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $location->id],
                ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $location->id)],
                []
            )
        ?>
        <?= $this->Html->link(__('List Locations'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        <?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($location) ?>
    <div class="card">
    <h5 class="card-header"> <?= __('Edit Location') ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'name',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('region_id', ['placeholder' => 'region_id', 'class'=> 'custom-select custom-select-lg mb-3"', 'options' => $regions]);
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
