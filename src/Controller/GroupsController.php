<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Programmes']
        ];
        $this->set('groups', $this->paginate($this->Groups));
        $this->set('_serialize', ['groups']);
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => ['Allocations', 'Programmes' , 'Schedules']
        ]);
        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
           
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if (!$this->Groups->isGroupNameExists($group->programme_id, $group->name) and $this->Groups->save($group)) {
                $this->Flash->success(__('Group {0} has been saved. Please assign areas to this group categorization', $group->name));
                /*
                 *Redirect to area allocations for this group when the user checks to continue on the form.
                */
                if(array_key_exists('continue', $this->request->data))
                {
                     return $this->redirect(['controller'=>'Allocations', 'action' => 'add', '?'=>['group_id'=>$group->id]]);
                }
                /*
                *Redirect on the same page with existing programme
                */
                if($id = $this->request->query('programme_id') and $programme = $this->request->query('programme'))
                {
                    return $this->redirect(['action' => 'add', '?'=>['programme_id'=>$id, 'programme'=>$programme]]);
                }
                /*
                 *If the user is interested to enter multiple groups of the same programme, they can check on the form to
                 reuse programme after submission. On reuse, the url is a appended the submitted programme and id
                 NOTE: this is applicable when the url does not have programme data.
                */
                if(array_key_exists('reuse', $this->request->data))
                {
                    $this->loadModel('Programmes');
                    return $this->redirect(['action' => 'add', '?'=>[
                        'programme_id'=>$group->programme_id, 
                        'programme'=> $this->Programmes->get($group->programme_id)->name]]
                    );
                }
                return $this->redirect(['action'=>'add']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.
                    One of the possible causes is that you are using a similar Group-Name
                    already in use in the existing programme
                '));
            }
        }
        $this->set('programmes', $this->Groups->Programmes->find('list', ['limit'=>100]));
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);

            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }
        $this->set('programmes', $this->Groups->Programmes->find('list', ['limit'=>100]));
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
