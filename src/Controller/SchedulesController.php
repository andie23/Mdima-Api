<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 */
class SchedulesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups']
        ];
        $this->set('schedules', $this->paginate($this->Schedules));
        $this->set('_serialize', ['schedules']);
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['Groups']
        ]);
        $this->set('schedule', $schedule);
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEntity();
        if ($this->request->is('post')) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            $schedule->duration = $this->Schedules->getDurationInHours($schedule->starting_date, $schedule->ending_date);
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));
                if($groupId=$this->request->query('group_id')){
                    return $this->redirect(['action' => 'add', '?'=>['group_id'=>$groupId]]);
                }
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Schedules->Groups->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'groups'));
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            $schedule->duration = $this->Schedules->getDurationInHours($schedule->starting_date, $schedule->ending_date);

            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Schedules->Groups->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'groups'));
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $this->Flash->success(__('The schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The schedule could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
