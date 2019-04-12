<div class="row">
<div class="col-md-2">
<div class="list-group">
       <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['class' => 'list-group-item list-group-item-action', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)],
                []
            )
        ?>
        <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?></li>
</div>
</div>
<div class="col-md-10">   
    <?= $this->Form->create($user) ?>
    <div class="card">
    <h5 class="card-header"> <?= __('Edit User') ?></h5>
    <div class="card-body">
        <?php
            echo "<div class='form-group'>";
            echo $this->Form->input('fullname', ['class'=> 'form-control', 'placeholder' => 'fullname',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('username', ['class'=> 'form-control', 'placeholder' => 'username',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('password', ['class'=> 'form-control', 'placeholder' => 'password',]);
            echo "</div>";
            echo "<div class='form-group'>";
            echo $this->Form->input('last_login', ['class'=> 'form-control', 'placeholder' => 'last_login',]);
            echo "</div>";
        ?>
    <p/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-outline-danger']) ?>
    <?= $this->Form->end() ?> 
    </div>
</div>
</div>
</div>
