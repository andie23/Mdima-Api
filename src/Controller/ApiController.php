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
    public function initialize()
    {
        parent::initialize();
        $this->RequestHandler->respondAs('json');
        $this->response->type('application/json');
        $this->autoRender = false;
    }
    public function index()
    {

        $this->loadModel('Regions');
        $this->loadModel('Locations');
        $this->loadModel('Areas');
        $this->loadModel('Groups');
        $this->loadModel('Schedules');

        $export = [
            'schedules' => $this->Schedules->getSchedules(),
            'regions' => $this->Regions->getAllRegionData(),
            'locations' => $this->Locations->getAllLocationDataByRegions(),
            'areas' => $this->Areas->getAllAreaDataByLocations(), 
            'groups' => $this->Groups->getAllGroupsAndChildren()
        ];
        echo json_encode($export);
    }

    public function regions()
    {
        $this->loadModel('Regions');
        echo json_encode($this->Regions->getAllRegionData());
    }

    public function locations()
    {
        $this->loadModel('Locations');
        echo json_encode($this->Locations->getAllLocationDataByRegions());
    }

    public function areas()
    {
        $this->loadModel('Areas');
        echo json_encode($this->Areas->getAllAreaDataByLocations());
    }
    
    public function schedules()
    {
        $this->loadModel('Schedules');
        echo json_encode($this->Groups->getSchedules());
    }

    public function groups()
    {
        $this->loadModel('Groups');
        echo json_encode($this->Groups->getAllGroupsAndChildren());
    }
}
