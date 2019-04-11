<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <h3 class="card-header">Client notification</h3>

            <div class="card-body">
                <form action="<?= $this->url->build(['controller'=>'Dashboard', 'action'=>'send_schedule_notification']) ?>" method="post">
                    <div class="form-group">
                        <label for="title">Title </label>
                        <input type="text" value="<?= $title?>" class="form-control" name="title" id="title" placeholder="Notification title" required/>
                    </div>
                    
                    <div class="form-group">
                        <label for="body">Body </label>
                        <textarea rows=3 name="body" id="body" class="form-control" required> <?= $body ?> </textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary primary" value="Submit"/> 
                    </div>
            </div>
        </div>
    </div>
</div>