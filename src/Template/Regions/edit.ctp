<div class="row">
<div class="col-md-2">
<div class="list-group">
        <?= $this->Html->link(__('Add Locations'), ['controller'=>'Locations', 'action' => 'add', '?'=>['region_id' => $region->id] ],['class' => 'list-group-item list-group-item-action']) ?>

       <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $region->id],
                ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $region->id)],
                []
            )
        ?>
        <?= $this->Html->link(__('List Regions'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        <?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($region) ?>
    <div class="card">
    <h5 class="card-header"> <?= __('Edit Region') ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'name',]);
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
