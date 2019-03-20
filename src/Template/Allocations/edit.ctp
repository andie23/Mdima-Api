<div class="row">
<div class="col-md-2">
<div class="list-group">
       <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $allocation->id],
                ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $allocation->id)],
                []
            )
        ?>
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
    <h5 class="card-header"> <?= __('Edit Allocation') ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('area_id', ['placeholder' => 'area_id', 'class'=> 'custom-select custom-select-lg mb-3"', 'options' => $areas]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('group_id', ['placeholder' => 'group_id', 'class'=> 'custom-select custom-select-lg mb-3"', 'options' => $groups]);
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-outline-danger']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
