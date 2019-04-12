<?php
namespace App\Controller;
use Cake\Log\Log;
use App\Controller\AppController;

/**
 * Programmes Controller
 *
 * @property \App\Model\Table\ProgrammesTable $Programmes
 */
class ProgrammesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('programmes', $this->paginate($this->Programmes));
        $this->set('_serialize', ['programmes']);
    }

    /**
     * View method
     *
     * @param string|null $id Programme id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $programme = $this->Programmes->get($id, [
            'contain' => ['Groups']
        ]);
        $this->set('programme', $programme);
        $this->set('_serialize', ['programme']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $programme = $this->Programmes->newEntity();
        if ($this->request->is('post')) {
            $con = $this->Programmes->connection();
            $con->begin();
            if($this->request->data['is_published']==1)
            {
                Log::write('debug', __('Programme {0} is set to publish', $programme->name));
                $unpublishActive = $this->Programmes->unpublishActive();
            }
            $programme = $this->Programmes->patchEntity($programme, $this->request->data);
            if ($this->Programmes->save($programme)) {
                $con->commit();
                $this->Flash->success(__('The programme has been saved. Please add groups to this programme'));
                return $this->redirect(['controller'=>'Groups', 'action' => 'add', '?' => ['programme'=>$programme->name, 'programme_id'=>$programme->id]]);
            } else {
                $this->Flash->error(__('The programme could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('programme'));
        $this->set('_serialize', ['programme']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Programme id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $programme = $this->Programmes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $programme = $this->Programmes->patchEntity($programme, $this->request->data);
            if ($this->Programmes->save($programme)) {
                $this->Flash->success(__('The programme has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The programme could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('programme'));
        $this->set('_serialize', ['programme']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Programme id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $programme = $this->Programmes->get($id);
        if ($this->Programmes->delete($programme)) {
            $this->Flash->success(__('The programme has been deleted.'));
        } else {
            $this->Flash->error(__('The programme could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
