<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * RegionCell cell
 */
class RegionCell extends Cell
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
        $this->loadModel('Regions');
        $this->set('name', $this->Regions->get($id)->name);
    }
}
