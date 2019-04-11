<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\RealTimeDatabaseClient;
use App\Lib\CloudMessagingClient;
use App\Lib\SearchIndexClient;
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

    public function clearAreaIndex(){
        if($this->request->is('post'))
        {
            $searchIndex = new SearchIndexClient();
            if($searchIndex->clear())
            {
                $this->Flash->success('Search index has been cleared');
            }else{
                $this->Flash->error('An error has occured while flashing index');
            }
            return $this->redirect(['action'=>'index']);
        }
    }

    public function indexAllAreas(){

        if($this->request->is('post'))
        {
            $this->loadModel('Areas');
            $searchIndex = new SearchIndexClient();
            $batch = $searchIndex->buildBatch(
                $searchIndex::UPDATE_BATCH_REQUEST, $this->Areas->getAllAreas()
            );
    
            if($searchIndex->indexBatch($batch))
            {
                $this->Flash->success('Areas have been indexed!');
            }else{
                $this->Flash->error('Failed to index areas');
            }
    
            return $this->redirect(['action'=>'index']);
        }
    }
    
    public function syncFirebase()
    {
        $this->loadModel('Regions');
        $this->loadModel('Locations');
        $this->loadModel('Areas');
        $this->loadModel('Groups');
        $this->loadModel('Schedules');
        $this->loadModel('Summary');
        
        $export = [
            'summary' => $this->Summary->getSummary(),
            'schedules' => $this->Groups->getGroupSchedules(),
            'regions' => $this->Regions->getAllRegionData(),
            'locations' => $this->Locations->getAllLocationDataByRegions(),
            'areas' => $this->Areas->getAllAreaDataByLocations()
        ];

        if($this->request->is('post'))
        {
            $summary = new RealTimeDatabaseClient(['summary']);
            $schedule = new RealTimeDatabaseClient(['schedules']);
            $regions = new RealTimeDatabaseClient(['regions']);
            $locations = new RealTimeDatabaseClient(['locations']);
            $areas = new RealTimeDatabaseClient(['areas']);

            try{
                if($summary->put($export['summary']) and  $schedule->put($export['schedules'])
                     and $regions->put($export['regions']) and $locations->put($export['locations'])
                     and $areas->put($export['areas'])){
                    $this->Flash->success('Data is now available to firebase users');
                }else{
                    $this->Flash->error('Failed to sync data with firebase');
                }
            }catch(\Exception $e){
                $this->Flash->error('An error occured! check your internet connection status');
            }
            return $this->redirect(['controller'=>'Dashboard', 'action' => 'index']);
        }

        $this->set('export', $export);
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
            $export = $this->request->data;
            $title = $export['title'];
            $body = $export['body'];
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
