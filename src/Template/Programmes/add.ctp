<div class="row">
<div class="col-md-2">
<div class="list-group">
        <?= $this->Html->link(__('List Programmes'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        <?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>

        <?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>

</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($programme) ?>
    <div class="card">
    <h5 class="card-header"> <?= __('Add Programme') ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('name', ['class'=> 'form-control', 'placeholder' => 'name',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('is_published', ['label'=>'Is primary schedule', 'class'=> 'form-control', 'placeholder' => 'is_published',]);
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Next'),['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
