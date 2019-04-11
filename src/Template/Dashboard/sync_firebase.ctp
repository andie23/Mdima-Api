<div class="row">
    <div class="col-sm-3 col-md-3"> 
        <div class="list-group">
            <?= $this->Form->postLink(__('Export to Firebase'), ['action' => 'sync_firebase'], ['class' => 'list-group-item list-group-item-action']) ?></li>
        </div>
    </div>

    <div class="col-sm-8 col-md-8"> 
        <div class="card">
            <h3 class='card-header'> Exportable Json Data </h3>
            <div class="card-body">
                <?php foreach($export as $title => $data): ?>
                    <div class="card"> 
                        <div class="card-body"> 
                            <h5><?= strtoupper($title)?> </h5>
                            <?= json_encode($data) ?> 
                        </div>
                    </div>
                    <p/>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>