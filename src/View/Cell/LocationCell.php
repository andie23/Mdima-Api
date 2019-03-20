<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Location cell
 */
class LocationCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function name($id)
    {
        $this->loadModel('Locations');
        $this->set('name', $this->Locations->get($id)->name);
    }
}
