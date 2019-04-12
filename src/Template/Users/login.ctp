<div class="row justify-content-center">

    <div class="col-sm-12"> 
        <div class="card mb-3 justify-content-center" style="max-width: 898px;">
        <div class="row no-gutters">

            <div class="col-md-8">
            <div class="card-body">
          
                <div class="card">
                    <div class="card">
                        <div class="card-header"><?= $this->Html->image('logo.png') ?> <b class="text text-secondary">Mdima</b></div>
                        <div class="card-body text text-secondary">
                            Our Android app makes you easily track load-shedding schedules released by Escom
                            Using an intuitive and user friendly UI.
                            <p/>
                            <a href='#' class="btn btn-success">Download APK </a>
                        </div>
                    </div>
                    <div class="card-header"><i class="fa fa-user-circle icon fa-4x"></i> Login</div>
                    <div class="card-body">
                    <div class="p-3 mb-2 bg-danger text-white"><b>ATTENTION:</b> This portal is for administration only. For use, download the mdima app</div>
                    <?= $this->Form->create('', ['controller' => 'Users', 'action' => 'login']) ?>
                    <?php
                        echo "<div class='form-group'>";
                        echo $this->Form->input('username', ['class'=> 'form-control', 'placeholder' => 'Your username',]);
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo $this->Form->input('password', ['class'=> 'form-control', 'placeholder' => 'Your password',]);
                        echo "</div>";
                    ?>
                    <?= $this->Form->button(__('Sign-in'), ['class' => 'btn btn-success']) ?>
                    <?= $this->Form->end() ?> 
                </div>    
                </div>  
                <p/>
            </div>
            </div>
            <div class="col-md-4">
            <?= $this->Html->image('app.png', ['class'=>'card-img']) ?>
            </div>
        </div>
        </div>
    </div>
</div>