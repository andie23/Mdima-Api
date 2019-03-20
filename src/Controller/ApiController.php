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

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('api', $this->paginate($this->Api));
        $this->set('_serialize', ['api']);
    }

    /**
     * View method
     *
     * @param string|null $id Api id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $api = $this->Api->get($id, [
            'contain' => []
        ]);
        $this->set('api', $api);
        $this->set('_serialize', ['api']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $api = $this->Api->newEntity();
        if ($this->request->is('post')) {
            $api = $this->Api->patchEntity($api, $this->request->data);
            if ($this->Api->save($api)) {
                $this->Flash->success(__('The api has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The api could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('api'));
        $this->set('_serialize', ['api']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Api id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $api = $this->Api->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $api = $this->Api->patchEntity($api, $this->request->data);
            if ($this->Api->save($api)) {
                $this->Flash->success(__('The api has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The api could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('api'));
        $this->set('_serialize', ['api']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Api id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $api = $this->Api->get($id);
        if ($this->Api->delete($api)) {
            $this->Flash->success(__('The api has been deleted.'));
        } else {
            $this->Flash->error(__('The api could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
