<div class="features-boxed">
        <div class="container">
            <div class="intro">
                <h2 class="text-center"><?= $this->Html->image('logo.png')?></h2>
                <p class="text-center">Welcome to Mdima Panel. This is where you can manage loadshedding schedules for android clients to consume</p>
            </div>
            <div class="row justify-content-center features">
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-map-marker icon"></i>
                        <h3 class="name">Manage Locations</h3>
                        <p class="description">Add, Update, Delete locations, areas and regions</p>
                        <a href="<?= $this->url->build(['controller'=>'Locations', 'action'=>'index'])?>" class="badge badge-primary">Locations</a>
                        <a href="<?= $this->url->build(['controller'=>'Areas', 'action'=>'index'])?>" class="badge badge-primary">Areas</a>
                        <a href="<?= $this->url->build(['controller'=>'Regions', 'action'=>'index'])?>" class="badge badge-primary">Regions</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-clock-o icon"></i>
                        <h3 class="name">Manage Schedules</h3>
                        <p class="description">Add loadshedding schedule for clients to view</p>
                        <a href="<?= $this->url->build(['controller'=>'Programmes', 'action'=>'index'])?>" class="badge badge-primary">Programmes</a>
                        <a href="<?= $this->url->build(['controller'=>'Groups', 'action'=>'index'])?>" class="badge badge-primary">Groups</a>
                        <a href="<?= $this->url->build(['controller'=>'Schedules', 'action'=>'index'])?>" class="badge badge-primary">Schedules</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-list-alt icon"></i>
                        <h3 class="name">Firebase Synchronisation </h3>
                        <p class="description">Send data to firebase or send notifications to clients</p>
                        <a href="<?= $this->url->build(['controller'=>'Dashboard', 'action'=>'sync_firebase'])?>" class="badge badge-primary">Synchronise Database</a>
                        <a href="<?= $this->url->build(['controller'=>'Dashboard', 'action'=>'send_schedule_notification'])?>" class="badge badge-primary">Send Notifications</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-search icon"></i>
                        <h3 class="name">Algoria Synchronisation </h3>
                        <p class="description">Index operations in bulk</p>
                        <?= $this->Form->postLink(
                                 __('Clear Index'),
                                ['action' => 'clear_area_index'],
                                ['class' => 'badge badge-danger', 'confirm' => __('Are you sure you want to clear search index? Clients will affected')]
                            )
                        ?>
                        <?= $this->Form->postLink(
                                 __('Update index'),
                                ['action' => 'index_all_areas'],
                                ['class' => 'badge badge-success', 'confirm' => __('Are you sure you want to update the index?')]
                            )
                        ?>
                        </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-user-circle icon"></i>
                        <h3 class="name">User Accounts </h3>
                        <p class="description">Manage user authentication for web-app</p></div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-sign-out icon"></i>
                        <h3 class="name">Signout</h3>
                        <p class="description">Leave current session.</p></div>
                </div>
            </div>
        </div>
    </div>