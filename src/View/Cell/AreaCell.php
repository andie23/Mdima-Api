<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Area cell
 */
class AreaCell extends Cell
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
        $this->loadModel('Areas');
        $this->set('name', $this->Areas->get($id)->name);
    }
}
