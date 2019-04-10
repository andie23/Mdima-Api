<div class="row">
<div class="col-md-2">
<div class="list-group">
      <?= $this->Html->link(__('Assign Schedules'), ['controller'=>'Schedules', 'action' => 'add', '?'=>['group_id' => $group->id]],['class' => 'list-group-item list-group-item-action']) ?>
      <?= $this->Html->link(__('Assign Areas'), ['controller'=>'Allocations', 'action' => 'add', '?'=>['group_id' => $group->id]],['class' => 'list-group-item list-group-item-action']) ?>

       <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $group->id],
                ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $group->id)],
                []
            )
        ?>
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
    <h5 class="card-header"> <?= __('Edit Group') ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'name',]);
            echo "</div>";

            echo "<div class='form-group'>";
            echo $this->Form->input('programme_id', ['class'=> 'form-control', 'options' => $programmes]);
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
