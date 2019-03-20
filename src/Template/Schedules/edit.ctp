<div class="row">
<div class="col-md-2">
<div class="list-group">
       <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $schedule->id],
                ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)],
                []
            )
        ?>
        <?= $this->Html->link(__('List Schedules'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($schedule) ?>
    <div class="card">
    <h5 class="card-header"> <?= __('Edit Schedule') ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'name',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('starting_date', ['class'=> 'form-control', 'placeholder' => 'starting_date',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('ending_date', ['class'=> 'form-control', 'placeholder' => 'ending_date',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('group_id', ['placeholder' => 'group_id', 'class'=> 'custom-select custom-select-lg mb-3"', 'options' => $groups]);
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
