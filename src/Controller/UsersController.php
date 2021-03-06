<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{


	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'add']);
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		if (!$this->Auth->user('is_admin')) {
			return $this->redirect(['controller'=> 'Users', 'action' => 'view']);
		}
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id=null)
    {
		if (!$this->Auth->user('is_admin')) {
			$id = $this->Auth->user('id');
		}
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		if ($this->Auth->user()) {
			return $this->redirect(['action' => 'view']);
		}
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->is_admin = false;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('れじすたしました'));

                return $this->redirect(['controller'=>'Questions', 'action' => 'index']);
            }
            $this->Flash->error(__('その情報ではだめぽです'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if (!$this->Auth->user('is_admin')) {
			$id = $this->Auth->user('id');
		}
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
		$email = $user->email; 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			if (!isset($user->email)) {
				$user->email = $email;
			}
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		if (!$this->Auth->user('is_admin')) {
			$id = $this->Auth->user('id');
		}
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
			return $this->logout();
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('ろぐいんできませんが');
		}
	}

	public function logout() {
		$this->Flash->success('あっはい');
		return $this->redirect($this->Auth->logout());
	}

}
