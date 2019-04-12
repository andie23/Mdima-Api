<?php
    $isProgrameSet = false;
    $title = "Add Group";
    $programmeTextField =  $this->Form->input('programme_id', ['class'=> 'form-control', 'options' => $programmes]);
    if($id = $this->request->query('programme_id') and $programme=$this->request->query('programme'))
    {
        $isProgrameSet = true;
        $title = "New group for ". $programme;
        $programmeTextField = $this->Form->input('programme_id', ['type'=>'hidden', 'value'=>$id]);
    }
?>
<div class="row">
<div class="col-md-2">
<div class="list-group">
        <?= $this->Html->link(__('List Groups'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        <?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($group) ?>
    <div class="card">
    <h5 class="card-header"> <?= $title ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'E.g. GROUP A - 00-00-0000 - 00-00-0000',]);
            echo "</div>";
           
            echo "<div class='form-group'>";
            echo $programmeTextField;
            echo "</div>";
        ?>

        <?php if(!$isProgrameSet): ?>
            <div class="custom-control custom-checkbox" style="margin-bottom:10px;">
                <input type="checkbox" class="custom-control-input" name="reuse" id="reuse">
                <label class="custom-control-label" for="reuse">Reuse Programme after submission</label>
            </div>
        <?php endif;?>
        
        <div class="custom-control custom-checkbox" style="margin-bottom:10px;">
            <input type="checkbox" class="custom-control-input" name="continue" id="allocateAreas">
            <label class="custom-control-label" for="allocateAreas">Continue to area allocation</label>
        </div>

    <?= $this->Form->button(__('Add'),['class' => 'btn btn-primary']) ?>
    
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
