<nav class="navbar navbar-expand-lg sticky-top navbar-light  bg-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?= $this->url->build(['controller'=>'Dashboard', 'action'=>'index'])?>"> 
        <?= $this->Html->image('logo.png')?> <b>Mdima-Web Portal</b></a>
</nav>