<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\RealTimeDatabaseClient;
use App\Lib\CloudMessagingClient;
/**
 * Dashboard Controller
 *
 * @property \App\Model\Table\DashboardTable $Dashboard
 */
class DashboardController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
       
    }

    public function syncFirebase()
    {
        $this->loadModel('Regions');
        $this->loadModel('Locations');
        $this->loadModel('Areas');
        $this->loadModel('Groups');
        $this->loadModel('Schedules');
        $this->loadModel('Summary');
        
        $summary = new RealTimeDatabaseClient(['summary']);
        $schedule = new RealTimeDatabaseClient(['schedules']);
        $regions = new RealTimeDatabaseClient(['regions']);
        $locations = new RealTimeDatabaseClient(['locations']);
        $areas = new RealTimeDatabaseClient(['areas']);

        try{
            if($summary->put($this->Summary->getSummary()) and  $schedule->put($this->Groups->getGroupSchedules())
                 and $regions->put($this->Regions->getAllRegionData()) and $locations->put($this->Locations->getAllLocationDataByRegions())
                 and $areas->put($this->Areas->getAllAreaDataByLocations())){
                $this->Flash->success('Data is now available to firebase users');
            }else{
                $this->Flash->error('Failed to sync data with firebase');
            }
        }catch(\Exception $e){
            $this->Flash->error('An error occured! check your internet connection status');
        }
        
        return $this->redirect(['controller'=>'Dashboard', 'action' => 'index']);
    }

    public function sendScheduleNotification()
    {
        $this->loadModel('Summary');
        $loadsheddingSummary = $this->Summary->getSummary();

        $title = 'Blackout schedule update';
        $body = __('{0} blackouts scheduled, {1} regions and {2} areas affected',
             $loadsheddingSummary['blackoutCount'], $loadsheddingSummary['regionsAffected'],
             $loadsheddingSummary['areasAffected']
        );

        if($this->request->is('post'))
        {
            $data = $this->request->data;
            $title = $data['title'];
            $body = $data['body'];
            $messagingClient = new CloudMessagingClient();

            if($messagingClient->post($title, $body))
            {
                $this->Flash->success('Loadshedding notification has been sent!');
            }else{
                $this->Flash->error('Failed to send notitifcation. Please check the logs for more info');
            }
            return $this->redirect(['controller'=>'Dashboard', 'action'=>'index']);
        }

        $this->set('title', $title);
        $this->set('body', $body);
    }
    
}
