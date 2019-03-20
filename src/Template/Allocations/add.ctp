<?php 
    $title = "Allocate Areas to group";
    $groupInputView = $this->Form->input('allocations.group_id', ['placeholder' => 'group_id', 'class'=> 'custom-select custom-select-lg mb-3"', 'options' => $groups]);

    if($groupId=$this->request->query('group_id'))
    {
        $title = "Allocation areas to Group ". $this->cell('Group::name', ['id'=>$groupId]);
        $groupInputView = $this->Form->input('allocations.group_id', ['value'=>$groupId, 'type'=>'hidden']);
    }
?>
<div class="row">
<div class="col-md-2">
<div class="list-group">
        <?= $this->Html->link(__('List Allocations'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        <?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($allocation) ?>
    <div class="card">
    <h5 class="card-header"> <?= $title ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $groupInputView;
            echo "</div>";
        ?>
        <div class="row">
            <?php foreach($regionAreas as $region => $areas):?>
                <div class="col-md-4"> 
                    <div class="card">
                        <div class="card-header"><?= $region?></div>
                        <div class="card-body">
                        <?php foreach($areas as $area): ?>
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="area.<?= $area->id?>" id="area.<?= $area->id?>">
                                <label class="custom-control-label" for="area.<?= $area->id?>"><?= $area->area ?> - <?= $area->location?></label>
                                </div>
                                <p/>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
