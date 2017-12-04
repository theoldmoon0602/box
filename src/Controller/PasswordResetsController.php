<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * PasswordResets Controller
 *
 * @property \App\Model\Table\PasswordResetsTable $PasswordResets
 *
 * @method \App\Model\Entity\PasswordReset[] paginate($object = null, array $settings = [])
 */
class PasswordResetsController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['add', 'reset']);
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		if (!$this->Auth->user('is_admin')) {
			return $this->redirect($this->referer());
		}
        $passwordResets = $this->paginate($this->PasswordResets);

        $this->set(compact('passwordResets'));
        $this->set('_serialize', ['passwordResets']);
    }

    /**
     * View method
     *
     * @param string|null $id Password Reset id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if (!$this->Auth->user('is_admin')) {
			return $this->redirect($this->referer());
		}
        $passwordReset = $this->PasswordResets->get($id, [
            'contain' => []
        ]);

        $this->set('passwordReset', $passwordReset);
        $this->set('_serialize', ['passwordReset']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $passwordReset = $this->PasswordResets->newEntity();
        if ($this->request->is('post')) {
            $passwordReset = $this->PasswordResets->patchEntity($passwordReset, $this->request->getData());
			if (isset($passwordReset->email)) {
				$this->loadModel('Users');
				$user = $this->Users->find()->where(['Users.email' => $passwordReset->email])->first();
				$this->PasswordResets->query()->delete()->where(['email'=>$passwordReset->email])->execute();
				if ($user) {
					$passwordReset->token = bin2hex(random_bytes(32));
					$email = new Email();
					$email->setTransport('gmail');
					$email
						->from('theoldmoon0602@theoldmoon0602.tk', 'theoldmoon0602')
						->to($user->email)
						->subject('Password Reset Request')
						->send(Router::url([
							'controller' => 'PasswordResets',
							'action' => 'reset',
							'?' => [
								'token' => $passwordReset->token
							]], true));

					if ($this->PasswordResets->save($passwordReset)) {
						$this->Flash->success(__('めーるおくったやで'));

						return $this->redirect(['controller' => 'Users', 'action' => 'login']);
					}
				}
			}
            $this->Flash->error(__('そりはちゃうってことよ'));
        }
        $this->set(compact('passwordReset'));
        $this->set('_serialize', ['passwordReset']);
    }

	public function reset()
	{
		$this->loadModel('Users');

		$token = $this->request->query('token');
		if (!$token) {
			$this->Flash->error("Invalid token");
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}

		$passwordReset = $this->PasswordResets->find()->where(['token' => $token])->first();
		if (! $passwordReset) {
			$this->Flash->error("Invalid token");
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
		else if ($this->request->is('post')) {
			$newPassword = $this->request->getData('newPassword');
			if (!$newPassword) {
				$this->Flash->error("Please Set Password");
				return;
			}
			$this->loadModel('Users');
			$user = $this->Users->find()->where(['email' => $passwordReset->email])->first();
			$this->PasswordResets->delete($passwordReset);
			if (!$user) {
				$this->Flash->error("Internal error");
				return;
			}
			$user->password = $newPassword;
			if ($this->Users->save($user)) {
				$this->Flash->success('パスワード更新しといたで');
				return $this->redirect(['controller' => 'Users', 'action' => 'login']);
			}
		}
	}


    /**
     * Delete method
     *
     * @param string|null $id Password Reset id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		if (!$this->Auth->user('is_admin')) {
			return $this->redirect($this->referer());
		}
        $this->request->allowMethod(['post', 'delete']);
        $passwordReset = $this->PasswordResets->get($id);
        if ($this->PasswordResets->delete($passwordReset)) {
            $this->Flash->success(__('The password reset has been deleted.'));
        } else {
            $this->Flash->error(__('The password reset could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
