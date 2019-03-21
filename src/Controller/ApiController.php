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

        $export = [
            'regions' => $this->Regions->getAllRegionsAndChildren(),
            'locations' => $this->Locations->getAllLocationsAndChildren(),
            'areas' => $this->Areas->getAllAreasAndChildren(), 
            'schedules' => $this->Groups->getAllGroupsAndChildren()
        ];
        echo json_encode($export);
    }

    public function regions()
    {
        $this->loadModel('Regions');
        echo json_encode($this->Regions->getAllRegionsAndChildren());
    }

    public function locations()
    {
        $this->loadModel('Locations');
        echo json_encode($this->Locations->getAllLocationsAndChildren());
    }

    public function areas()
    {
        $this->loadModel('Areas');
        echo json_encode($this->Areas->getAllAreasAndChildren());
    }
    
    public function schedules()
    {
        $this->loadModel('Groups');
        echo json_encode($this->Groups->getAllGroupsAndChildren());
    }
}
