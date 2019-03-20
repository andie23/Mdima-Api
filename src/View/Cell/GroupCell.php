<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Group cell
 */
class GroupCell extends Cell
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
        $this->loadModel("Groups");
        $this->set('name', $this->Groups->get($id)->name);
    }
}
