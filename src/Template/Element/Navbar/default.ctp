<nav class="navbar navbar-expand-lg sticky-top navbar-dark  bg-primary text-white ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?= $this->url->build(['controller'=>'Dashboard', 'action'=>'index'])?>"> <b> Mdima-Web</b></a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->Url->build(['controller'=>'Programmes', 'action'=>'index'])?>">Programmes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->Url->build(['controller'=>'Schedules', 'action'=>'index'])?>">Schedules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->Url->build(['controller'=>'Locations', 'action'=>'index'])?>">Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->Url->build(['controller'=>'Areas', 'action'=>'index'])?>">Areas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->Url->build(['controller'=>'Regions', 'action'=>'index'])?>">Regions</a>
            </li>
            </ul>
            <b><?= $this->fetch('title') ?></b>
        </div>
    </nav>