<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\SearchIndexClient;
/**
 * Areas Controller
 *
 * @property \App\Model\Table\AreasTable $Areas
 */
class AreasController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations']
        ];
        $this->set('areas', $this->paginate($this->Areas));
        $this->set('_serialize', ['areas']);
    }

    /**
     * View method
     *
     * @param string|null $id Area id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $area = $this->Areas->get($id, [
            'contain' => ['Locations', 'Allocations']
        ]);
        $this->set('area', $area);
        $this->set('_serialize', ['area']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $area = $this->Areas->newEntity();
        if ($this->request->is('post')) {
            $area = $this->Areas->patchEntity($area, $this->request->data);
            if ($this->Areas->save($area)) {
                $this->loadModel('Locations');
                $this->loadModel('Regions');
                $location = $this->Locations->get($area->location_id);
                $searchIndex = new SearchIndexClient();
                $searchIndex->index([
                    'objectID' => $area->id,
                    'area' => $area->name,
                    'region' => $this->Regions->get($location->region_id)->name,
                    'location' => $location->name
                ]);
                $this->Flash->success(__('The area has been saved.'));
                if($locationId=$this->request->query('location_id')){
                    return $this->redirect(['action'=>'add', '?'=>['location_id'=>$locationId]]);
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The area could not be saved. Please, try again.'));
            }
        }
        $locations = $this->Areas->Locations->find('list', ['limit' => 200]);
        $this->set(compact('area', 'locations'));
        $this->set('_serialize', ['area']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Area id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $area = $this->Areas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $area = $this->Areas->patchEntity($area, $this->request->data);
            if ($this->Areas->save($area)) {
                $this->loadModel('Locations');
                $this->loadModel('Regions');
                $location = $this->Locations->get($area->location_id);
                $searchIndex = new SearchIndexClient();
                $searchIndex->index([
                    'objectID' => $area->id,
                    'area' => $area->name,
                    'region' => $this->Regions->get($location->region_id)->name,
                    'location' => $location->name
                ]);
                $this->Flash->success(__('The area has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The area could not be saved. Please, try again.'));
            }
        }
        $locations = $this->Areas->Locations->find('list', ['limit' => 200]);
        $this->set(compact('area', 'locations'));
        $this->set('_serialize', ['area']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Area id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $area = $this->Areas->get($id);
        if ($this->Areas->delete($area)) {
            $searchIndex = new SearchIndexClient();
            $searchIndex->delete($area->id);
            $this->Flash->success(__('The area has been deleted.'));
        } else {
            $this->Flash->error(__('The area could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
