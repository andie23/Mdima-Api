<?php 
 $isRegionSet = false;
 $title = 'Add Location';
 $regionInputView = $this->Form->input('region_id', ['placeholder' => 'region_id', 'class'=> 'custom-select custom-select-lg mb-3"', 'options' => $regions]);
 
 if($regionId=$this->request->query('region_id'))
 {
    $isRegionSet = true;
    $title = "Add Locations for ". $this->cell("Region::name", ['id'=>$regionId]);
    $regionInputView = $this->Form->input('region_id', ['type'=>'hidden', 'value'=>$regionId]);
 }
?>
<div class="row">
<div class="col-md-2">
<div class="list-group">
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
    <h5 class="card-header"> <?= $title ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'name',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $regionInputView;
            echo "</div>";
        ?>
        
        <?php if(!$isRegionSet): ?>
            <div class="custom-control custom-checkbox" style="margin-bottom:10px;">
                <input type="checkbox" class="custom-control-input" name="reuse" id="reuse">
                <label class="custom-control-label" for="reuse">Reuse Region after submission</label>
            </div>
        <?php else: ?>
            <div class="custom-control custom-checkbox" style="margin-bottom:10px;">
                <input type="checkbox" class="custom-control-input" name="new" id="new">
                <label class="custom-control-label" for="new">Use another region after submission</label>
            </div>    
        <?php endif;?>
        
        <div class="custom-control custom-checkbox" style="margin-bottom:10px;">
            <input type="checkbox" class="custom-control-input" name="continue" id="addAreas">
            <label class="custom-control-label" for="addAreas">Add areas after submission</label>
        </div>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
