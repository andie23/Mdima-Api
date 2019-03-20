<?php 
    $title= "Add Area";
    $locationInputView = $this->Form->input('location_id', ['placeholder' => 'location_id', 'class'=> 'custom-select custom-select-lg mb-3"', 'options' => $locations]);

    if($locationId=$this->request->query('location_id'))
    {
        $title = "Add Area for ". $this->cell('Location::name',['id'=>$locationId]);
        $locationInputView = $this->Form->input('location_id', ['type'=>'hidden', 'value'=>$locationId]);
    }
?>
<div class="row">
<div class="col-md-2">
<div class="list-group">
        <?= $this->Html->link(__('List Areas'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        <?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($area) ?>
    <div class="card">
    <h5 class="card-header"> <?= $title ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'name',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $locationInputView;
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
