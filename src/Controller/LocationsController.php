<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Locations Controller
 *
 * @property \App\Model\Table\LocationsTable $Locations
 */
class LocationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Regions']
        ];
        $this->set('locations', $this->paginate($this->Locations));
        $this->set('_serialize', ['locations']);
    }

    /**
     * View method
     *
     * @param string|null $id Location id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $location = $this->Locations->get($id, [
            'contain' => ['Regions', 'Areas']
        ]);
        $this->set('location', $location);
        $this->set('_serialize', ['location']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $location = $this->Locations->newEntity();
        if ($this->request->is('post')) {
            $location = $this->Locations->patchEntity($location, $this->request->data);
            if ($this->Locations->save($location)) {
                $this->Flash->success(__('{0} location has been saved.', $location->name));
                if(array_key_exists('continue', $this->request->data))
                {
                    return $this->redirect(['controller'=>'Areas', 'action' => 'add', '?'=>['location_id'=>$location->id]]);
                }
                if(array_key_exists('reuse', $this->request->data)){
                    return $this->redirect(['action'=>'add', '?'=>['region_id'=>$location->region_id]]);
                }
                if(array_key_exists('new', $this->request->data)){
                    return $this->redirect(['action'=>'add']);
                }
                if($regionId=$this->request->query('region_id')){
                    return $this->redirect(['action' => 'add', '?'=>['region_id'=>$regionId]]);
                }
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The location could not be saved. Please, try again.'));
            }
        }
        $regions = $this->Locations->Regions->find('list', ['limit' => 200]);
        $this->set(compact('location', 'regions'));
        $this->set('_serialize', ['location']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Location id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $location = $this->Locations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->data);
            if ($this->Locations->save($location)) {
                $this->Flash->success(__('The location has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The location could not be saved. Please, try again.'));
            }
        }
        $regions = $this->Locations->Regions->find('list', ['limit' => 200]);
        $this->set(compact('location', 'regions'));
        $this->set('_serialize', ['location']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Location id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $location = $this->Locations->get($id);
        if ($this->Locations->delete($location)) {
            $this->Flash->success(__('The location has been deleted.'));
        } else {
            $this->Flash->error(__('The location could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
