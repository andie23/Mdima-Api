<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Allocations Controller
 *
 * @property \App\Model\Table\AllocationsTable $Allocations
 */
class AllocationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Areas', 'Groups']
        ];
        $this->set('allocations', $this->paginate($this->Allocations));
        $this->set('_serialize', ['allocations']);
    }

    /**
     * View method
     *
     * @param string|null $id Allocation id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allocation = $this->Allocations->get($id, [
            'contain' => ['Areas', 'Groups']
        ]);
        $this->set('allocation', $allocation);
        $this->set('_serialize', ['allocation']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allocation = $this->Allocations->newEntity();
        if ($this->request->is('post')) {
            $groupId = $this->request->data['allocations']['group_id'];
            unset($this->request->data['allocations']);
            $allocationEntities = $this->Allocations->buildAreaAssignmentEntities($groupId, $this->request->data);
            $allocations = $this->Allocations->patchEntities([], $allocationEntities);
            
            $transaction = $this->Allocations->connection();
            $transaction->begin();
            $unsaveCount = 0;
            foreach($allocations as $allocation){
                if ($this->Allocations->allocationExists($allocation->group_id, $allocation->area_id)){
                    continue;
                }
                if (!$this->Allocations->save($allocation)) {
                     ++$unsaveCount;
                }
            }
            if ($unsaveCount <= 0) {
                $transaction->commit();
                $this->Flash->success(__('Areas have been allocated to group. Now can now add schedules'));
                return $this->redirect(['controller'=>'Schedules', 'action' => 'add', '?'=>['group_id'=>$groupId]]);
            } else {
                $transaction->rollback();
                $this->Flash->error(__('The allocations could not be made. Ensure that you have selected areas and try again'));
            }
        }
        $regionAreas = $this->Allocations->Areas->getAreasGroupedIntoRegions();
        $groups = $this->Allocations->Groups->find('list', ['limit' => 200]);
        $this->set(compact('allocation', 'regionAreas', 'groups'));
        $this->set('_serialize', ['allocation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Allocation id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $allocation = $this->Allocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allocation = $this->Allocations->patchEntity($allocation, $this->request->data);
            if ($this->Allocations->save($allocation)) {
                $this->Flash->success(__('The allocation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allocation could not be saved. Please, try again.'));
            }
        }
        $areas = $this->Allocations->Areas->find('list', ['limit' => 200]);
        $groups = $this->Allocations->Groups->find('list', ['limit' => 200]);
        $this->set(compact('allocation', 'areas', 'groups'));
        $this->set('_serialize', ['allocation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Allocation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allocation = $this->Allocations->get($id);
        if ($this->Allocations->delete($allocation)) {
            $this->Flash->success(__('The allocation has been deleted.'));
        } else {
            $this->Flash->error(__('The allocation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
