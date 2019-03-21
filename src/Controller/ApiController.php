<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Api Controller
 *
 * @property \App\Model\Table\ApiTable $Api
 */
class ApiController extends AppController
{

    public function export()
    {

        $this->loadModel('Regions');
        $this->loadModel('Locations');
        $this->loadModel('Areas');
        $this->loadModel('Groups');

        $export = [
            'regions' => $this->Regions->getAllRegionsAndChildren(),
            'locations' => $this->Locations->getAllLocationsAndChildren(),
            'areas' => $this->Areas->getAllAreasAndChildren(), 
            'schedules' => $this->Groups->getAllGroupsAndChildren()
        ];
        debug($export);
        exit;
    }
}
